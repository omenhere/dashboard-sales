<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bundlings', function (Blueprint $table) {
            $table->string('id_bundling')->primary();
            $table->string('name_bundling');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bundlings');
    }
};
