<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lupa Kata Sandi?</h1>
            <p class="text-sm text-gray-500 mt-1">
                Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi.
            </p>
        </div>

        <!-- Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow">
                Kirim Link Reset Password
            </button>
        </form>
    </div>
</x-guest-layout>
