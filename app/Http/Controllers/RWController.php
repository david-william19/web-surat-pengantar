<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\RukunWarga;
use Yajra\DataTables\Facades\DataTables;

class RWController extends Controller
{
    function viewListKeluarga($id){
        $rw = RukunWarga::findOrFail($id);
        $keluarga  = Keluarga::where('rw','=',$id)->get();
        return view('rw.list_keluarga')->with(compact('rw','keluarga'));
    }

    function listKeluarga(){
        return Keluarga::all();
    }

    function getKeluargaAjax(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = Keluarga::select('*')
                ->where('rw', '=', $id)
                ->orderBy('created_at', 'ASC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img style="border-radius:10px !important" class="center-cropped rounded" src="' . url('/') . $row->photo_kartu_keluarga . '" alt="">';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("keluarga/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->addColumn('detail', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("keluarga/$row->id/detail") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Lihat Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action','img','detail'])
                ->make(true);
        }
    }

    function viewChangePassword($id)
    {
        $rw = RukunWarga::findOrFail($id);
        return view('rw.change_password')->with(compact('rw'));
    }

    function changePassword($id, Request $request)
    {
        $user_id = $id;
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);
        $user = Keluarga::findOrFail($user_id);
        $hasher = app('hash');

        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            return back()->with(["error" => "Password Lama Tidak Sesuai"]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            if ($user) {
                return back()->with(["success" => "Password Berhasil Diperbarui"]);
            } else {
                return back()->with(["error" => "Password Gagal Diperbarui"]);
            }
        }
    }

}
