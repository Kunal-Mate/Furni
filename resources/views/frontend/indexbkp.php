<div class="swiper-wrapper">
    @foreach ($popular_products as $product)
    <div class="swiper-slide">
        <div class="animate-underline">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3"
                href="{{ route('product-details', ['id' => $product->productId]) }}">
                <img src="{{ asset($product->thumbnail ?? 'frontend/assets/img/shop/placeholder.png') }}"
                    class="hover-effect-target opacity-100 rounded-4" alt="{{ $product->productName }}">
            </a>

            <h3 class="mb-2">
                <a class="d-block fs-sm fw-medium text-truncate"
                    href="{{ route('product-details', ['id' => $product->productId]) }}">
                    <span class="animate-target">{{ $product->productName }}</span>
                </a>
            </h3>

            @if($product->cuttedPrice)
            <div class="h6">
                ₹{{ number_format($product->price, 2) }}
                <del class="fs-sm fw-normal text-body-tertiary">₹{{ number_format($product->cuttedPrice, 2) }}</del>
            </div>
            @else
            <div class="h6">₹{{ number_format($product->price, 2) }}</div>
            @endif

            <div class="d-flex gap-2 mt-2">
                <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
                <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                    aria-label="Add to wishlist">
                    <i class="ci-heart fs-base animate-target"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="swiper-slide">
    <div class="animate-underline">
        <!-- <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#"> -->
        <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="{{ route('product-details') }}">
            <img src="{{ asset('frontend/assets/img/shop/furniture/07.png') }}" class="hover-effect-target opacity-100"
                alt="Product">
            <img src="{{ asset('frontend/assets/img/shop/furniture/07-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
        </a>
        <div class="d-flex gap-2 mb-3">
            <input type="radio" class="btn-check" name="colors-7" id="color-7-1" checked="">
            <label for="color-7-1" class="btn btn-color fs-base" style="color: #71706c">
                <span class="visually-hidden">Dark gray</span>
            </label>
            <input type="radio" class="btn-check" name="colors-7" id="color-7-2">
            <label for="color-7-2" class="btn btn-color fs-base" style="color: #c1c3b8">
                <span class="visually-hidden">Light gray</span>
            </label>
        </div>
        <h3 class="mb-2">
            <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Chair with a cushion for the legs</span>
            </a>
        </h3>
        <div class="h6">$435.00</div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
            <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
            </button>
        </div>
    </div>
</div>