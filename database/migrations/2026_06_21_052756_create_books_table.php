<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
   {
    Schema::create('books', function (Blueprint $table) {

        $table->id('id_buku');

        $table->string('judul');

        $table->string('penulis');

        $table->string('penerbit');

        $table->integer('tahun_terbit');

        $table->text('sinopsis');

        $table->timestamps();

    });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};