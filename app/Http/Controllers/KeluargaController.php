<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{

    public function dashboard()
    {
        $getRT = RukunTetangga::all();

        $rt = array();
        foreach ($getRT as $key) {
            $rw = RukunWarga::find($key->id_rw);
            $rt[] = [
                "id_rt" => $key->id,
                "kode_rt" => $key->kode,
                "kontak" => $key->kontak,
                "id_rw" => $rw->id,
                "kode_rw" => $rw->kode,
            ];
        }

        $keluarga = Keluarga::find(Auth::guard('keluarga')->id());
        $widget = [
            "keluarga" => $keluarga,
            "rt" => $rt,
        ];
        return view('keluarga.dashboard.home')->with(compact('widget'));
    }



    public function keluargaRegister(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'rt' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = new Keluarga();
        $object->nama = $request->nama;
        $object->rt = $request->rt;
        $object->kontak = $request->kontak;
        $object->password = bcrypt($request->password);
        $object->alamat = $request->alamat;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mendaftarkan Keluarga, Silakan Login Dengan Kontak $object->kontak dan password saat registrasi"]);
        } else {
            return back()->with(["error" => "Gagal Mendaftar, Hubungi Admin atau Silakan Coba Lagi Nanti"]);
        }

        // id	nama	password	no_kk	kontak	alamat	photo_kartu_keluarga	rt	
        return $request->all();
    }

    function isRTExist($id)
    {
        if (RukunTetangga::find($id) == null) {
            return false;
        } else {
            return true;
        }
    }


    public function keluargaUpdate(Request $request)
    {
        $id = ($request->id);
        $rules = [
            'nama' => 'required',
            'rt' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = Keluarga::find($id);

        if ($object == null) {
            return back()->with(["error" => "ID Keluarga Tidak Ditemukan"]);
        }

        $object->nama = $request->nama;
        $object->rt = $request->rt;
        $object->kontak = $request->kontak;
        $object->alamat = $request->alamat;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Keluarga"]);
        }

        // id	nama	password	no_kk	kontak	alamat	photo_kartu_keluarga	rt	
        return $request->all();
    }

    function changeKKPhoto(Request $request)
    {
        $id = $request->id;
        $user = Keluarga::findOrFail($id);

        if ($request->hasFile('photo')) {
            $file_path = public_path() . $user->photo_path;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $user->id . '.' . $extension;

            $savePath = "/web_files/photo_kk/$id/";
            $savePathDB = "/web_files/photo_kk/$id/$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $user->photo_kartu_keluarga = $savePathDB;
            $user->save();

            if ($user) {
                return back()->with(["success" => "Berhasil Mengupdate Foto Kartu Keluarga"]);
            } else {
                return back()->with(["error" => "Gagal Mengupdate Foto Kartu Keluarga"]);
            }
        }
    }


    //member section

    public function storeMember(Request $request)
    {
        $id = ($request->id);
        $rules = [
            'nama' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'photo' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $photoPath = "";
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/anggota_keluarga/";
            $savePathDB = "/web_files/anggota_keluarga/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
        }


        $object = new AnggotaKeluarga();
        $object->nik = $request->nik;
        $object->id_keluarga = $request->id;
        $object->nama = $request->nama;
        $object->gender = $request->gender;
        $object->tempat_lahir = $request->tempat_lahir;
        $object->tanggal_lahir = $request->tanggal_lahir;
        $object->agama = $request->agama;
        $object->pendidikan = $request->pendidikan;
        $object->pekerjaan = $request->pekerjaan;
        $object->current_address = $request->alamat;
        $object->path_ktp = $photoPath;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Anggota Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Anggota Keluarga"]);
        }
    }

    public function updateMember(Request $request,$id)
    {
        $object = AnggotaKeluarga::findOrFail($id);

        $id = ($request->id);
        $rules = [
            'nama' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $photoPath = "";
        if ($request->hasFile('photo')) {

            $file_path = public_path().$object->path_ktp;
            if (file_exists($file_path)) {
                try{
                    unlink($file_path);
                }catch(Exception $e){

                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/anggota_keluarga/";
            $savePathDB = "/web_files/anggota_keluarga/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
        }


        $object = AnggotaKeluarga::find($id);
        $object->nik = $request->nik;
        $object->id_keluarga = $request->id;
        $object->nama = $request->nama;
        $object->gender = $request->gender;
        $object->tempat_lahir = $request->tempat_lahir;
        $object->tanggal_lahir = $request->tanggal_lahir;
        $object->agama = $request->agama;
        $object->pendidikan = $request->pendidikan;
        $object->pekerjaan = $request->pekerjaan;
        $object->current_address = $request->alamat;
        $object->path_ktp = $photoPath;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Anggota Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Anggota Keluarga"]);
        }
    }

    public function viewAddMember(Request $request)
    {
        $widget = [];
        return view('anggota_keluarga.keluarga_add')->with(compact('widget'));
    }

    public function viewManageMember(Request $request)
    {
        $widget = [];
        $anggotaKeluarga = AnggotaKeluarga::where("id_keluarga", "=", Auth::guard('keluarga')->id())->get();
        return view('anggota_keluarga.keluarga_manage')->with(compact('anggotaKeluarga'));
    }

    function viewEdit(Request $request, $id)
    {
        $member = AnggotaKeluarga::findOrFail($id);
        return view('anggota_keluarga.keluarga_edit')->with(compact('member'));
    }

    function deleteMemberAjax(Request $request,$id){
        $object = AnggotaKeluarga::findOrFail($id);
        $file_path = public_path().$object->path_ktp;
        if (file_exists($file_path)) {
            try{
                unlink($file_path);
            }catch(Exception $e){
                //Do Nothing
            }
        }

        $object->delete();
        
        if($object){
            return 1;
        }else{
            return 0;
        }
    }

    function getAnggotaAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = AnggotaKeluarga::select('*')
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img style="border-radius:10px !important" class="center-cropped rounded" src="' . url('/') . $row->path_ktp . '" alt="">';
                    return $img;
                })
                ->addColumn('gender', function ($row) {
                    if ($row->gender == "1") {
                        return "Laki-Laki";
                    } else {
                        return "Perempuan";
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("member/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'gender', 'img'])
                ->make(true);
        }
    }
}
