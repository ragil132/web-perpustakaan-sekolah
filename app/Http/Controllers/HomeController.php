<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Anggota;
use App\Buku;
use App\Peminjaman;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $anggota    = Anggota::get();
        $buku       = Buku::get();
        $peminjaman = Peminjaman::get();

        if (Auth::user()->level == 'user') {
            $data = Peminjaman::where('status', 'pinjam')
                ->where('anggota_id', Auth::user()->anggota->id)
                ->get();
        } else {
            $data = Peminjaman::where('status', 'pinjam')->get();
        }
        return view('home', compact('peminjaman', 'anggota', 'buku', 'data'));
    }
}
