<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Cuti Saya
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('cuti.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajukan Cuti</a>

        <div class="bg-white shadow rounded p-4">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 border">#</th>
                        <th class="text-left px-4 py-2 border">Tanggal Mulai</th>
                        <th class="text-left px-4 py-2 border">Tanggal Akhir</th>
                        <th class="text-left px-4 py-2 border">Alasan</th>
                        <th class="text-left px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cutis as $index => $cuti)
                        <tr>
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $cuti->tanggal_mulai }}</td>
                            <td class="px-4 py-2 border">{{ $cuti->tanggal_akhir }}</td>
                            <td class="px-4 py-2 border">{{ $cuti->alasan }}</td>
                            <td class="px-4 py-2 border">
                                @if ($cuti->status == 'Menunggu Verifikasi')
                                    <span class="text-yellow-600 font-semibold">{{ $cuti->status }}</span>
                                @elseif ($cuti->status == 'Disetujui')
                                    <span class="text-green-600 font-semibold">{{ $cuti->status }}</span>
                                @else
                                    <span class="text-red-600 font-semibold">{{ $cuti->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 border text-center text-gray-500">Belum ada pengajuan cuti.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
