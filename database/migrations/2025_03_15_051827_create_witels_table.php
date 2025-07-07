<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('witels', function (Blueprint $table) {
            $table->string('id_witel')->primary();
            $table->string('nama_witel');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('witels');
    }
};

