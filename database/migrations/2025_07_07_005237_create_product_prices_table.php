<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id(); 
            $table->string('id_product');
            $table->string('id_witel');
            $table->decimal('harga_jasa', 15, 2);

            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->foreign('id_witel')->references('id_witel')->on('witels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
