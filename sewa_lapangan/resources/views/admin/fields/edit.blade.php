@extends('admin.layouts.app')

@section('title', 'Edit Lapangan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Lapangan: {{ $field->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.fields.update', $field->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Kolom Kiri --}}
                <div>
                    <!-- Nama Lapangan -->
                    <div class="mb-4">
                        @if(Auth::user()->role === 'staff')
                            <p class="text-xs text-gray-500 mt-1">Staff hanya bisa mengubah status lapangan</p>
                        @endif
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lapangan:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $field->name) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                               {{-- Tambahkan kondisi ini: jika bukan admin, buat input disabled --}}
                               @if(Auth::user()->role !== 'admin') disabled @endif>
                        @error('name')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $field->address) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror"
                               @if(Auth::user()->role !== 'admin') disabled @endif>
                        @error('address')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                        <input type="text" name="category" id="category" value="{{ old('category', $field->category) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror"
                               @if(Auth::user()->role !== 'admin') disabled @endif>
                        @error('category')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div>
                    <!-- Jam Buka -->
                    <div class="mb-4">
                        <label for="open_time" class="block text-gray-700 text-sm font-bold mb-2">Jam Buka:</label>
                        <input type="time" name="open_time" id="open_time" value="{{ old('open_time', $field->open_time) }}" step="1"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('open_time') border-red-500 @enderror"
                               @if(Auth::user()->role !== 'admin') disabled @endif>
                        @error('open_time')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <!-- Jam Tutup -->
                    <div class="mb-4">
                        <label for="close_time" class="block text-gray-700 text-sm font-bold mb-2">Jam Tutup:</label>
                        <input type="time" name="close_time" id="close_time" value="{{ old('close_time', $field->close_time) }}" step="1"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('close_time') border-red-500 @enderror"
                               @if(Auth::user()->role !== 'admin') disabled @endif>
                        @error('close_time')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        {{-- Input ini TIDAK di-disable, jadi bisa diubah oleh admin dan staff --}}
                        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror">
                            <option value="available" {{ old('status', $field->status) == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="maintenance" {{ old('status', $field->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="closed" {{ old('status', $field->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="description" id="description" rows="4"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                          @if(Auth::user()->role !== 'admin') disabled @endif>{{ old('description', $field->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.fields.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection