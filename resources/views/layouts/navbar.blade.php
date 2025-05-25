<nav class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="bg-white p-2 rounded-full transition duration-300 group-hover:rotate-12">
                        <i class="fas fa-shoe-prints text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">
                        <span class="animate-pulse">SHOE</span>STORE
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <!-- Main Links -->
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="{{ route('products.index') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                        <i class="fas fa-shoe-prints mr-2"></i> Products
                    </a>
                    <a href="{{ route('categories.index') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                        <i class="fas fa-tags mr-2"></i> Categories
                    </a>
                    <a href="{{ route('about') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> About
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4 ml-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('cart.index') }}" class="relative text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                                <i class="fas fa-shopping-cart text-xl"></i>
                                @if($cartCount = app('cart')->count())
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-bounce">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        @endif
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-white hover:text-yellow-300 transition-colors duration-200">
                                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            
                            <div x-show="open" x-cloak @click.away="open = false" 
                                class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-blue-500"></i> Profile
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 flex items-center">
                                    <i class="fas fa-clipboard-list mr-2 text-green-500"></i> Orders
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 flex items-center">
                                        <i class="fas fa-sign-out-alt mr-2 text-red-500"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition-colors duration-200 flex items-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-full shadow-sm transition-colors duration-200 flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-white hover:text-yellow-300 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="isOpen" x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                <i class="fas fa-home mr-3"></i> Home
            </a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                <i class="fas fa-shoe-prints mr-3"></i> Products
            </a>
            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                <i class="fas fa-tags mr-3"></i> Categories
            </a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                <i class="fas fa-info-circle mr-3"></i> About
            </a>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('cart.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center relative">
                        <i class="fas fa-shopping-cart mr-3"></i> Cart
                        @if($cartCount = app('cart')->count())
                            <span class="ml-2 bg-red-500 text-white px-2 rounded-full text-xs">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endif
                
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                    <i class="fas fa-user-circle mr-3"></i> Profile
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50 flex items-center">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                    <i class="fas fa-sign-in-alt mr-3"></i> Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:bg-blue-50 flex items-center">
                    <i class="fas fa-user-plus mr-3"></i> Register
                </a>
            @endauth
        </div>
    </div>
</nav>