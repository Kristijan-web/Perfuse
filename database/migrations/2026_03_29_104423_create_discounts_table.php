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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // treba mi discount vrednost
            // treba mi start i end date discount-a

            // Uvek se pitaj
            // - Da li kolona moze imati vrednost null (Da li ima smisla da vrednost ne postoji)
            // - Ako kolona referencira drugu, da li obrisati tu kolonu ako se referenca obrise ili da joj vrednost setujem na NULL

            $table->integer('discount');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
