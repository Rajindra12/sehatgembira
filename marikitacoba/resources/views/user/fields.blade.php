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

{{-- Asumsikan Anda memiliki variabel $fields yang berisi satu data fields dari database --}}

<a href="{{ url('/fields/' . $fields->id) }}" class="block no-underline">
    <div class="card bg-base-100 w-96 shadow-sm">
      <figure class="h-48 overflow-hidden"> {{-- Tambahkan tinggi tetap dan overflow hidden agar gambar rapi --}}
        @if($fields->gambar)
          {{-- Pastikan path gambar ini benar sesuai dengan konfigurasi penyimpanan Anda --}}
          {{-- Contoh ini mengasumsikan gambar disimpan di storage/app/public dan dilink ke public/storage --}}
          <img src="{{ asset('storage/' . $fields->gambar) }}" alt="Gambar fields {{ $fields->nama }}" class="object-cover w-full h-full" />
        @else
          {{-- Placeholder gambar jika tidak ada gambar yang diunggah --}}
          <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Gambar fields Default" class="object-cover w-full h-full" />
        @endif
      </figure>
      <div class="card-body">
        <h2 class="card-title text-lg">
          {{ $fields->nama }}
          {{-- Tambahkan badge untuk status --}}
          <div class="badge @if($fields->status == 'Tersedia') badge-success @else badge-error @endif ml-2">
            {{ $fields->status }}
          </div>
        </h2>
  
        {{-- Tampilkan informasi lain dari tabel --}}
        <p class="text-sm text-gray-500">{{ $fields->alamat }}</p>
        <p class="text-sm">Kategori: {{ $fields->kategori }}</p>
        {{-- Format jam buka dan tutup --}}
        <p class="text-sm">Jam Operasional: {{ \Carbon\Carbon::parse($fields->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($fields->jam_tutup)->format('H:i') }}</p>
        <p class="text-base font-bold mt-2">Harga: Rp {{ number_format($fields->harga_per_jam, 0, ',', '.') }}/jam</p>
  
        {{-- Deskripsi (opsional, mungkin terlalu panjang untuk list card) --}}
        {{-- <p class="text-sm mt-2">{{ Str::limit($fields->deskripsi, 100) }}</p> --}}
  
        {{-- Bagian card-actions dan tombol dihilangkan --}}
        {{-- Seluruh area card sekarang menjadi clickable karena dibungkus <a> --}}
  
      </div>
    </div>
  </a>

@endsection