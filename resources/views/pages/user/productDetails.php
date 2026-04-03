<?php

$product = [
    'id' => 1,
    'brand' => 'Dior',
    'title' => 'Sauvage Elixir',
    'gender' => 'muski',
    'waterType' => 'Parfum',
    'price' => 21490,
    'discount' => 15,
    'description' => 'Intenzivan i prepoznatljiv parfem sa toplim zacinskim notama, lavandom i drvenastom bazom. Napravljen je za vecernje izlaske, posebne prilike i sve koji vole bogat, dugotrajan miris.',
    'volume' => '60 ml',
    'concentration' => 'Parfum',
    'longevity' => '8-12h',
    'origin' => 'Francuska',
    'sku' => 'DIOR-SE-60',
    'rating' => 4.9,
    'reviews' => 126,
    'notes' => [
        'Top note: grejpfrut, cimet, kardamom',
        'Heart note: lavanda',
        'Base note: sandalovina, amber, paculi, sladic',
    ],
    'highlights' => [
        'Originalni niche-style karakter',
        'Naglasen sillage i dugotrajnost',
        'Elegantna crna bocica',
    ],
    'images' => [
        asset('images/ShopPage/Products/shop-item-1.jpg'),
        asset('images/ShopPage/Products/shop-item-1.jpg'),
        asset('images/ShopPage/Products/shop-item-1.jpg'),
    ],
];

$relatedProducts = [
    [
        'brand' => 'Chanel',
        'title' => 'Bleu de Chanel',
        'gender' => 'muski',
        'waterType' => 'Eau de Parfum',
        'price' => 18990,
        'image' => asset('images/ShopPage/Products/shop-item-1.jpg'),
    ],
    [
        'brand' => 'YSL',
        'title' => 'Y Le Parfum',
        'gender' => 'muski',
        'waterType' => 'Parfum',
        'price' => 17490,
        'image' => asset('images/ShopPage/Products/shop-item-1.jpg'),
    ],
    [
        'brand' => 'Armani',
        'title' => 'Acqua di Gio Profumo',
        'gender' => 'muski',
        'waterType' => 'Parfum',
        'price' => 15990,
        'image' => asset('images/ShopPage/Products/shop-item-1.jpg'),
    ],
];

$discountedPrice = $product['price'] - round(($product['price'] * $product['discount']) / 100);

