@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center items-center bg-white sm:rounded-lg p-6 shadow">
                <h1 class="text-5xl font-bold text-center">Selamat datang di halaman pengguna!</h1>
                <p class="py-6 text-center text-gray-700">
                    Di sini Anda dapat melihat produk-produk yang tersedia dan melakukan pembelian.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-12">
        @foreach($rows as $row)
            <a href="{{ url('/fields/' . $row->id) }}" class="block no-underline">
                <div class="card bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                    <figure class="w-full overflow-hidden" style="height: 250px;">
                        <img src="{{ asset('storage/' . $row->gambar) }}"
                             alt="Gambar {{ $row->nama }}"
                             class="object-cover w-full h-full" />
                    </figure>
                    <div class="card-body p-4">
                        <h2 class="text-xl font-semibold flex items-center justify-between">
                            {{ $row->nama }}
                            <span class="badge @if($row->status == 'Tersedia') badge-success @else badge-error @endif ml-2">
                                {{ $row->status }}
                            </span>
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $row->alamat }}</p>
                        <p class="text-sm mt-1">Kategori: {{ $row->kategori }}</p>
                        <p class="text-sm mt-1">
                            Jam Operasional:
                            {{ \Carbon\Carbon::parse($row->jam_buka)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($row->jam_tutup)->format('H:i') }}
                        </p>
                        <p class="text-base font-bold mt-3 text-primary">
                            Harga: Rp {{ number_format($row->harga_per_jam, 0, ',', '.') }}/jam
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
