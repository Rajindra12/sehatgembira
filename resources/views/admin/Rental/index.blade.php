@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8"> 
    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Lapangan</h3> 

    <a href="{{ url('admin/fields/create') }}">
        <button class="bg-white hover:bg-gray-100 text-gray-800 dark:text-gray-500 font-bold py-2 px-4 border-b-4 border-gray-500 hover:border-gray-300 rounded">
            Tambah Data
        </button>
    </a>
    
    <br><br>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-sky dark:border-white">
            <thead>
                <tr class="bg-white">
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Nama</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Alamat</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Kategori</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Harga / Jam</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Jam Operasional</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Status</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $field)
                <tr class="odd:bg-gray-100 even:bg-white">
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $field->nama }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $field->alamat }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $field->kategori }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">Rp{{ number_format($field->harga_per_jam, 0, ',', '.') }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $field->jam_buka }} - {{ $field->jam_tutup }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ ucfirst($field->status) }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">
                        <a href="{{ url('admin/fields/edit/' . $field->id) }}" class="hover:text-blue-600">Edit</a>
                        <form action="{{ url('admin/fields/' . $field->id) }}" method="POST" onsubmit="return confirmDelete(event, {{ $field->id }})" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-500">Hapus</button>
                        </form>
                        <script>
                            function confirmDelete(event, id) {
                                event.preventDefault();
                                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                                    document.forms[`delete-form-${id}`]?.submit();
                                }
                            }
                        </script>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
</div>
@endsection
