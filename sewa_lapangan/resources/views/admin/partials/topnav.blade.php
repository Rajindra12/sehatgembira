<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            {{-- Judul Halaman (bisa diisi dinamis nanti) --}}
            <h1 class="text-xl font-semibold text-gray-800">
                @yield('title')
            </h1>

            {{-- Menu Dropdown User --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Konten Dropdown --}}
                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                    
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>