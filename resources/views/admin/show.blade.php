<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Informasi Pengajuan</h3>

                <div class="mb-4">
                    <strong>Nama:</strong> {{ $cuti->user->name }}
                </div>

                <div class="mb-4">
                    <strong>Email:</strong> {{ $cuti->user->email }}
                </div>

                <div class="mb-4">
                    <strong>Tanggal Mulai:</strong> {{ $cuti->tanggal_mulai }}
                </div>

                <div class="mb-4">
                    <strong>Tanggal Selesai:</strong> {{ $cuti->tanggal_selesai }}
                </div>

                <div class="mb-4">
                    <strong>Alasan:</strong> {{ $cuti->alasan }}
                </div>

                <div class="mb-4">
                    <strong>Status:</strong>
                    <span class="
                        {{ $cuti->status === 'pending' ? 'text-yellow-600' : 
                           ($cuti->status === 'disetujui' ? 'text-green-600' : 'text-red-600') }}">
                        {{ ucfirst($cuti->status) }}
                    </span>
                </div>

                @if($cuti->status === 'pending')
                    <div class="flex space-x-4 mt-6">
                        <form method="POST" action="{{ route('admin.cuti.verifikasi', ['id' => $cuti->id, 'status' => 'disetujui']) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Setujui
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.cuti.verifikasi', ['id' => $cuti->id, 'status' => 'ditolak']) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Tolak
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-6 text-sm text-gray-600">
                        Cuti sudah diverifikasi: <strong>{{ ucfirst($cuti->status) }}</strong>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Kembali ke daftar cuti</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
