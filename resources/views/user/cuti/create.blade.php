<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            Ajukan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Info Box --}}
                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 text-sm">
                        Sisa hak cuti tahun ini: <strong>{{ $sisaCuti }}</strong> hari dari {{ $MAX_CUTI }} hari
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('user.cuti.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Tanggal Mulai --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai *</label>
                            <input 
                                type="text" 
                                name="tanggal_mulai" 
                                class="datepicker-start bg-white mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" 
                                placeholder="Pilih tanggal mulai" 
                                required
                            >
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai *</label>
                            <input 
                                type="text" 
                                name="tanggal_selesai" 
                                class="datepicker-end bg-white mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" 
                                placeholder="Pilih tanggal selesai" 
                                required
                            >
                            <p id="days-count" class="mt-1 text-sm text-gray-500"></p>
                            <p id="warning-message" class="mt-1 text-sm text-red-600 hidden"></p>
                        </div>

                        {{-- Alasan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alasan Cuti *</label>
                            <textarea 
                                name="alasan" 
                                rows="4" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" 
                                placeholder="Jelaskan alasan pengajuan cuti..." 
                                required
                            ></textarea>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit" id="submit-btn" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Ajukan Cuti
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- Flatpickr CSS & JS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const MAX_CUTI = {{ $MAX_CUTI }};
                let sisaCuti = {{ $sisaCuti }};

                const startPicker = flatpickr(".datepicker-start", {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    disableMobile: true,
                    onChange: function(selectedDates, dateStr) {
                        endPicker.set('minDate', dateStr);
                        calculateDays();
                    }
                });

                const endPicker = flatpickr(".datepicker-end", {
                    dateFormat: "Y-m-d",
                    disableMobile: true,
                    onChange: function() {
                        calculateDays();
                    }
                });

                function calculateDays() {
                    const startInput = document.querySelector('.datepicker-start').value;
                    const endInput = document.querySelector('.datepicker-end').value;
                    const daysDisplay = document.getElementById('days-count');
                    const warningMessage = document.getElementById('warning-message');
                    const submitBtn = document.getElementById('submit-btn');

                    if (!startInput || !endInput) {
                        daysDisplay.textContent = '';
                        warningMessage.classList.add('hidden');
                        submitBtn.disabled = false;
                        return;
                    }

                    const startDate = new Date(startInput);
                    const endDate = new Date(endInput);
                    let days = 0;
                    let currentDate = new Date(startDate);

                    while (currentDate <= endDate) {
                        const dayOfWeek = currentDate.getDay();
                        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                            days++;
                        }
                        currentDate.setDate(currentDate.getDate() + 1);
                    }

                    daysDisplay.textContent = `(${days} hari kerja)`;

                    // Validasi batas cuti
                    if (days > sisaCuti) {
                        warningMessage.textContent = `⚠️ Total cuti melebihi sisa ${sisaCuti} hari. Silakan kurangi durasi cuti.`;
                        warningMessage.classList.remove('hidden');
                        submitBtn.disabled = true;
                    } else {
                        warningMessage.classList.add('hidden');
                        submitBtn.disabled = false;
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
