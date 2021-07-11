<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use App\Anggota;
use App\Peminjaman;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 'user') {
            $data = Peminjaman::where('anggota_id', Auth::user()->anggota->id)
                ->get();
        } else {
            $data = Peminjaman::get();
        }
        return view('peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getRow = Peminjaman::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PM00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PM0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PM000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PM00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PM0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PM" . '' . ($lastId->id + 1);
            }
        }

        $buku = Buku::where('jumlah_buku', '>', 0)->where('jenis', '!=', 'eksternal')->get();
        $anggota = Anggota::get();
        return view('peminjaman.create', compact('buku', 'kode', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_peminjaman' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',

        ]);

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => $request->get('kode_peminjaman'),
            'tgl_pinjam' => $request->get('tgl_pinjam'),
            'tgl_kembali' => $request->get('tgl_kembali'),
            'buku_id' => $request->get('buku_id'),
            'anggota_id' => $request->get('anggota_id'),
            'ket' => $request->get('ket'),
            'status' => 'pinjam'
        ]);

        $peminjaman->buku->where('id', $peminjaman->buku_id)
            ->update([
                'jumlah_buku' => ($peminjaman->buku->jumlah_buku - 1),
            ]);

        alert()->success('Berhasil', 'Buku telah dipinjam');
        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Peminjaman::findOrFail($id);


        if ((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }


        return view('peminjaman.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Peminjaman::findOrFail($id);

        if ((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        return view('peminjaman.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        $peminjaman->update([
            'status' => 'kembali'
        ]);

        $peminjaman->buku->where('id', $peminjaman->buku->id)
            ->update([
                'jumlah_buku' => ($peminjaman->buku->jumlah_buku + 1),
            ]);

        alert()->success('Berhasil', 'Data peminjaman telah diupdate');
        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Peminjaman::find($id)->delete();

        $response = "Berhasil";
        echo json_encode($response);
    }
}
