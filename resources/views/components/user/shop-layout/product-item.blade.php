@php
    $discountedPrice = $product->discount?->discount
        ? $product->price - round(($product->price * $product->discount?->discount) / 100)
        : null;
@endphp

{{-- // Treba da uzme onu sliku koja is is_main_image = 1 --}}

@php

    // problem je sto 1 proizvod moze da ima vise slikaaaaa i onda ne zna koju da uzme
    $main_image = null;

    foreach ($product->images as $imageRecord) {

        // Meni bi trebao da je $product->images niz objekata, to jest niz slika koje pripadaju proizvodu

        // usao sam u 1 image record, da li on na sebi setovani is_main_image = 1?
        // $value bi trebao da je objekat record-a image-a
        if ($imageRecord->is_main_image) {
            $main_image = $imageRecord->path;
        }
    }


@endphp

{{-- E SAD mora da se popune podaci iz $product-a a to je $product->brand->title, itd.... --}}
<article class="shadow-my-shadow relative flex w-full flex-col items-center justify-between gap-3 overflow-hidden rounded-sm
p-10">
    @if ($product->discount?->discount)
        <div class="text-secondary-color absolute -right-7 top-5 w-[120px] rotate-45 bg-black text-center">
            {{ $product->discount?->discount }}%
        </div>
    @endif

    {{-- $product->images->path --}}
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

    <span class="text-main-color-tint absolute right-[15px] top-[10px] text-xl">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path
                d="m12 20.5-1.2-1.1C5.4 14.5 2 11.4 2 7.5 2 4.4 4.4 2 7.5 2c1.8 0 3.5.8 4.5 2.1C13 2.8 14.7 2 16.5 2 19.6 2 22 4.4 22 7.5c0 3.9-3.4 7-8.8 11.9L12 20.5Z"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>
</article>