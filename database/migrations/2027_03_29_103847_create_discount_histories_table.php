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
        Schema::create('discount_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // ovde ce created_at vise sluziti za informaciju kada je discount edit-ovan
            $table->foreignId('product_id')->constrained();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('was_removed');
            $table->integer('discount');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_histories');
    }
};
