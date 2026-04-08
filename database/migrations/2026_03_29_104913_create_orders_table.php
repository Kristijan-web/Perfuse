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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('adress');
            $table->string('city');
            $table->string('postal_code');
            $table->text('note')->nullable();
            $table->integer("total_price");
            $table->integer("total_quantity");
            $table->foreignId("user_id")->constrained();
            $table->softDeletes();

            // MORA DA IZMENIM nece id usera biti u orderline nego u order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
