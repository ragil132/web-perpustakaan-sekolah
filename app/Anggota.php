<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $fillable = ['user_id', 'nis', 'nama', 'kelas', 'tempat_lahir', 'tgl_lahir', 'jk', 'jurusan'];


    /**
     * Method One To One 
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * Method One To Many 
     */
    public function peminjaman()
    {
    	return $this->hasMany(Peminjaman::class);
    }
}
