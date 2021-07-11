<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use App\Peminjaman;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BacabukuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Buku::where('jenis', 'eksternal')->get();
        return view('bacaBuku.index', compact('data'));
    }

    public function cetakqrcode($id)
    {
        $data = Buku::where('id', $id)->get();
        foreach ($data as $d) {
            $url = $d->tautan;
            $judul = $d->judul;

            $pdf = PDF::loadview('qrcode.bacalangsung', ['url' => $url, 'judul' => $judul]);
            return $pdf->stream('qrcode.pdf');
        }
    }

    public function cetakqrcodeCollection($id)
    {

        $url = url($id);

        $pdf = PDF::loadview('qrcode.bacabuku', ['url' => $url]);
        return $pdf->stream('qrcodeCollection.pdf');
    }

    public function kembali($id)
    {
        if (Auth::user()->level == 'user') {
            $peminjaman = Peminjaman::find($id);

            $peminjaman->update([
                'status' => 'verf_kemb'
            ]);

            $response = "Berhasil";
            echo json_encode($response);
        } else {

            $peminjaman = Peminjaman::find($id);

            $peminjaman->update([
                'status' => 'kembali',
                'tgl_kembali' => date('Y-m-d', strtotime(Carbon::today()))
            ]);

            $peminjaman->buku->where('id', $peminjaman->buku->id)
                ->update([
                    'jumlah_buku' => ($peminjaman->buku->jumlah_buku + 1),
                ]);

            $response = "Berhasil";
            echo json_encode($response);
        }
    }

    public function belumkembali($id)
    {
        $peminjaman = Peminjaman::find($id);

        $peminjaman->update([
            'status' => 'pinjam'
        ]);

        $response = "Berhasil";
        echo json_encode($response);
    }

    public function getnama()
    {
        $nama = Auth::user()->name;

        $response = $nama;
        echo json_encode($response);
    }
}
