<x-guest-layout>
    <div class="text-center my-6">
        <img src="/logo.png" alt="Logo" class="mx-auto w-32 mb-4">
        <h1 class="text-2xl font-bold">Selamat Datang di Percutian</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Submit -->
        <div class="flex items-center justify-between mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            <x-primary-button>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
