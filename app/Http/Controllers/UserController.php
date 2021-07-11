<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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

        $data = User::get();
        return view('auth.user', compact('data'));
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
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = User::where('username', $request->input('username'))->count();

        if ($count > 0) {
            alert()->warning('Perhatian', 'Username tidak boleh sama');
            return back()->withInput();
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if ($request->file('gambar') == '') {
            $gambar = NULL;
        } else {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $gambar = $fileName;
        }

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
            'password' => Hash::make(($request->input('password'))),
            'gambar' => $gambar
        ]);

        alert()->success('Berhasil', 'Data user telah disimpan');
        return redirect()->route('user.index');
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

        $data = User::findOrFail($id);

        return view('auth.show', compact('data'));
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

        $data = User::findOrFail($id);

        return view('auth.edit', compact('data'));
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
        $user_data = User::findOrFail($id);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $user_data->gambar = $fileName;
        }

        $user_data->name = $request->input('name');
        $user_data->email = $request->input('email');
        if ($request->input('password')) {
            $user_data->level = $request->input('level');
        }

        if ($request->input('password')) {
            $user_data->password = Hash::make(($request->input('password')));
        }

        $user_data->update();

        alert()->success('Berhasil', 'Data user telah diupdate');
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            $user_data = User::findOrFail($id);
            $user_data->delete();

            $response = "Berhasil";
            echo json_encode($response);
        } else {
            $response = "Gagal";
            echo json_encode($response);
        }
    }
}
