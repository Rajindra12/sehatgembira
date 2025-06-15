@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Riwayat Booking Saya</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Lapangan</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Jam</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Total Harga</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">{{ $booking->field->name }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">Rp {{ number_format($booking->total_price) }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="font-semibold {{ $booking->status == 'confirmed' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($booking->status) }}</span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if ($booking->status == 'pending')
                                            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-xs">
                                                Bayar Sekarang
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10">Anda belum memiliki riwayat booking.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection