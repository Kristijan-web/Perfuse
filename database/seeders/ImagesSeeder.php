<?php

namespace Database\Seeders;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageDirectory = public_path('images/ShopPage/Produts');

        if (!File::exists($imageDirectory)) {
            $imageDirectory = public_path('images/ShopPage/Products');
        }

        $imageFiles = collect(File::files($imageDirectory))
            ->sortBy(fn($file) => $file->getFilename())
            ->values();

        $productIds = Product::query()
            ->orderBy('id')
            ->pluck('id')
            ->values();

        if ($imageFiles->isEmpty() || $productIds->isEmpty()) {
            return;
        }

        $imageRows = [];
        $productCount = $productIds->count();

        foreach ($imageFiles as $index => $file) {
            $productIndex = intdiv($index, 2) % $productCount;
            $imageRows[] = [
                'path' => 'images/ShopPage/Products/' . $file->getFilename(),
                'product_id' => $productIds[$productIndex],
                'is_main_image' => $index % 2 === 0 ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Images::query()->insert($imageRows);
    }
}
