@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div>
                    <img class="h-full w-full object-cover" src="{{ $field->image ?? 'https://via.placeholder.com/800x600.png?text=No+Image' }}" alt="{{ $field->name }}">
                </div>

                <div class="p-8 md:p-12">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full mb-4">{{ $field->category }}</span>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $field->name }}</h1>

                    <div class="flex items-center text-gray-600 mb-6">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span>{{ $field->address }}</span>
                    </div>

                    <div class="prose max-w-none text-gray-700 mb-8">
                        <p>{{ $field->description }}</p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg mb-8">
                        <h3 class="font-bold text-gray-800 mb-2">Informasi Penting</h3>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Jam Operasional:</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($field->open_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($field->close_time)->format('H:i') }}</span>
                        </div>
                        {{-- Nanti di sini kita bisa tampilkan harga --}}
                    </div>

                    <div class="mt-8">
                        <h2 class="text-2xl font-bold mb-4">Pilih Tanggal & Jam</h2>

                        <div class="mb-6">
                            <label for="booking-date" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal Booking</label>
                            <input type="text" id="booking-date" placeholder="Pilih tanggal..."
                                class="w-full md:w-1/2 shadow-sm border-gray-300 rounded-md">
                        </div>

                        <div id="time-slots-container">
                            <div class="bg-blue-100 text-blue-800 p-4 rounded-lg text-center">
                                <p>Silakan pilih tanggal untuk melihat jam yang tersedia.</p>
                            </div>
                        </div>
                        
                        <div id="booking-summary" class="hidden mt-6 bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan Anda</h3>
                            <p id="summary-text" class="text-gray-700 mb-4"></p>
                            <button id="book-now-button" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                                Booking Sekarang & Lanjut ke Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // === DEFINISI ELEMEN & VARIABEL ===
    const dateInput = document.getElementById('booking-date');
    const timeSlotsContainer = document.getElementById('time-slots-container');
    const bookingSummary = document.getElementById('booking-summary');
    const summaryText = document.getElementById('summary-text');
    const bookNowButton = document.getElementById('book-now-button');
    const fieldId = {{ $field->id }};
    const baseUrl = "{{ url('/') }}";
    
    let selectedDate = null;
    let selectedSlot = null;

    // === INISIALISASI KALENDER ===
    const fp = flatpickr(dateInput, {
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            if (dateStr) {
                selectedDate = dateStr;
                fetchAvailability(dateStr);
            }
        },
    });

    // =================================================================
    //     FUNGSI UNTUK MENGAMBIL & MENAMPILKAN JADWAL (YANG BENAR)
    // =================================================================
    function fetchAvailability(date) {
        timeSlotsContainer.innerHTML = `<div class="text-center py-4"><p class="text-gray-600">Mencari jadwal...</p></div>`;
        hideBookingSummary();

        const apiUrl = `${baseUrl}/api/v1/fields/${fieldId}/availability?date=${date}`;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => { // Perhatikan, kita menerima 'data' dari API ketersediaan
                timeSlotsContainer.innerHTML = '';
                if (data.data.available_slots && data.data.available_slots.length > 0) {
                    const grid = document.createElement('div');
                    grid.className = 'grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2';
                    
                    data.data.available_slots.forEach(slot => {
                        const button = document.createElement('button');
                        button.className = 'bg-white border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded hover:bg-blue-600 hover:text-white transition duration-200';
                        button.textContent = slot;
                        button.dataset.slot = slot;
                        button.addEventListener('click', function() {
                            handleSlotSelection(this);
                        });
                        grid.appendChild(button);
                    });
                    timeSlotsContainer.appendChild(grid);
                } else {
                    timeSlotsContainer.innerHTML = `<div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center"><p>Maaf, tidak ada jadwal tersedia pada tanggal ini.</p></div>`;
                }
            })
            .catch(error => {
                console.error('Error fetching availability:', error);
                timeSlotsContainer.innerHTML = `<div class="bg-red-100 text-red-800 p-4 rounded-lg text-center"><p>Terjadi kesalahan saat mengambil jadwal.</p></div>`;
            });
    }

    // === FUNGSI UNTUK MENANGANI PEMILIHAN JAM ===
    function handleSlotSelection(clickedButton) {
        const allButtons = timeSlotsContainer.querySelectorAll('button');
        allButtons.forEach(btn => {
            btn.classList.remove('bg-blue-700', 'text-white');
            btn.classList.add('bg-white', 'text-blue-500');
        });

        clickedButton.classList.add('bg-blue-700', 'text-white');
        selectedSlot = clickedButton.dataset.slot;
        showBookingSummary();
    }

    // === FUNGSI UNTUK MENAMPILKAN & MENYEMBUNYIKAN SUMMARY ===
    function showBookingSummary() {
        if(selectedDate && selectedSlot) {
            summaryText.textContent = `Anda akan memesan lapangan pada tanggal ${selectedDate} jam ${selectedSlot}.`;
            bookingSummary.classList.remove('hidden');
        }
    }

    function hideBookingSummary() {
        bookingSummary.classList.add('hidden');
        selectedSlot = null;
    }

    // =================================================================
    //         FUNGSI UNTUK MENGIRIM BOOKING KE SERVER (YANG BENAR)
    // =================================================================
    bookNowButton.addEventListener('click', function() {
        @guest
            alert('Anda harus login terlebih dahulu untuk melakukan booking.');
            window.location.href = '{{ route('login') }}?redirect=' + window.location.href;
            return;
        @endguest

        this.disabled = true;
        this.textContent = 'Memproses...';

        const bookingData = {
            field_id: fieldId,
            booking_date: selectedDate,
            start_time: selectedSlot + ':00', // Tambah detik agar format H:i:s
        };

        const bookingApiUrl = `${baseUrl}/api/v1/bookings`;
        
        fetch(bookingApiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(bookingData)
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => { // Perhatikan, kita menerima 'status' dan 'body' dari API booking
            if (status === 201) { // 201 Created
                alert(`Booking berhasil! ID Booking Anda: ${body.booking_id}. Halaman akan dialihkan.`);
                window.location.href = '{{ route("customer.bookings.index") }}';
            } else {
                alert(body.message || 'Terjadi kesalahan saat membuat booking.');
            }
        })
        .catch(error => {
            console.error('Booking Error:', error);
            alert('Terjadi kesalahan fatal. Silakan coba lagi.');
        })
        .finally(() => {
            // Kembalikan tombol ke keadaan semula baik sukses maupun gagal
            this.disabled = false;
            this.textContent = 'Booking Sekarang & Lanjut ke Pembayaran';
        });
    });
});
</script>
@endpush