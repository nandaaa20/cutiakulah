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
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="font-medium">Terdapat kesalahan dalam pengisian form</h3>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Info Box -->
                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Pastikan mengajukan cuti minimal 3 hari kerja sebelumnya</span>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('user.cuti.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Tanggal Mulai -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai *</label>
                            <input 
                                type="date" 
                                name="tanggal_mulai" 
                                value="{{ old('tanggal_mulai') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required
                                onchange="calculateDays(this)"
                            >
                        </div>

                        <!-- Tanggal Selesai -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai *</label>
                            <input 
                                type="date" 
                                name="tanggal_selesai" 
                                value="{{ old('tanggal_selesai') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required
                                onchange="calculateDays(this)"
                            >
                            <p id="days-count" class="mt-1 text-sm text-gray-500"></p>
                        </div>

                        <!-- Alasan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alasan Cuti *</label>
                            <textarea 
                                name="alasan" 
                                rows="4" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Jelaskan alasan pengajuan cuti..."
                                required
                            >{{ old('alasan') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Ajukan Cuti
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function calculateDays() {
                const startInput = document.querySelector('input[name="tanggal_mulai"]');
                const endInput = document.querySelector('input[name="tanggal_selesai"]');
                const daysDisplay = document.getElementById('days-count');
                
                if (!startInput.value || !endInput.value) {
                    daysDisplay.textContent = '';
                    return;
                }
                
                const startDate = new Date(startInput.value);
                const endDate = new Date(endInput.value);
                
                // Perhitungan hari kerja (tidak termasuk akhir pekan)
                let days = 0;
                let currentDate = new Date(startDate);
                
                while (currentDate <= endDate) {
                    const dayOfWeek = currentDate.getDay();
                    if (dayOfWeek !== 0 && dayOfWeek !== 6) { // 0 = Minggu, 6 = Sabtu
                        days++;
                    }
                    currentDate.setDate(currentDate.getDate() + 1);
                }
                
                daysDisplay.textContent = `(${days} hari kerja)`;
            }
        </script>
    @endpush
</x-app-layout>