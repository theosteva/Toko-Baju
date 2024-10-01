<header class="bg-black text-white shadow-lg">
    <nav class="container mx-auto px-6 py-4 flex items-center justify-between" style="height: 250px;">
        <!-- Logo (left) -->
        <a href="{{ route('products.home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Jange Clothes Logo" class="h-auto" style="max-height: 300px;">
        </a>

        <!-- Search bar, CTA, and Social Media (right) -->
        <div class="flex items-center space-x-4">
            <!-- Social Media Icons -->
            <div class="flex space-x-4">
                <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <!-- Search bar -->
            <input type="text" placeholder="Search..." class="px-4 py-2 rounded-full focus:outline-none text-black bg-white">
            <!-- Call-to-Action (CTA) -->
            <a href="#" class="bg-yellow-500 hover:bg-red-600 transition text-black px-4 py-2 rounded-full shadow-lg">
                Search
            </a>
        </div>

        <!-- Wishlist dan Cart (kanan) -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('wishlist.index') }}" id="wishlist-button" class="bg-white text-black px-4 py-2 rounded-full shadow-lg hover:bg-gray-200 transition">
                <i class="far fa-heart mr-2"></i> Wishlist
            </a>
            <a href="{{ route('cart.index') }}" id="cart-button" class="bg-white text-black px-4 py-2 rounded-full shadow-lg hover:bg-gray-200 transition">
                <i class="fas fa-shopping-cart mr-2"></i> Keranjang
            </a>
        </div>

        <!-- Mobile menu button -->
        <button id="menu-toggle" class="md:hidden text-2xl text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </nav>

    <!-- Menu Navigation (Centered at the bottom) -->
    <div class="bg-black py-2 shadow-md"> <!-- Mengubah py-4 menjadi py-2 -->
        <div class="container mx-auto flex flex-col items-center space-y-2"> <!-- Mengubah space-y-4 menjadi space-y-2 -->
            <!-- Navigation links (Centered) -->
            <ul class="flex space-x-6 justify-center">
                <li><a href="{{ route('products.home') }}" class="text-white hover:text-gray-300 transition text-lg font-medium">Home</a></li>
                <li><a href="{{ route('products.categories') }}" class="text-white hover:text-gray-300 transition text-lg font-medium">Categories</a></li>
                <li><a href="#" class="text-white hover:text-gray-300 transition text-lg font-medium">About</a></li>
            </ul>


        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden absolute top-16 left-0 w-full bg-black text-white shadow-lg hidden">
        <ul class="flex flex-col items-center py-4">
            <li><a href="{{ route('products.home') }}" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Home</a></li>
            <li><a href="#" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Categories</a></li>
            <li><a href="#" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">About</a></li>
            <li><a href="#" class="py-2 text-white hover:text-gray-300 transition text-lg font-medium">Contact</a></li>
        </ul>

        <div class="flex space-x-4 py-4 justify-center">
            <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white hover:text-gray-300 transition"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</header>

<script>
    // JavaScript to toggle mobile menu visibility
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Fungsi untuk menambahkan produk ke Wishlist
    function addToWishlist(productId) {
        fetch('/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Produk ditambahkan ke Wishlist:', data);
            // Update UI sesuai kebutuhan
        })
        .catch(error => console.error('Error:', error));
    }

    // Event listener untuk tombol Wishlist
    document.getElementById('wishlist-button').addEventListener('click', function() {
        // Anda dapat menampilkan modal atau halaman Wishlist di sini
        console.log('Tombol Wishlist diklik');
    });

    // Fungsi dan event listener untuk Keranjang dapat ditambahkan di sini juga
</script>
