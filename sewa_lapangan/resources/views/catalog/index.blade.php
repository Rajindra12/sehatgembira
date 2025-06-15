@extends('layouts.app') {{-- MENGGUNAKAN LAYOUT PUBLIK, BUKAN ADMIN --}}

@section('content')
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-4">Temukan Lapangan Impian Anda</h1>
        <p class="text-center text-lg text-gray-600 mb-8">Booking lapangan olahraga terbaik di kota Anda dengan mudah.</p>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <form action="{{ route('catalog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" placeholder="Cari nama atau lokasi lapangan..." value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">

                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Cari
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($fields as $field)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                    <a href="{{ route('catalog.show', $field) }}">
                        <img class="h-56 w-full object-cover" src="{{ $field->image ?? 'https://via.placeholder.com/400x300.png?text=No+Image' }}" alt="{{ $field->name }}">
                    </a>
                    <div class="p-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">{{ $field->category }}</span>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $field->name }}</h3>
                        <p class="text-gray-600 text-sm truncate">{{ $field->address }}</p>
                        <div class="mt-4">
                            <a href="{{ route('catalog.show', $field) }}" class="w-full text-center bg-gray-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-900 transition duration-300 block">
                                Lihat Detail & Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 text-center py-16">
                    <p class="text-gray-500 text-xl">Oops! Lapangan yang Anda cari tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $fields->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection