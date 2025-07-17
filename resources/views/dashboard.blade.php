<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Dashboard Cuti Karyawan
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="font-bold text-lg">Ajukan Cuti</h3>
                <p class="text-gray-600">Klik tombol di bawah untuk mengajukan cuti.</p>
                <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg">Ajukan</a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="font-bold text-lg">Status Cuti</h3>
                <p class="text-gray-600">Lihat riwayat pengajuan dan status verifikasi.</p>
                <a href="#" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded-lg">Lihat</a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="font-bold text-lg">Profil</h3>
                <p class="text-gray-600">Edit data pribadi & email.</p>
                <a href="#" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
