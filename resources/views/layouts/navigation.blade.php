<nav x-data="{ open: false, showAvatarModal: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex sm:hidden">
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-gray-700 transition duration-150">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('donation')" :active="request()->routeIs('donation')" class="hover:text-gray-700 transition duration-150">
                        {{ __('Donation') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Avatar and Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex items-center mr-3">
                    <div class="w-8 h-8">
                        <!-- Conditional Avatar/Initials Display -->
                        @if(Auth::check() && Auth::user()->avatar)
                            <img @click="showAvatarModal = true" class="w-full h-full object-cover cursor-pointer rounded-full" 
                                 src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Avatar">
                        @elseif(Auth::check())
                            <div class="w-8 h-8 bg-gray-500 flex items-center justify-center text-white font-bold rounded-full" 
                                 @click="showAvatarModal = true">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @else
                            <div class="w-8 h-8 bg-gray-500 flex items-center justify-center text-white font-bold rounded-full">
                                ?
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" class="rounded-lg shadow-lg">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out" aria-label="Open Settings Menu">
                            <svg aria-hidden="true" class="ml-1 h-5 w-5 text-black-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Info -->
                        @if(Auth::check())
                            <div class="flex flex-col p-4 border-b border-black-300 rounded-t-lg">
                                <p class="font-bold text-gray-600 mb-1">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->email }}</p>
                                <p class="text-xs text-gray-400 mt-1">Joined: {{ Auth::user()->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Profile Edit Link -->
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-gray-600">{{ __('Profile') }}</p>
                            </x-dropdown-link>

                             <!-- Transaction Link -->
                            <x-dropdown-link :href="route('transactions.user-dashboard-transaction')" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-gray-600">{{ __('Transactions') }}</p>
                            </x-dropdown-link>

                            <!-- Admin Access Links -->
                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 transition duration-150">
                                    <p class="font-bold text-gray-600">{{ __('Admin Dashboard') }}</p>
                                </x-dropdown-link>
                            @endif

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 transition duration-150">
                                    <p class="font-bold text-gray-600">{{ __('Log Out') }}</p>
                                </x-dropdown-link>
                            </form>
                        @else
                            <p class="text-gray-600">Please log in to access your account.</p>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div x-show="open" class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block text-gray-700 hover:bg-gray-100 transition duration-150">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('donation')" :active="request()->routeIs('donation')" class="block text-gray-700 hover:bg-gray-100 transition duration-150">
                {{ __('Donation') }}
            </x-nav-link>
        </div>
    </div>
</nav>