if (!function_exists('product_details_format_price')) {
    function product_details_format_price(int $price): string
    {
        return number_format($price, 0, ',', '.') . ' RSD';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php echo $__env->make('components.shared.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="bg-stone-50 text-main-color-shade">
    <?php echo $__env->make('components.user.fixed.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main>
        <section
            class="border-b border-black/10 bg-gradient-to-br from-stone-950 via-neutral-900 to-stone-800 text-secondary-color">
            <div class="mx-auto flex max-w-7xl flex-col gap-5 px-6 py-14 lg:px-12 lg:py-20">
                <p class="text-sm uppercase tracking-[0.35em] text-white/60">Perfume Details</p>
                <div class="flex flex-col gap-4 lg:max-w-3xl">
                    <div class="flex flex-wrap items-center gap-3 text-sm text-white/70">
                        <a href="<?php echo e(route('homePage')); ?>" class="transition hover:text-white">Pocetna</a>
                        <span>/</span>
                        <a href="<?php echo e(route('shopPage')); ?>" class="transition hover:text-white">Shop</a>
                        <span>/</span>
                        <span class="text-white">
                            <?php echo e($product['brand'] . ' ' . $product['title']); ?>
                        </span>
                    </div>

                    <h1 class="text-4xl leading-tight font-semibold sm:text-5xl">
                        <?php echo e($product['brand'] . ' ' . $product['title']); ?>
                    </h1>

                    <p class="max-w-2xl text-lg leading-8 text-white/75">
                        <?php echo e($product['description']); ?>
                    </p>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-12 lg:px-12 lg:py-16">
            <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
                <div class="space-y-5">
                    <div class="overflow-hidden rounded-[2rem] bg-white shadow-my-shadow">
                        <div class="bg-gradient-to-br from-stone-100 via-white to-stone-200 p-8 sm:p-12">
                            <img src="<?php echo e($product['images'][0]); ?>"
                                alt="<?php echo e($product['brand'] . ' ' . $product['title']); ?>"
                                class="mx-auto aspect-square w-full max-w-md object-contain">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <?php foreach ($product['images'] as $index => $image): ?>
                            <div
                                class="overflow-hidden rounded-3xl border <?php echo $index === 0 ? 'border-black bg-stone-100' : 'border-black/10 bg-white'; ?> p-4">
                                <img src="<?php echo e($image); ?>"
                                    alt="<?php echo e($product['brand'] . ' thumbnail ' . ($index + 1)); ?>"
                                    class="aspect-square w-full object-contain">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[2rem] bg-white p-7 shadow-my-shadow sm:p-9">
                        <div class="mb-5 flex flex-wrap items-center gap-3">
                            <span
                                class="rounded-full bg-black px-4 py-2 text-xs uppercase tracking-[0.25em] text-white">
                                <?php echo e($product['gender']); ?>
                            </span>
                            <span
                                class="rounded-full border border-black/10 px-4 py-2 text-xs uppercase tracking-[0.25em] text-black/70">
                                <?php echo e($product['waterType']); ?>
                            </span>
                            <span
                                class="rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs uppercase tracking-[0.2em] text-emerald-700">
                                -
                                <?php echo e($product['discount']); ?>%
                            </span>
                        </div>

                        <div class="flex flex-wrap items-end gap-4 border-b border-black/10 pb-6">
                            <div class="flex items-center gap-3">
                                <span class="text-4xl font-semibold">
                                    <?php echo e(product_details_format_price($discountedPrice)); ?>
                                </span>
                                <s class="text-lg text-black/45">
                                    <?php echo e(product_details_format_price($product['price'])); ?>
                                </s>
                            </div>
                            <span class="text-sm text-black/55">PDV ukljucen u cenu</span>
                        </div>

                        <div class="grid gap-4 py-6 sm:grid-cols-2">
                            <div class="rounded-3xl bg-stone-100 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-black/45">Militraza</p>
                                <p class="mt-2 text-xl">
                                    <?php echo e($product['volume']); ?>
                                </p>
                            </div>
                            <div class="rounded-3xl bg-stone-100 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-black/45">Trajnost</p>
                                <p class="mt-2 text-xl">
                                    <?php echo e($product['longevity']); ?>
                                </p>
                            </div>
                            <div class="rounded-3xl bg-stone-100 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-black/45">Koncentracija</p>
                                <p class="mt-2 text-xl">
                                    <?php echo e($product['concentration']); ?>
                                </p>
                            </div>
                            <div class="rounded-3xl bg-stone-100 p-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-black/45">Poreklo</p>
                                <p class="mt-2 text-xl">
                                    <?php echo e($product['origin']); ?>
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex flex-col gap-4 border-t border-black/10 pt-6 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-black/50">Ocena kupaca</p>
                                <p class="text-lg">
                                    <?php echo e(number_format($product['rating'], 1)); ?> / 5 <span
                                        class="text-black/45">(
                                        <?php echo e($product['reviews']); ?> recenzija)
                                    </span>
                                </p>
                            </div>
                            <div class="flex gap-3">
                                <button class="btn">Dodaj u korpu</button>
                                <button
                                    class="rounded-sm border border-main-color-shade px-6 py-3 transition hover:bg-black hover:text-white">
                                    Sacuvaj
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <?php foreach ($product['highlights'] as $highlight): ?>
                            <div class="rounded-[1.75rem] border border-black/10 bg-white p-5 shadow-sm">
                                <p class="text-sm leading-7 text-black/75">
                                    <?php echo e($highlight); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-14">
            <div class="mx-auto grid max-w-7xl gap-8 px-6 lg:grid-cols-[1fr_0.9fr] lg:px-12">
                <div class="rounded-[2rem] border border-black/10 p-8">
                    <p class="text-sm uppercase tracking-[0.3em] text-black/45">Opis mirisa</p>
                    <p class="mt-5 text-lg leading-8 text-black/75">
                        <?php echo e($product['description']); ?>
                    </p>

                    <div class="mt-8 grid gap-5 sm:grid-cols-3">
                        <?php foreach ($product['notes'] as $note): ?>
                            <div class="rounded-3xl bg-stone-100 p-5">
                                <p class="text-sm leading-7 text-black/75">
                                    <?php echo e($note); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-stone-950 p-8 text-white">
                    <p class="text-sm uppercase tracking-[0.3em] text-white/45">Detalji proizvoda</p>
                    <div class="mt-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <span class="text-white/60">SKU</span>
                            <span>
                                <?php echo e($product['sku']); ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <span class="text-white/60">Brand</span>
                            <span>
                                <?php echo e($product['brand']); ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <span class="text-white/60">Pol</span>
                            <span class="capitalize">
                                <?php echo e($product['gender']); ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <span class="text-white/60">Tip</span>
                            <span>
                                <?php echo e($product['waterType']); ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-white/60">Dostava</span>
                            <span>4 do 7 dana</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-14 lg:px-12">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-black/45">Predlozi</p>
                    <h2 class="mt-2 text-3xl font-semibold">Slicni parfemi</h2>
                </div>
                <a href="<?php echo e(route('shopPage')); ?>"
                    class="text-sm uppercase tracking-[0.2em] text-black/55 transition hover:text-black">
                    Pogledaj shop
                </a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                    <article class="rounded-[2rem] bg-white p-7 shadow-my-shadow">
                        <div class="rounded-[1.75rem] bg-stone-100 p-6">
                            <img src="<?php echo e($relatedProduct['image']); ?>"
                                alt="<?php echo e($relatedProduct['brand'] . ' ' . $relatedProduct['title']); ?>"
                                class="mx-auto aspect-square w-full max-w-[220px] object-contain">
                        </div>
                        <div class="mt-6 space-y-2">
                            <p class="text-2xl">
                                <?php echo e($relatedProduct['brand'] . ' ' . $relatedProduct['title']); ?>
                            </p>
                            <div class="flex flex-wrap gap-3 text-sm text-black/55">
                                <span>
                                    <?php echo e($relatedProduct['gender']); ?>
                                </span>
                                <span>/</span>
                                <span>
                                    <?php echo e($relatedProduct['waterType']); ?>
                                </span>
                            </div>
                            <p class="pt-2 text-lg font-medium">
                                <?php echo e(product_details_format_price($relatedProduct['price'])); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php echo $__env->make('components.shared.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>