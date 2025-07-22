<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Karyawan
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- Ringkasan Pengajuan --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded shadow p-4">
                <p class="text-sm text-gray-500">Total Pengajuan</p>
                <p class="text-2xl font-bold">{{ $cutis->count() }}</p>
            </div>
            <div class="bg-yellow-100 rounded shadow p-4">
                <p class="text-sm text-yellow-700">Menunggu Verifikasi</p>
                <p class="text-xl font-semibold text-yellow-800">
                    {{ $cutis->where('status', 'pending')->count() }}
                </p>
            </div>
            <div class="bg-green-100 rounded shadow p-4">
                <p class="text-sm text-green-700">Disetujui</p>
                <p class="text-xl font-semibold text-green-800">
                    {{ $cutis->where('status', 'disetujui')->count() }}
                </p>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-4">
            <a href="{{ route('cuti.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                + Ajukan Cuti
            </a>
            <a href="{{ route('cuti.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded shadow hover:bg-gray-700">
                Lihat Semua Riwayat
            </a>
        </div>

        {{-- Riwayat Terbaru --}}
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-4">Riwayat Terbaru</h3>

            @forelse ($cutis->take(5) as $cuti)
                <div class="border-b py-3 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}</p>
                        <p class="text-sm text-gray-600">Alasan: {{ $cuti->alasan }}</p>
                    </div>
                    <div>
                        @if($cuti->status === 'pending')
                            <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pending</span>
                        @elseif($cuti->status === 'disetujui')
                            <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded-full">Disetujui</span>
                        @else
                            <span class="text-xs bg-red-200 text-red-800 px-2 py-1 rounded-full">Ditolak</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada pengajuan cuti.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
