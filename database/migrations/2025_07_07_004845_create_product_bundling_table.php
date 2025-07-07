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
        Schema::create('product_bundling', function (Blueprint $table) {
            $table->string('id_product');
            $table->string('id_bundling');

            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->foreign('id_bundling')->references('id_bundling')->on('bundlings')->onDelete('cascade');

            $table->primary(['id_product', 'id_bundling']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_bundling');
    }
};
