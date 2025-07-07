<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stos', function (Blueprint $table) {
            $table->string('id_sto')->primary();
            $table->string('nama_sto');
            $table->string('id_witel');
            $table->foreign('id_witel')->references('id_witel')->on('witels')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('stos');
    }
};

