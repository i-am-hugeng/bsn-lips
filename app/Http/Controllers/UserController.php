<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataUsers;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function dataPengelolaView()
    {
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();



        $users = User::all();

        return view('admin.data-master.data-pengelola', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','users'
        ));
    }

    public function updatePengelola(Request $request)
    {
        // dd($request->all());

        $user = User::findOrFail($request->id_pengelola);
        // dd($user->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        // dd($user->name);
        Alert::success('Data Berhasil Dirubah');
        return redirect()->back();
    }
}
