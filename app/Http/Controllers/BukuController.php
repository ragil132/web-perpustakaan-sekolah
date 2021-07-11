<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
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
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        $data = Buku::get();
        return view('buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 'user') {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        return view('buku.create');
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
            'kode' => 'required|string',
            'judul' => 'required|string|max:255'
        ]);

        $cekkode = Buku::where('kode', $request->get('kode'))->get();
        if ( count($cekkode) > 0){
            alert()->warning('Perhatian', 'Kode buku tidak boleh sama');
            return back()->withInput();
        }

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Buku::create([
            'kode' => $request->get('kode'),
            'judul' => $request->get('judul'),
            'jenis' => $request->get('jenis'),
            'pengarang' => $request->get('pengarang'),
            'penerbit' => $request->get('penerbit'),
            'cetakan' => $request->get('cetakan'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_buku' => $request->get('jumlah_buku'),
            'keterangan' => $request->get('keterangan'),
            'cover' => $cover,
            'tautan' => $request->get('tautan')
        ]);

        alert()->success('Berhasil', 'Data buku telah disimpan');

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->level == 'user') {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        $data = Buku::findOrFail($id);

        return view('buku.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 'user') {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        $data = Buku::findOrFail($id);
        return view('buku.edit', compact('data'));
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
        if ($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = $request->get('foto_lama');
        }

        $cekkode = Buku::where('kode', $request->get('kode'))
            ->whereNotIn('id', [$id])
            ->get();
        if (count($cekkode) > 0){
            alert()->warning('Perhatian', 'Kode buku tidak boleh sama');
            return back()->withInput();
        }

        Buku::find($id)->update([
            'kode' => $request->get('kode'),
            'judul' => $request->get('judul'),
            'jenis' => $request->get('jenis'),
            'pengarang' => $request->get('pengarang'),
            'penerbit' => $request->get('penerbit'),
            'cetakan' => $request->get('cetakan'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_buku' => $request->get('jumlah_buku'),
            'keterangan' => $request->get('keterangan'),
            'cover' => $cover,
            'tautan' => $request->get('tautan')
        ]);

        alert()->success('Berhasil', 'Data buku telah diupdate');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();

        $response = "Berhasil";
        echo json_encode($response);
    }
}
