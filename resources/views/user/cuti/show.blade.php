<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Pengajuan Cuti</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-900">{{ $cuti->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $cuti->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Mulai</p>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Selesai</p>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-gray-500">Alasan</p>
                    <p class="text-gray-800">{{ $cuti->alasan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Durasi</p>
                    <p class="font-medium">
                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1 }} hari
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    @if($cuti->status === 'pending')
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                    @elseif($cuti->status === 'disetujui')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800">Disetujui</span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800">Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('user.dashboard') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
