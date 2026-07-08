<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('loans', function (Blueprint $table) {

        $table->id('id_peminjaman');

        $table->unsignedBigInteger('id_buku');

        $table->string('NIM',15);

        $table->unsignedBigInteger('id_user');

        $table->date('tanggal_pinjam');

        $table->date('tanggal_kembali');

        $table->enum('status',[
            'dipinjam',
            'dikembalikan',
            'hilang',
            'terlambat'
        ]);

        $table->text('catatan')->nullable();

        $table->timestamps();

        $table->foreign('id_buku')
              ->references('id_buku')
              ->on('books')
              ->onDelete('cascade');

        $table->foreign('NIM')
              ->references('NIM')
              ->on('members')
              ->onDelete('cascade');

        $table->foreign('id_user')
              ->references('id_user')
              ->on('users')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
