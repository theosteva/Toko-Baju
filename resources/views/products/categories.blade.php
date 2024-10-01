@extends('layouts.app')

@section('content')
<style>
    .category-link {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .category-link::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: #EAB308; /* Ubah ke warna yellow-500 */
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }
    .category-link:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }
    .category-link:hover {
        color: #EAB308; /* Ubah ke warna yellow-500 */
        padding-left: 1rem;
    }
    .category-link.active {
        color: #EAB308; /* Ubah ke warna yellow-500 */
        font-weight: 600;
    }
    .category-link.active::before {
        transform: scaleX(1);
    }
    .product-image-container {
        position: relative;
        overflow: hidden;
    }
    .product-image-2 {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .product-image-container:hover .product-image-2 {
        opacity: 1;
    }
</style>

<div class="container mx-auto px-4 py-8 flex">
    <!-- Category navigation bar on the left -->
    <div class="w-1/4 pr-8">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="category-link active block py-2 px-4 rounded transition duration-300 ease-in-out" data-category="new">
                        Baru
                    </a>
                </li>
                @foreach ($tags as $tag)
                <li>
                    <a href="#" class="category-link block py-2 px-4 rounded transition duration-300 ease-in-out" data-category="{{ strtolower($tag->name) }}">
                        {{ $tag->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>

    <!-- Main content on the right -->
    <div class="w-3/4">
        <h1 class="text-3xl font-bold mb-8" id="category-title">NEW</h1>

        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($newProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="aspect-w-1 aspect-h-1 w-full product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover product-image-1">
                    @if($product->image2)
                        <img src="{{ asset('storage/' . $product->image2) }}" alt="{{ $product->name }}" class="w-full h-full object-cover product-image-2">
                    @endif
                </div>
                <div class="text-center p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-green-700 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryLinks = document.querySelectorAll('.category-link');
        const categoryTitle = document.getElementById('category-title');
        const productGrid = document.getElementById('product-grid');
        
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                categoryLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                categoryTitle.textContent = this.textContent.trim();
                
                // Fetch products for the selected category
                fetch(`/api/products?tag=${category}`)
                    .then(response => response.json())
                    .then(products => {
                        productGrid.innerHTML = products.map(product => `
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="aspect-w-1 aspect-h-1 w-full product-image-container">
                                    <img src="${product.image ? '/storage/' + product.image : '/path/to/placeholder-image.jpg'}" alt="${product.name}" class="w-full h-full object-cover product-image-1">
                                    ${product.image2 ? `<img src="/storage/${product.image2}" alt="${product.name}" class="w-full h-full object-cover product-image-2">` : ''}
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">${product.name}</h3>
                                    <p class="text-gray-600">Rp ${parseFloat(product.price).toLocaleString('id-ID')}</p>
                                </div>
                            </div>
                        `).join('');
                    });
            });
        });
    });
</script>
@endsection