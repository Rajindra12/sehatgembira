@extends('admin.layouts.app')

@section('title', 'Kelola Lapangan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Lapangan</h1>

        {{-- Logika untuk menampilkan tombol berdasarkan role pengguna --}}
        @if (Auth::user()->role === 'admin')
            {{-- JIKA PENGGUNA ADALAH ADMIN: Tampilkan tombol normal yang bisa diklik --}}
            <a href="{{ route('admin.fields.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                + Tambah Lapangan
            </a>
        @else
            {{-- JIKA BUKAN ADMIN (misal: staff): Tampilkan tombol yang dinonaktifkan --}}
            <span class="relative group">
                <button disabled class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed">
                    + Tambah Lapangan
                </button>
                {{-- "Alert" atau Tooltip yang akan muncul saat hover --}}
                <span class="absolute bottom-full mb-2 w-max px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Hanya Admin yang dapat menambah lapangan.
                </span>
            </span>
        @endif
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Lapangan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fields as $field)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $loop->iteration + ($fields->currentPage() - 1) * $fields->perPage() }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $field->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $field->category }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold {{ $field->status_color_class }} leading-tight">
                                <span aria-hidden class="absolute inset-0 opacity-50 rounded-full"></span>
                                <span class="relative">{{ ucfirst($field->status) }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('admin.fields.edit', $field->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE') {{-- WAJIB ADA UNTUK PROSES DELETE --}}
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10">Belum ada data lapangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            {{ $fields->links() }}
        </div>
    </div>
</div>
@endsection