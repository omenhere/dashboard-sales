<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('stos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('witel_id');
            $table->string('name', 50)->unique();
            $table->integer('kpi')->nullable(); // kolom KPI ditambahkan
            $table->timestamps();

            $table->foreign('witel_id')->references('id')->on('witels')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('stos');
    }
};

