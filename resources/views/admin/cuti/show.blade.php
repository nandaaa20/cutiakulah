<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">
                Detail Pengajuan Cuti
                <span class="text-sm font-normal text-gray-500 ml-2">#{{ $cuti->id }}</span>
            </h2>
            <span class="text-sm bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">
                {{ \Carbon\Carbon::parse($cuti->created_at)->format('d M Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Profil Karyawan -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 flex items-start space-x-4 border-b border-gray-100">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-lg font-bold">
                        {{ substr($cuti->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $cuti->user->name }}</h3>
                        <div class="flex flex-wrap gap-x-4">
                            <p class="text-sm text-gray-500">{{ $cuti->user->email }}</p>
                            <p class="text-sm text-gray-500">{{ $cuti->user->department ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Cuti -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Periode Cuti</h4>
                            <div class="mt-2 flex items-center text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 ml-7">
                                ({{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays($cuti->tanggal_selesai) + 1 }} hari kerja)
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Verifikasi</h4>
                            <div class="mt-2">
                                @if($cuti->status == 'disetujui')
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="-ml-1 mr-1.5 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Disetujui
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 ml-1">
                                        Pada {{ \Carbon\Carbon::parse($cuti->updated_at)->format('d M Y H:i') }}
                                    </p>
                                @elseif($cuti->status == 'ditolak')
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="-ml-1 mr-1.5 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        Ditolak
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 ml-1">
                                        Pada {{ \Carbon\Carbon::parse($cuti->updated_at)->format('d M Y H:i') }}
                                    </p>
                                @else
                                    <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="-ml-1 mr-1.5 h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        Menunggu Verifikasi
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan Cuti</h4>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-gray-800 whitespace-pre-line">{{ $cuti->alasan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Verifikasi -->
            @if($cuti->status === 'pending')
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Form Verifikasi</h3>
                    <p class="text-sm text-gray-500 mt-1">Status tidak dapat diubah setelah diverifikasi</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.cuti.verifikasi', $cuti->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
                                <select name="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="" disabled selected>Pilih status verifikasi</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                                <textarea name="catatan" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Berikan catatan atau alasan jika diperlukan"></textarea>
                            </div>

                            <div class="flex justify-end space-x-3 pt-2">
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Batal
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Verifikasi Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Status Telah Diverifikasi</h3>
                </div>
                <div class="p-6">
                    <div class="rounded-md bg-blue-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Pengajuan ini telah diverifikasi pada {{ \Carbon\Carbon::parse($cuti->updated_at)->format('d M Y H:i') }}
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>
                                        Status verifikasi tidak dapat diubah setelah diproses. Silakan hubungi administrator jika terjadi kesalahan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($cuti->catatan)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-1">Catatan Verifikasi:</h4>
                        <div class="mt-1 p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-gray-800 whitespace-pre-line">{{ $cuti->catatan }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>