<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Ajukan Cuti</h2>
    </x-slot>

    <div class="p-4">
        @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cuti.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="border rounded w-full">
            </div>
            <div>
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="border rounded w-full">
            </div>
            <div>
                <label>Alasan Cuti</label>
                <textarea name="alasan" class="border rounded w-full"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajukan</button>
        </form>
    </div>
</x-app-layout>
