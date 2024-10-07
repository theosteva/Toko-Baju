<header class="bg-black text-white shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <!-- Left side: Logo and Navigation (aligned left) -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <a href="{{ route('products.home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Jange Clothes Logo" class="h-auto" style="max-height: 100px;">
                </a>

                <!-- Navigation (aligned left) -->
                <nav class="flex space-x-6">
                    <a href="{{ route('products.home') }}" class="text-white hover:text-gray-300 transition text-lg font-medium">Home</a>
                    <a href="{{ route('products.categories') }}" class="text-white hover:text-gray-300 transition text-lg font-medium">Categories</a>
                    <a href="#" class="text-white hover:text-gray-300 transition text-lg font-medium">About</a>
                    <a href="#" class="text-white hover:text-gray-300 transition text-lg font-medium">Contact</a>
                </nav>
            </div>

            <!-- Right side: Search bar and Wishlist/Cart/Account (aligned right) -->
            <div class="flex items-center space-x-4">
                <!-- Search bar aligned right -->
                <div class="flex items-center space-x-2 w-full md:w-auto">
                    <input type="text" placeholder="Search..." class="px-4 py-2 rounded-full focus:outline-none text-black bg-white w-full md:w-64">
                </div>

                <!-- Wishlist and Cart (aligned right) -->
                <a href="{{ route('wishlist.index') }}" id="wishlist-button" class="bg-black text-white px-4 py-2 rounded-full shadow-lg hover:bg-gray-800 transition">
                    <i class="far fa-heart mr-2"></i> Wishlist
                </a>
                <a href="{{ route('cart.index') }}" id="cart-button" class="bg-black text-white px-4 py-2 rounded-full shadow-lg hover:bg-gray-800 transition">
                    <i class="fas fa-shopping-cart mr-2"></i> Cart
                </a>
                @guest
                    <a href="{{ route('login') }}" id="login-button" class="bg-yellow-500 text-black px-4 py-2 rounded-full shadow-lg hover:bg-yellow-600 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-red-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>

        <!-- Mobile menu button -->
        <button id="menu-toggle" class="md:hidden text-2xl text-white absolute top-4 right-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden absolute top-16 left-0 w-full bg-black text-white shadow-lg hidden">
        <ul class="flex flex-col items-center py-4">
            <li><a href="{{ route('products.home') }}" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Home</a></li>
            <li><a href="{{ route('products.categories') }}" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Categories</a></li>
            <li><a href="#" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">About</a></li>
            <li><a href="#" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Contact</a></li>
        </ul>
    </div>
</header>

<script>
    // JavaScript to toggle mobile menu visibility
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
