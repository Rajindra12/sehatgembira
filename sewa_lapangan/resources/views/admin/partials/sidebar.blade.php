{{-- Sidebar --}}
<aside class="w-64 flex-shrink-0 bg-gray-800 text-white flex flex-col">
    {{-- Logo atau Nama Website --}}
    <div class="h-16 flex items-center justify-center text-xl font-bold border-b border-gray-700">
        <a href="{{ route('admin.dashboard') }}">Sewa Lapangan</a>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-1 px-2 py-4 space-y-2">
        {{-- 
            Logika untuk menu aktif:
            request()->routeIs('admin.dashboard') akan bernilai true jika route saat ini adalah 'admin.dashboard'.
            Tanda '*' adalah wildcard, jadi 'admin.fields.*' akan cocok untuk 'admin.fields.index', 'admin.fields.create', dll.
        --}}

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
                   {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            {{-- Ikon Dashboard (Heroicons) --}}
            <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.fields.index') }}"
            class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
                   {{ request()->routeIs('admin.fields.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            {{-- Ikon Lapangan --}}
            <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235.083.487.128.75.128h10.5c.263 0 .515-.045.75-.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
            </svg>
            <span>Kelola Lapangan</span>
        </a>

        <a href="{{ route('admin.pricing-rules.index') }}"
            class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
                {{ request()->routeIs('admin.pricing-rules.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            {{-- Ikon Harga --}}
            <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.826-1.106-2.296 0-3.122C10.536 9.219 11.268 9 12 9c.75 0 1.47.22 2.003.659l.879.659m0-2.219-l.879.659c-1.171.879-3.07.879-4.242 0-1.172-.879-1.172-2.303 0-3.182C10.464 4.219 11.232 4 12 4c.725 0 1.45.22 2.003.659l.879.659" />
            </svg>
            <span>Aturan Harga</span>
        </a>
    </nav>
</aside>