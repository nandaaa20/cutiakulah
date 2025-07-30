<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin - Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Daftar Pengajuan Cuti</h3>

                @if(session('success'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Tanggal Mulai</th>
                            <th class="border px-4 py-2">Tanggal Selesai</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cutis as $index => $cuti)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $cuti->user->name }}</td>
                                <td class="border px-4 py-2">{{ $cuti->tanggal_mulai }}</td>
                                <td class="border px-4 py-2">{{ $cuti->tanggal_selesai }}</td>
                                <td class="border px-4 py-2">
                                    <span class="
                                        {{ $cuti->status === 'pending' ? 'text-yellow-600' : 
                                           ($cuti->status === 'disetujui' ? 'text-green-600' : 'text-red-600') }}">
                                        {{ ucfirst($cuti->status) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.cuti.show', $cuti->id) }}"
                                       class="text-blue-600 hover:underline text-sm">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">
                                    Belum ada pengajuan cuti.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
