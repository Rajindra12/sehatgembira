@extends('layouts.app')

@section('content')

 <div class="container mx-auto py-8"> 
    
     <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Mahasiswa</h3> 
     
    <button class="bg-white hover:bg-gray-100 text-gray-800 dark:text-gray-500 font-bold py-2 px-4 border-b-4 border-gray-500 hover:border-gray-300 rounded">
        <a href="{{ url('mahasiswa/create') }}">Tambah Data</a>
    </button>
    <br>
    <br>

     <div class="overflow-x-auto">
         <table class="table-auto w-full border-collapse border border-sky dark:border-white">
            <thead>
                <tr class="bg-white">
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">NIM</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Nama</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Jurusan</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Alamat</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">No. Telepon</th>
                    <th class="border border-sky dark:border-white px-4 py-2 text-left text-gray-800 dark:text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row) 
                <tr class="odd:bg-gray-1 even:bg-gray-500">
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $row->mhsw_nim }}</td> 
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $row->mhsw_nama }}</td> 
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $row->mhsw_jurusan }}</td> 
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $row->mhsw_alamat }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2 text-gray-800 dark:text-white">{{ $row->no_telepon }}</td>
                    <td class="border border-sky dark:border-white px-4 py-2">
                        <a class="text-gray-800 dark:text-white hover:text-red-500" href="{{ url('mahasiswa/edit/' . $row->mhsw_id) }}">Edit</a>
                        <br>
                        <form id="delete-form-{{ $row->mhsw_id }}" action="{{ url('mahasiswa/' . $row->mhsw_id) }}" method="POST" onsubmit="return confirmDelete(event, {{ $row->mhsw_id }})">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-800 dark:text-white hover:text-red-500">Delete</button>
                        </form>
                        
                        <script>
                            function confirmDelete(event, id) {
                                event.preventDefault(); // Mencegah form langsung terkirim
                                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                                    document.getElementById('delete-form-' + id).submit(); // Submit form jika dikonfirmasi
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