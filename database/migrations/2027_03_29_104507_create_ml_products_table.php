<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ml_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // drzi referencu ka ml i products
            // Ovde mora postojati kompozitni kljuc koji cine ml_id i product_id, jer moze da se desi da imam proizvod 1 i ml 1 pa opet proizvod 1 i ml 1 a to ne bi smelo
            $table->foreignId('ml_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->unique(['product_id', 'ml_id']);

            //         Product::factory() // za 1 proizvod kreira record u mls tabeli i 
            // ->create()
            // ->mls()
            // ->attach(
            //     Ml::take(3)->pluck('id')
            // );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_products');
    }
};
