@extends('layouts.app')

@section('content')

<div id="promo-banner" class="asf-expandable-banner__container-top bg-yellow-500 text-black py-4 px-6 flex items-center justify-center relative">
    <div class="text-center">
        <div class="asf-expandable-banner__promo-text font-bold text-lg mb-2">
            SUMMER SALE: additional styles reduced up to -50% 
            <a href="/c/sale/" class="underline asf-expandable-banner__action font-semibold hover:text-gray-300 transition inline-flex items-center" aria-label="TO SALE">TO SALE</a>
        </div>
    </div>
    <button id="close-banner" class="asf-expandable-banner__close absolute right-4 top-1/2 transform -translate-y-1/2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" i="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>



    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="flex flex-col product-card">
                <a href="{{ route('products.show', $product) }}" class="product-images relative w-full h-100 cursor-pointer">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-100 object-cover product-image-1">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No image available</span>
                        </div>
                    @endif
                    @if ($product->image2)
                        <img src="{{ asset('storage/' . $product->image2) }}" alt="{{ $product->name }}" class="w-full h-100 object-cover hidden product-image-2">
                    @endif
                </a>
                <div class="p-1 flex-grow flex flex-col items-center justify-center">
                    <h2 class="text-lg mb-2 text-center">{{ $product->name }}</h2>
                    <p class="text-center text-green-700 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBanner = document.getElementById('close-banner');
        const promoBanner = document.getElementById('promo-banner');

        closeBanner.addEventListener('click', function() {
            promoBanner.style.display = 'none';
        });

        // Hover effect for product images
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            const images = card.querySelectorAll('.product-images img');
            const image1 = images[0]; // First image
            const image2 = images[1]; // Second image

            card.addEventListener('mouseenter', () => {
                if (image2) {
                    image1.classList.add('hidden');
                    image2.classList.remove('hidden');
                }
            });

            card.addEventListener('mouseleave', () => {
                if (image2) {
                    image1.classList.remove('hidden');
                    image2.classList.add('hidden');
                }
            });
        });
    });
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            loop: true,
        });
    });
</script>

@endsection
