<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
            <div>
                <h2 class="font-semibold text-xl text-gray-900">Riwayat Pengajuan Cuti</h2>
                <p class="text-sm text-gray-500 mt-1">Lihat status dan detail pengajuan cuti Anda.</p>
            </div>
            <div class="flex flex-wrap gap-2 items-center">
                <a href="{{ route('user.dashboard') }}" class="text-sm inline-flex items-center gap-1 px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                    ← Dashboard
                </a>
                <a href="{{ route('user.cuti.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-600 transition">
                    Ajukan Cuti Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-4 max-w-5xl mx-auto space-y-6">
        @if (session('success'))
            <div class="rounded-md bg-green-50 border border-green-200 p-4 flex items-start gap-3">
                <div class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Pengajuan</h3>
                    <p class="text-xs text-gray-500 mt-1">
                        @if($cutis instanceof \Illuminate\Pagination\LengthAwarePaginator || $cutis instanceof \Illuminate\Pagination\Paginator)
                            {{ $cutis->total() }} pengajuan
                        @else
                            {{ $cutis->count() }} pengajuan
                        @endif
                    </p>
                </div>
                <div class="text-xs text-gray-500">
                    @if($cutis instanceof \Illuminate\Pagination\LengthAwarePaginator || $cutis instanceof \Illuminate\Pagination\Paginator)
                        Menampilkan {{ $cutis->firstItem() ?? 0 }} - {{ $cutis->lastItem() ?? 0 }} dari {{ $cutis->total() }}
                    @else
                        Menampilkan semua
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Durasi</th>
                            <th class="px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Alasan</th>
                            <th class="px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 font-medium text-gray-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($cutis as $cuti)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        s/d {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1 }} hari
                                </td>
                                <td class="px-6 py-4">
                                    <div class="line-clamp-2">{{ $cuti->alasan }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($cuti->status === 'disetujui')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                            Disetujui
                                        </span>
                                    @elseif ($cuti->status === 'ditolak')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                            Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('user.cuti.show', $cuti->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1">
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-300" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm">Belum ada pengajuan cuti.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(($cutis instanceof \Illuminate\Pagination\LengthAwarePaginator || $cutis instanceof \Illuminate\Pagination\Paginator) && $cutis->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-2">
                    <div class="text-xs text-gray-500">
                        Menampilkan {{ $cutis->firstItem() }} - {{ $cutis->lastItem() }} dari {{ $cutis->total() }}
                    </div>
                    <div>
                        {{ $cutis->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
