<nav x-data="{ open: false }" class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Brand + Links -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-800 font-semibold">
                    <div class="h-8 w-30 bg-indigo-600 rounded flex items-center justify-center text-white font-bold">
                         HRIS 
                    </div>
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="relative px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                        Dashboard Admin
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="absolute inset-x-0 -bottom-px h-1 bg-indigo-600 rounded-t"></span>
                        @endif
                    </a>
                    <a href="{{ route('admin.cuti.index') }}"
                       class="relative px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.cuti.*') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                        Kelola Cuti
                        @if(request()->routeIs('admin.cuti.*'))
                            <span class="absolute inset-x-0 -bottom-px h-1 bg-indigo-600 rounded-t"></span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                       class="relative px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                        Dashboard
                        @if(request()->routeIs('dashboard'))
                            <span class="absolute inset-x-0 -bottom-px h-1 bg-indigo-600 rounded-t"></span>
                        @endif
                    </a>
                    <a href="{{ route('user.cuti.index') }}"
                       class="relative px-3 py-2 text-sm font-medium {{ request()->routeIs('user.cuti.*') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                        Pengajuan Cuti
                        @if(request()->routeIs('user.cuti.*'))
                            <span class="absolute inset-x-0 -bottom-px h-1 bg-indigo-600 rounded-t"></span>
                        @endif
                    </a>
                @endif
            </div>

            <!-- Right: Profile & Logout -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-1 text-gray-700 hover:text-indigo-600 text-sm">
                    <!-- profile icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span>Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-gray-700 hover:text-indigo-600 text-sm">
                        <!-- logout icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3h-8v2h8v14h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>

                <!-- Mobile toggle -->
                <div class="md:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Dashboard Admin
                </a>
                <a href="{{ route('admin.cuti.index') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.cuti.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Kelola Cuti
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.cuti.index') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('user.cuti.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    Pengajuan Cuti
                </a>
            @endif

            <div class="mt-2 pt-2 border-t border-gray-100">
                <a href="{{ route('profile.edit') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 3h-8v2h8v14h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
