<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan role mereka.
     */
    // Kode yang seharusnya
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'staff') {
            return redirect()->route('admin.fields.index');
        } elseif ($role === 'customer') {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect('/'); // Arahkan ke halaman utama sebagai fallback
        }
    }
}