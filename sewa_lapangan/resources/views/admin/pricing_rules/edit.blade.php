@extends('admin.layouts.app')
@section('title', 'Edit Aturan Harga')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Aturan Harga</h1>
    <div class="bg-white shadow-md rounded-lg p-6">

        {{-- 1. ACTION FORM diubah ke route 'update' dan mengirimkan ID --}}
        <form action="{{ route('admin.pricing-rules.update', $pricingRule->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- 2. Tambahkan method PUT untuk update --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="field_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Lapangan:</label>
                    <select name="field_id" id="field_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 ...">
                        @foreach ($fields as $field)
                            {{-- 3. Logika 'selected' diubah untuk mencocokkan data yang diedit --}}
                            <option value="{{ $field->id }}" {{ old('field_id', $pricingRule->field_id) == $field->id ? 'selected' : '' }}>
                                {{ $field->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('field_id')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="day_type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Hari:</label>
                    <select name="day_type" id="day_type" class="shadow border rounded w-full py-2 px-3 ...">
                        <option value="weekday" {{ old('day_type', $pricingRule->day_type) == 'weekday' ? 'selected' : '' }}>Weekday</option>
                        <option value="weekend" {{ old('day_type', $pricingRule->day_type) == 'weekend' ? 'selected' : '' }}>Weekend</option>
                    </select>
                    @error('day_type')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="time_type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Waktu:</label>
                    <select name="time_type" id="time_type" class="shadow border rounded w-full py-2 px-3 ...">
                        <option value="day" {{ old('time_type', $pricingRule->time_type) == 'day' ? 'selected' : '' }}>Siang</option>
                        <option value="night" {{ old('time_type', $pricingRule->time_type) == 'night' ? 'selected' : '' }}>Malam</option>
                    </select>
                    @error('time_type')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="price_per_hour" class="block text-gray-700 text-sm font-bold mb-2">Harga per Jam:</label>
                    {{-- 3. Atribut 'value' diisi dengan data yang diedit --}}
                    <input type="number" name="price_per_hour" id="price_per_hour" value="{{ old('price_per_hour', $pricingRule->price_per_hour) }}" class="shadow border rounded w-full py-2 px-3 ...">
                    @error('price_per_hour')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.pricing-rules.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection