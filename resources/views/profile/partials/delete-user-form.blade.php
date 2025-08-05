<section class="bg-white shadow rounded-lg p-6 space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Delete Account
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all of its data will be permanently removed. Please make sure you have saved any important information.
        </p>
    </header>

    <!-- Form Hapus -->
    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
        @csrf
        @method('delete')

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password" name="password" type="password" placeholder="Enter your password"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm" required>
            @error('password', 'userDeletion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md shadow">
            Delete Account
        </button>
    </form>
</section>
