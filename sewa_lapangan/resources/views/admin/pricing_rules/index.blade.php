@extends('admin.layouts.app')
@section('title', 'Aturan Harga')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Aturan Harga</h1>
        <a href="{{ route('admin.pricing-rules.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Aturan Harga
        </a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lapangan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Hari</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Waktu</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga / Jam</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rules as $rule)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $rule->field->name ?? 'Lapangan Dihapus' }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ ucfirst($rule->day_type) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ ucfirst($rule->time_type) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Rp {{ number_format($rule->price_per_hour, 0, ',', '.') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('admin.pricing-rules.edit', $rule->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.pricing-rules.destroy', $rule->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menghapus aturan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10">Belum ada aturan harga.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t">
            {{ $rules->links() }}
        </div>
    </div>
</div>
@endsection