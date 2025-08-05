<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Header dengan filter sederhana -->
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium">Daftar Riwayat Cuti</h3>
                    <div class="flex space-x-2">
                        <select class="border rounded-md px-3 py-1 text-sm">
                            <option>Semua Status</option>
                            <option>Disetujui</option>
                            <option>Ditolak</option>
                            <option>Pending</option>
                        </select>
                    </div>
                </div>

                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="mx-4 mt-2 p-3 bg-green-100 text-green-700 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Riwayat -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">No</th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">Nama</th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">Tanggal</th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">Durasi</th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">Status</th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($cutis as $index => $cuti)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $cuti->user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }} - 
                                        {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays($cuti->tanggal_selesai) + 1 }} hari
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            {{ $cuti->status === 'disetujui' ? 'bg-green-100 text-green-800' : 
                                               ($cuti->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($cuti->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="{{ route('admin.cuti.show', $cuti->id) }}" 
                                           class="text-blue-600 hover:text-blue-800">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Tidak ada riwayat pengajuan cuti
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($cutis->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200">
                        {{ $cutis->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>