<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Karyawan
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6">
            <h3 class="text-lg font-bold mb-2">Selamat datang, {{ Auth::user()->name }}</h3>
            <p class="text-gray-600">Berikut ini status cuti terakhirmu:</p>
        </div>

        @if ($cuti_terakhir)
            <div class="bg-white shadow rounded p-4 mb-4">
                <p><strong>Tanggal:</strong> {{ $cuti_terakhir->tanggal_mulai }} s/d {{ $cuti_terakhir->tanggal_akhir }}</p>
                <p><strong>Status:</strong> 
                    @if ($cuti_terakhir->status == 'Disetujui')
                        <span class="text-green-600 font-semibold">Disetujui</span>
                    @elseif ($cuti_terakhir->status == 'Ditolak')
                        <span class="text-red-600 font-semibold">Ditolak</span>
                    @else
                        <span class="text-yellow-600 font-semibold">Menunggu Verifikasi</span>
                    @endif
                </p>
                <p><strong>Alasan:</strong> {{ $cuti_terakhir->alasan }}</p>
            </div>
        @else
            <div class="text-gray-500">Belum ada pengajuan cuti.</div>
        @endif

        <div class="flex space-x-4 mt-6">
            <a href="{{ route('cuti.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                + Ajukan Cuti
            </a>
            <a href="{{ route('cuti.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Lihat Riwayat
            </a>
        </div>

    </div>
</x-app-layout>
