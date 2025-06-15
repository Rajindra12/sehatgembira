<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan riwayat booking milik pengguna yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua booking milik user ini, urutkan dari yang terbaru
        // 'with('field')' digunakan agar kita bisa mengambil nama lapangan dengan efisien
        $bookings = Booking::where('user_id', $user->id)
                            ->with('field')
                            ->latest()
                            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }
}