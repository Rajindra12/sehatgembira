{{-- Menggunakan layout app.blade.php --}}
@extends('layouts.app') {{-- Sesuaikan 'layouts.app' jika lokasi file app.blade.php berbeda --}}

{{-- Mengisi section 'header' yang mungkin ada di app.blade.php (jika app.blade.php mendukungnya) --}}
{{-- Jika app.blade.php tidak punya @yield('header'), bagian ini bisa dihapus --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection

{{-- Mengisi section 'content' yang ada di app.blade.php --}}
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Pastikan partial views ini ada dan tidak error --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Pastikan partial views ini ada dan tidak error --}}
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Pastikan partial views ini ada dan tidak error --}}
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
