{{-- Admin Navigation Dropdown --}}
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
            class="flex items-center px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
        <div class="w-6 h-6 lg:w-8 lg:h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center mr-2 lg:mr-3">
            <span class="text-xs lg:text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>
        <div class="text-left hidden sm:block">
            <div class="font-medium text-sm lg:text-base">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500 hidden lg:block">Administrator</div>
        </div>
        <svg class="w-3 h-3 lg:w-4 lg:h-4 ml-1 lg:ml-2 transform transition-transform duration-200"
             :class="{ 'rotate-180': open }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 lg:w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
         style="display: none;">
        <div class="py-2">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profile Settings
            </a>

            <div class="border-t border-gray-100 my-1"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center w-full px-4 py-3 text-sm text-red-700 hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
