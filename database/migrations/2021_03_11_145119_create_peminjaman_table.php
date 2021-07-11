<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_peminjaman');
            $table->integer('anggota_id')->unsigned();
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->integer('buku_id')->unsigned();
            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['pinjam', 'kembali']);
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
