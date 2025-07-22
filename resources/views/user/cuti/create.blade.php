<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Ajukan Cuti</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">
        <form action="{{ route('cuti.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="tanggal_mulai" class="block">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="w-full border rounded" required>
            </div>

            <div class="mb-4">
                <label for="tanggal_akhir" class="block">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="w-full border rounded" required>
            </div>

            <div class="mb-4">
                <label for="alasan" class="block">Alasan</label>
                <textarea name="alasan" class="w-full border rounded" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
        </form>
    </div>
</x-app-layout>
