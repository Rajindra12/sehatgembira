<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Field;
use App\Models\PricingRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'booking_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'start_time' => 'required|date_format:H:i:s',
        ]);

        $field = Field::find($validated['field_id']);
        $user = Auth::user();

        // Cek Double Booking di sisi server (PENTING!)
        $isBooked = Booking::where('field_id', $field->id)
            ->where('booking_date', $validated['booking_date'])
            ->where('start_time', $validated['start_time'])
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if ($isBooked) {
            return response()->json(['message' => 'Jadwal yang Anda pilih sudah dibooking oleh orang lain.'], 409); // 409 Conflict
        }

        // Hitung harga (logika cerdas)
        $bookingDay = Carbon::parse($validated['booking_date']);
        $dayType = $bookingDay->isWeekend() ? 'weekend' : 'weekday';
        // Untuk sementara kita anggap semua booking malam hari jika lewat jam 6 sore
        $timeType = Carbon::parse($validated['start_time'])->hour >= 18 ? 'night' : 'day';

        $priceRule = PricingRule::where('field_id', $field->id)
            ->where('day_type', $dayType)
            ->where('time_type', $timeType)
            ->first();

        if (!$priceRule) {
            return response()->json(['message' => 'Aturan harga untuk jadwal ini tidak ditemukan.'], 404);
        }

        $totalPrice = $priceRule->price_per_hour;

        // Buat booking baru
        $booking = Booking::create([
            'user_id' => $user->id,
            'field_id' => $field->id,
            'booking_date' => $validated['booking_date'],
            'start_time' => $validated['start_time'],
            'end_time' => Carbon::parse($validated['start_time'])->addHour()->format('H:i:s'), // Durasi 1 jam
            'total_price' => $totalPrice,
            'status' => 'pending', // Status awal adalah pending sampai dibayar
        ]);

        return response()->json([
            'message' => 'Booking berhasil dibuat!',
            'booking_id' => $booking->id,
        ], 201); // 201 Created
    }
}