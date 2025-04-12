<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pricing', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('witel_id');
            $table->uuid('sto_id');
            $table->uuid('subpaket_id');
            $table->decimal('material_price', 10, 2);
            $table->decimal('jasa_price', 10, 2);
            $table->timestamps();

            $table->foreign('witel_id')->references('id')->on('witels')->onDelete('cascade');
            $table->foreign('sto_id')->references('id')->on('stos')->onDelete('cascade');
            $table->foreign('subpaket_id')->references('id')->on('subpakets')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('pricing');
    }
};

