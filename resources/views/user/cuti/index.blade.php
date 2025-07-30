<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Riwayat Pengajuan Cuti</h2>
    </x-slot>

    <div class="p-4">
        @if (session('success'))
            <div class="text-green-600">{{ session('success') }}</div>
        @endif

        <a href="{{ route('user.cuti.create') }}" class="bg-green-500 text-white px-4 py-2 rounded inline-block mb-4">
            Ajukan Cuti Baru
        </a>

        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Tanggal Mulai</th>
                    <th class="px-4 py-2 border">Tanggal Selesai</th>
                    <th class="px-4 py-2 border">Alasan</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cutis as $cuti)
                    <tr>
                        <td class="border px-4 py-2">{{ $cuti->tanggal_mulai }}</td>
                        <td class="border px-4 py-2">{{ $cuti->tanggal_selesai }}</td>
                        <td class="border px-4 py-2">{{ $cuti->alasan }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($cuti->status) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">Belum ada pengajuan cuti.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
