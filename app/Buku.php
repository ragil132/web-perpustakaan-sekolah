<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = ['kode','judul', 'jenis', 'penerbit', 'pengarang', 'tahun_terbit', 'cetakan', 'jumlah_buku', 'keterangan', 'cover', 'tautan'];

    /**
     * Method One To Many 
     */
    public function peminjaman()
    {
    	return $this->hasMany(Peminjaman::class);
    }
}
