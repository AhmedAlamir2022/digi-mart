<style>
    .product-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .product-thumb-wrapper {
        width: 100%;
        height: 160px;
        /* نفس ارتفاع كل الـ previews */
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        background-color: #f8f8f8;
        /* لون خلفية موحد للصوت */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-thumb-wrapper img,
    .product-thumb-wrapper video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* يغطي الصندوق بالكامل */
    }

    .audio-player {
        width: 90%;
        /* player أصغر شوي داخل الصندوق */
        max-height: 50px;
    }

    .product-item__price-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .product-item__price {
        font-weight: 700;
        font-size: 1rem;
        color: #3626b1;
        /* اللون للأفضلية أو الخصم */
    }

    .product-item__prevPrice {
        font-size: 0.875rem;
        color: #888888;
        text-decoration: line-through;
    }

    .discount-badge {
        background-color: #ff4d4f;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 0.3rem;
    }

    .product-item__author {
        font-size: 0.875rem;
        color: #555;
        /* لون النص العادي */
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .product-item__author a {
        color: #1e88e5;
        /* لون الرابط */
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .product-item__author a:hover {
        color: #1565c0;
        /* لون عند hover */
        text-decoration: underline;
        /* يظهر underline عند المرور */
    }

    .product-item__title {
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.2;
        margin: 0.25rem 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        /* لو عايز يظهر سطر واحد فقط */
    }

    .product-item__title a {
        color: #222;
        /* لون أساسي واضح */
        text-decoration: none;
        transition: color 0.2s, transform 0.2s;
    }

    .product-item__title a:hover {
        color: #1e88e5;
        /* لون عند hover */
        transform: translateX(2px);
        /* حركة بسيطة جذابة */
    }
    
</style>
<div class="col-lg-6 col-xl-4 col-sm-6">
    <div class="product-item {{ $product->preview_type == 'video' ? 'product-video' : '' }}">
        <div class="product-item__thumb product-thumb-wrapper">
            @if ($product->preview_type == 'image')
                <a href="{{ route('products.show', $product->slug) }}" class="link w-100 h-100">
                    <img src="{{ asset($product->preview_image) }}" alt="Preview Image">
                </a>
            @elseif($product->preview_type == 'video')
                <video class="player" playsinline controls>
                    <source src="{{ asset($product->preview_video) }}" type="video/mp4" />
                </video>
            @elseif($product->preview_type == 'audio')
                <audio class="audio-player" controls>
                    <source src="{{ asset($product->preview_audio) }}" type="audio/mp3" />
                </audio>
            @endif
        </div>
        <div class="product-item__content">
            <div class="product-item__bottom flx-between gap-2">
                <div class="d-flex flex-wrap justify-content-between align-items-center w-100">

                    <div class="d-flex align-items-center gap-1">
                        <ul class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if (round($product->reviews_avg_stars) >= $i)
                                    <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                                @else
                                    <li class="star-rating__item font-11"><i class="fas fa-star text-muted"></i></li>
                                @endif
                            @endfor
                        </ul>
                        <span class="star-rating__text text-heading fw-500 font-14">
                            ({{ $product->reviews_count }})</span>
                    </div>
                    <span class="product-item__sales font-14"><i
                            class="ti ti-download"></i>{{ $product->sales_count }}</span>

                </div>
            </div>
            <h6 class="product-item__title">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h6>
            <div class="product-item__info flx-between gap-2">
                <span class="product-item__author">
                    {{ __('by') }}
                    <a href="javascript:;">
                        {{ $product->author->name }}
                    </a>
                </span>
                <div class="product-item__price-wrapper">
                    @if ($product->discount_price > 0)
                        <h6 class="product-item__price mb-0">${{ $product->discount_price }}</h6>
                        <span class="product-item__prevPrice">${{ $product->price }}</span>
                        <span class="discount-badge">
                            {{ round(100 - ($product->discount_price / $product->price) * 100) }}% OFF
                        </span>
                    @else
                        <h6 class="product-item__price mb-0">${{ $product->price }}</h6>
                    @endif
                </div>
            </div>
            <div class="product_item_footer">
                @if (in_array($product->id, session('purchase_ids', [])))
                    <a class="product_cart bg-warning text-white" href="javascript:;">
                        <i class="ti ti-shopping-cart-plus"></i> <span
                            id="cart-btn-{{ $product->id }}">{{ __('Already Purchased') }}</span>
                    </a>
                @else
                    <a class="product_cart add-cart" data-id="{{ $product->id }}" href="javascript:;">
                        <i class="ti ti-shopping-cart-plus"></i> <span
                            id="cart-btn-{{ $product->id }}">{{ __('Add to cart') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
