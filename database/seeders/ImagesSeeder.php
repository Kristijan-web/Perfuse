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
        $imageCount = $imageFiles->count();
        $timestamp = now();

        foreach ($productIds as $index => $productId) {
            if ($index >= $imageCount) {
                break;
            }

            $imageRows[] = [
                'path' => 'images/ShopPage/Products/' . $imageFiles[$index]->getFilename(),
                'product_id' => $productId,
                'is_main_image' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        for ($index = $productCount; $index < $imageCount; $index++) {
            $productIndex = $index - $productCount;

            if ($productIndex >= $productCount) {
                break;
            }

            $imageRows[] = [
                'path' => 'images/ShopPage/Products/' . $imageFiles[$index]->getFilename(),
                'product_id' => $productIds[$productIndex],
                'is_main_image' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        Images::query()->insert($imageRows);
    }
}
