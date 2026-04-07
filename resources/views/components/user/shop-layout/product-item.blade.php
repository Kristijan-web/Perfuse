@php
    $discountedPrice = $product->discount?->discount
        ? $product->price - round(($product->price * $product->discount?->discount) / 100)
        : null;
@endphp

@php


    $main_image = null;

    foreach ($product->images as $imageRecord) {

        if ($imageRecord->is_main_image) {
            $main_image = $imageRecord->path;
        }
    }


@endphp

<a href="{{ route("productDetails", $product->id) }}">
    <article class="shadow-my-shadow relative flex w-full flex-col items-center justify-between gap-3 overflow-hidden rounded-sm
p-10">
        @if ($product->discount?->discount)
            <div class="text-secondary-color absolute -right-7 top-5 w-[120px] rotate-45 bg-black text-center">
                {{ $product->discount?->discount }}%
            </div>
        @endif
        {{-- src="{{ $main_image }}" --}}
        {{-- src="http://127.0.0.1:8000/Images/ShopPage/Thumbnail/thumbnail.jpg" --}}
        <img class="mb-5 w-full rounded-sm sm:w-full min-[440px]:w-1/2" src="{{ $main_image }}"
            alt="{{ $product->brand->title }} {{ $product->brand->title }}">

        <p class="text-xl">{{ $product->brand->title }} {{ $product->title }}</p>
        <span class="text-main-color-shade/70">{{ $product->gender }}</span>
        <span class="text-main-color-shade/70">{{ $product->waterType->type}}</span>

        @if ($product->discount?->discount)
            <s class="text-main-color-shade/70">{{ number_format($product->price, 0, ',', '.') }} RSD</s>
            <p>{{ number_format($discountedPrice, 2, ',', '.') }} RSD</p>
        @else
            <p>{{ number_format($product->price, 0, ',', '.') }} RSD</p>
        @endif

    </article>
</a>