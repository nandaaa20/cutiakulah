<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">
                Dashboard Karyawan
            </h2>
            <div class="text-sm text-gray-500">
                Hari ini: {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden text-white">
                <div class="p-6 flex flex-col md:flex-row justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="opacity-90">
                            Semoga harimu menyenangkan. Anda memiliki 
                            <strong>{{ $cutis->where('status', 'disetujui')->count() }}</strong> cuti yang disetujui.
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Ajukan Cuti -->
                <a href="{{ route('user.cuti.create') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300 flex items-start gap-4">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Ajukan Cuti Baru</h3>
                        <p class="text-sm text-gray-500">Buat pengajuan cuti baru</p>
                    </div>
                </a>

                <!-- Status Cuti -->
                <div class="bg-white rounded-xl shadow-md p-6 flex items-start gap-4">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Status Cuti</h3>
                        <p class="text-sm text-gray-500">
                            Disetujui: <strong>{{ $cutis->where('status', 'disetujui')->count() }}</strong> | 
                            Menunggu: <strong>{{ $cutis->where('status', 'pending')->count() }}</strong>
                        </p>
                    </div>
                </div>

                <!-- Sisa Cuti -->
                <div class="bg-white rounded-xl shadow-md p-6 flex items-start gap-4">
                    <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Hak Cuti Tahun Ini</h3>
                        <p class="text-sm text-gray-500">
                            {{ auth()->user()->sisa_cuti }} hari tersisa dari 12 hari
                        </p>
                    </div>
                </div>
            </div>

            <!-- Riwayat Cuti -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h2a1 1 0 110 2h-3a1 1 0 01-1-1V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Riwayat Pengajuan Cuti
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-left">Durasi</th>
                                <th class="px-6 py-3 text-left">Alasan</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($cutis as $cuti)
                                <tr class="hover:bg-gray-50 transition cursor-pointer"
                                    onclick="window.location='{{ route('user.cuti.show', $cuti->id) }}'">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            s/d {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays($cuti->tanggal_selesai) + 1 }} hari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $cuti->alasan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($cuti->status === 'disetujui')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @elseif ($cuti->status === 'ditolak')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-6 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>Belum ada pengajuan cuti</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($cutis instanceof \Illuminate\Pagination\LengthAwarePaginator || $cutis instanceof \Illuminate\Pagination\Paginator)
                    @if($cutis->hasPages())
                        <div class="px-6 py-4 border-t bg-gray-50">
                            {{ $cutis->withQueryString()->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
