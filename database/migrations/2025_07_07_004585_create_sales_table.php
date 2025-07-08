<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('id_witel');
            $table->string('id_sto');
            $table->string('id_product');
            $table->integer('quantity')->nullable();

            $table->timestamps();

            $table->foreign('id_witel')->references('id_witel')->on('witels')->onDelete('cascade');
            $table->foreign('id_sto')->references('id_sto')->on('stos')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');

            $table->index(['id_witel', 'id_sto', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
