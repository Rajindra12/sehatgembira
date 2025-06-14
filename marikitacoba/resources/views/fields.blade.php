@extends('layouts.app')
@section('content')

    <div class="px-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center items-center sm:rounded-lg p-6">
                <h1 class="text-5xl font-bold">Selamat datang di halaman pengguna!</h1>
                <p class="py-6">
                    Di sini Anda dapat melihat produk-produk yang tersedia dan melakukan pembelian.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6">
        @foreach($rows as $row)
            <a href="{{ url('/fields/' . $row->id) }}" class="block no-underline">
                <div class="card bg-base-100 w-96 shadow-sm">
                    <figure class="h-48 overflow-hidden">
                        @if($row->gambar)
                            <img src="{{ $row->gambar }}" alt="Gambar fields {{ $row->nama }}" class="object-cover w-full h-full" />
                        @else
                            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Gambar fields Default" class="object-cover w-full h-full" />
                        @endif
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-lg">
                            {{ $row->nama }}
                            <div class="badge @if($row->status == 'Tersedia') badge-success @else badge-error @endif ml-2">
                                {{ $row->status }}
                            </div>
                        </h2>

                        <p class="text-sm text-gray-500">{{ $row->alamat }}</p>
                        <p class="text-sm">Kategori: {{ $row->kategori }}</p>
                        <p class="text-sm">Jam Operasional: {{ \Carbon\Carbon::parse($row->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($row->jam_tutup)->format('H:i') }}</p>
                        <p class="text-base font-bold mt-2">Harga: Rp {{ number_format($row->harga_per_jam, 0, ',', '.') }}/jam</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection