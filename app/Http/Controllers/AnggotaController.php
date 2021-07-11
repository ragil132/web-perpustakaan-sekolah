<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Anggota;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
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

        $data = Anggota::get();
        return view('anggota.index', compact('data'));
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

        $users = User::WhereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('anggota')
                ->whereRaw('anggota.user_id = users.id');
        })->get();
        return view('anggota.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Anggota::where('nis', $request->input('nis'))->count();

        if ($count > 0) {
            alert()->warning('Perhatian', 'NIS tidak boleh sama');
            return back()->withInput();
        }

        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:anggota'
        ]);

        Anggota::create($request->all());

        alert()->success('Berhasil', 'Data sudah disimpan');
        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        $data = Anggota::findOrFail($id);

        return view('anggota.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Alert::info('Maaf, anda tidak punya hak akses untuk melihat halaman ini');
            return back();
        }

        $data = Anggota::findOrFail($id);
        $users = User::get();
        return view('anggota.edit', compact('data', 'users'));
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
        $ceknis = Anggota::where('nis', $request->get('nis'))
            ->whereNotIn('id', [$id])
            ->get();
        if (count($ceknis) > 0){
            alert()->warning('Perhatian', 'NIS tidak boleh sama');
            return back()->withInput();
        }
        
        Anggota::find($id)->update($request->all());

        alert()->success('Berhasil', 'Data sudah diupdate');
        return redirect()->to('anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::find($id)->delete();

        $response = "Berhasil";
        echo json_encode($response);
    }
}
