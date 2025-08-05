<x-guest-layout>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">{{ __('Create Your Account') }}</h2>
            <p class="mt-2 text-sm text-gray-600">{{ __('Join our community today') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="name" class="block w-full pl-10" type="text" name="name" :value="old('name')" 
                                required autofocus autocomplete="name" placeholder="John Doe" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-text-input id="email" class="block w-full pl-10" type="email" name="email" 
                                :value="old('email')" required autocomplete="email" placeholder="your@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password" class="block w-full pl-10" type="password" name="password" 
                                required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    <p>{{ __('Password must contain:') }}</p>
                    <ul class="list-disc pl-5 grid grid-cols-2 gap-1">
                        <li class="{{ strlen(request('password')) >= 8 ? 'text-green-500' : '' }}">8+ characters</li>
                        <li class="{{ preg_match('/[A-Z]/', request('password')) ? 'text-green-500' : '' }}">Uppercase</li>
                        <li class="{{ preg_match('/[0-9]/', request('password')) ? 'text-green-500' : '' }}">Number</li>
                        <li class="{{ preg_match('/[\W]/', request('password')) ? 'text-green-500' : '' }}">Special char</li>
                    </ul>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" class="block w-full pl-10" type="password" 
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <div class="flex items-center justify-between pt-2">
                <a class="text-sm text-indigo-600 hover:text-indigo-500 font-medium" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>

                <x-primary-button class="flex items-center gap-2 px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>