<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Field;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function check(Request $request, Field $field)
    {
        // 1. Validasi input: pastikan tanggal dikirim dan formatnya benar
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        // Cek jika lapangan tidak tersedia (maintenance/closed)
        if ($field->status !== 'available') {
            return response()->json([
                'status' => 'error',
                'message' => 'Lapangan tidak tersedia saat ini.'
            ], 404);
        }

        // 2. Ambil semua jam yang SUDAH DIBOOKING untuk lapangan & tanggal ini
        $bookedTimes = Booking::where('field_id', $field->id)
            ->where('booking_date', $validated['date'])
            ->whereIn('status', ['confirmed', 'pending']) // Hanya cek booking yang aktif
            ->pluck('start_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i'); // Format menjadi HH:MM
            })->toArray();


        // 3. Buat semua slot waktu yang MUNGKIN ada dalam satu hari (per 1 jam)
        $period = CarbonPeriod::create(
            Carbon::parse($field->open_time),
            '1 hour',
            // Jam tutup adalah awal dari slot terakhir yang tidak bisa dibooking
            Carbon::parse($field->close_time)->subHour()
        );

        $allSlots = [];
        foreach ($period as $date) {
            $allSlots[] = $date->format('H:i');
        }

        // 4. Bandingkan semua slot dengan yang sudah dibooking untuk menemukan yang TERSEDIA
        $availableSlots = array_diff($allSlots, $bookedTimes);

        // 5. Kembalikan hasilnya dalam format JSON
        return response()->json([
            'status' => 'success',
            'data' => [
                // array_values untuk mereset index array agar menjadi [0, 1, 2, ...]
                'available_slots' => array_values($availableSlots),
                'booked_slots' => $bookedTimes
            ]
        ]);
    }
}