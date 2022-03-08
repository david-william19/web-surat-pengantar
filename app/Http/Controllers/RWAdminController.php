<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class RWAdminController extends Controller
{
    function viewAdminManage(Request $request)
    {
        if ($request->ajax()) {
            $data = RukunWarga::select('*')
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img class="center-cropped rounded" src="' . "ss" . '" alt="">';
                    return $img;
                })
                ->addColumn('rt', function ($row) {
                    $countRT = RukunTetangga::where('id_rw', '=', $row->id)->count();
                    return $countRT;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("rw/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->addColumn('warga', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("rw/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })

                ->rawColumns(['action', 'img', 'warga'])
                ->make(true);
        }

        return view('rw.admin_manage');
    }

    function viewEdit(Request $request, $id)
    {
        $rw = RukunWarga::findOrFail($id);
        return view('rw.admin_edit')->with(compact('rw'));
    }


    function insertAjax(Request $request)
    {
        $object = new RukunWarga();
        $object->kode = $request->kode;
        $object->kontak = $request->contact;
        $object->nama = $request->nama;
        $object->status = "active";
        $object->password = bcrypt($request->password);
        $object->save();

        $rw = RukunWarga::all()->count();
        if ($object) {
            return $rw;
        } else {
            return 0;
        }
    }

    function deleteAjax(Request $request, $id)
    {
        $object = RukunWarga::findOrFail($id);
        $object->delete();
        if ($object) {
            return 1;
        } else {
            return 0;
        }
    }

    function viewListData()
    {
        // gender
        $genderM = AnggotaKeluarga::where('jenis_kelamin', 'laki-laki')->count();
        $genderF = AnggotaKeluarga::where('jenis_kelamin', 'perempuan')->count();

        //status_dalam_keluarga
        $statusDKAK = AnggotaKeluarga::where('status_dalam_keluarga', 'Anak Kandung')->count();
        $statusDKS = AnggotaKeluarga::where('status_dalam_keluarga', 'Suami')->count();
        $statusDKI = AnggotaKeluarga::where('status_dalam_keluarga', 'Istri')->count();
        $statusDKKK = AnggotaKeluarga::where('status_dalam_keluarga', 'Kepala Keluarga')->count();
        $statusDKC = AnggotaKeluarga::where('status_dalam_keluarga', 'Cucu')->count();
        $statusDKAA = AnggotaKeluarga::where('status_dalam_keluarga', 'Anak Angkat')->count();
        $statusDKFL = AnggotaKeluarga::where('status_dalam_keluarga', 'Famili Lain')->count();
        $statusDKOT = AnggotaKeluarga::where('status_dalam_keluarga', 'Orang Tua')->count();
        $statusDKNN = AnggotaKeluarga::where('status_dalam_keluarga', 'N/A')->count();

        //status_perkawinan
        $statusPK = AnggotaKeluarga::where('status_perkawinan', 'Kawin')->count();
        $statusPBK = AnggotaKeluarga::where('status_perkawinan', 'Belum Kawin')->count();
        $statusPD = AnggotaKeluarga::where('status_perkawinan', 'Duda')->count();
        $statusPJ = AnggotaKeluarga::where('status_perkawinan', 'Janda')->count();

        //agama
        $agamaK = AnggotaKeluarga::where('agama', 'Kristen')->count();
        $agamaI = AnggotaKeluarga::where('agama', 'Islam')->count();
        $agamaH = AnggotaKeluarga::where('agama', 'Hindu')->count();
        $agamaB = AnggotaKeluarga::where('agama', 'Budha')->count();
        $agamaKO = AnggotaKeluarga::where('agama', 'Konghucu')->count();
        $agamaYME = AnggotaKeluarga::where('agama', 'Aliran Kepercayaan Kepada Tuhan YME')->count();
        $agamaAKL = AnggotaKeluarga::where('agama', 'Aliran Kepercayaan Lainnya')->count();
        $agamaNN = AnggotaKeluarga::where('agama', 'N/A')->count();

        //golongan_darah
        $golonganDA = AnggotaKeluarga::where('golongan_darah', 'A')->count();
        $golonganDB = AnggotaKeluarga::where('golongan_darah', 'B')->count();
        $golonganDAB = AnggotaKeluarga::where('golongan_darah', 'AB')->count();
        $golonganDO = AnggotaKeluarga::where('golongan_darah', 'O')->count();
        $golonganDNN = AnggotaKeluarga::where('golongan_darah', 'N/A')->count();

        //kewarganegaraan
        $kewarganegaraanWNI = AnggotaKeluarga::where('kewarganegaraan', 'WNI')->count();
        $kewarganegaraanWNA = AnggotaKeluarga::where('kewarganegaraan', 'WNA')->count();

        //pendidikan
        $pendidikanBMTK = AnggotaKeluarga::where('pendidikan', 'Belum Masuk TK')->count();
        $pendidikanSP = AnggotaKeluarga::where('pendidikan', 'Sedang Paud')->count();
        $pendidikanSTK = AnggotaKeluarga::where('pendidikan', 'Sedang TK')->count();
        $pendidikanTS = AnggotaKeluarga::where('pendidikan', 'Tidak Pernah Sekolah')->count();
        $pendidikanSSD = AnggotaKeluarga::where('pendidikan', 'Sedang SD/Sederajat')->count();
        $pendidikanTSD = AnggotaKeluarga::where('pendidikan', 'Tamat SD/Sederajat')->count();
        $pendidikanSSLTP = AnggotaKeluarga::where('pendidikan', 'Sedang SLTP/Sederajat')->count();
        $pendidikanTSLTP = AnggotaKeluarga::where('pendidikan', 'Tamat SLTP/Sederajat')->count();
        $pendidikanSSLTA = AnggotaKeluarga::where('pendidikan', 'Sedang SLTA/Sederajat')->count();
        $pendidikanTSLTA = AnggotaKeluarga::where('pendidikan', 'Tamat SLTA/Sederajat')->count();
        $pendidikanSK = AnggotaKeluarga::where('pendidikan', 'Sedang Kuliah')->count();
        $pendidikanSD1 = AnggotaKeluarga::where('pendidikan', 'Sedang D1/Sederajat')->count();
        $pendidikanTD1 = AnggotaKeluarga::where('pendidikan', 'Tamat D1/Sederajat')->count();
        $pendidikanSD2 = AnggotaKeluarga::where('pendidikan', 'Sedang D2/Sederajat')->count();
        $pendidikanTD2 = AnggotaKeluarga::where('pendidikan', 'Tamat D2/Sederajat')->count();
        $pendidikanSD3 = AnggotaKeluarga::where('pendidikan', 'Sedang D3/Sederajat')->count();
        $pendidikanTD3 = AnggotaKeluarga::where('pendidikan', 'Tamat D3/Sederajat')->count();
        $pendidikanSD4 = AnggotaKeluarga::where('pendidikan', 'Sedang D4/Sederajat')->count();
        $pendidikanTD4 = AnggotaKeluarga::where('pendidikan', 'Tamat D4/Sederajat')->count();
        $pendidikanSS1 = AnggotaKeluarga::where('pendidikan', 'Sedang S1/Sederajat')->count();
        $pendidikanTS1 = AnggotaKeluarga::where('pendidikan', 'Tamat S1/Sederajat')->count();
        $pendidikanSS2 = AnggotaKeluarga::where('pendidikan', 'Sedang S2/Sederajat')->count();
        $pendidikanTS2 = AnggotaKeluarga::where('pendidikan', 'Tamat S2/Sederajat')->count();
        $pendidikanSS3 = AnggotaKeluarga::where('pendidikan', 'Sedang S3/Sederajat')->count();
        $pendidikanTS3 = AnggotaKeluarga::where('pendidikan', 'Tamat S3/Sederajat')->count();
        $pendidikanTSLB = AnggotaKeluarga::where('pendidikan', 'Tamat SLB/Sederajat')->count();
        $pendidikanNN = AnggotaKeluarga::where('pendidikan', 'N/A')->count();

        //pekerjaan
        $pekerjaan1 = AnggotaKeluarga::where('pekerjaan', 'Petani')->count(); 
        $pekerjaan2 = AnggotaKeluarga::where('pekerjaan', 'Buruh')->count(); 
        $pekerjaan3 = AnggotaKeluarga::where('pekerjaan', 'Abdi Puskesmas')->count(); 
        $pekerjaan4 = AnggotaKeluarga::where('pekerjaan', 'Imam')->count(); 
        $pekerjaan5 = AnggotaKeluarga::where('pekerjaan', 'Pegawai Negeri Sipil')->count(); 
        $pekerjaan6 = AnggotaKeluarga::where('pekerjaan', 'Karyawan Swasta')->count(); 
        $pekerjaan7 = AnggotaKeluarga::where('pekerjaan', 'Penjahit')->count(); 
        $pekerjaan8 = AnggotaKeluarga::where('pekerjaan', 'Pedagang')->count(); 
        $pekerjaan9 = AnggotaKeluarga::where('pekerjaan', 'Peternak')->count(); 
        $pekerjaan10 = AnggotaKeluarga::where('pekerjaan', 'Nelayan')->count(); 
        $pekerjaan11 = AnggotaKeluarga::where('pekerjaan', 'Montir')->count(); 
        $pekerjaan12 = AnggotaKeluarga::where('pekerjaan', 'Teknisi')->count(); 
        $pekerjaan13 = AnggotaKeluarga::where('pekerjaan', 'Dokter')->count(); 
        $pekerjaan14 = AnggotaKeluarga::where('pekerjaan', 'Perawat')->count(); 
        $pekerjaan15 = AnggotaKeluarga::where('pekerjaan', 'Bidan')->count(); 
        $pekerjaan16 = AnggotaKeluarga::where('pekerjaan', 'TNI')->count(); 
        $pekerjaan17 = AnggotaKeluarga::where('pekerjaan', 'POLRI')->count(); 
        $pekerjaan18 = AnggotaKeluarga::where('pekerjaan', 'SATPOL PP')->count(); 
        $pekerjaan19 = AnggotaKeluarga::where('pekerjaan', 'Petugas Keamanan')->count(); 
        $pekerjaan20 = AnggotaKeluarga::where('pekerjaan', 'Pengusaha kecil, menengah dan besar')->count(); 
        $pekerjaan21 = AnggotaKeluarga::where('pekerjaan', 'Guru')->count(); 
        $pekerjaan22 = AnggotaKeluarga::where('pekerjaan', 'Baby Sitter')->count(); 
        $pekerjaan23 = AnggotaKeluarga::where('pekerjaan', 'Dosen')->count(); 
        $pekerjaan24 = AnggotaKeluarga::where('pekerjaan', 'Seniman/artis')->count(); 
        $pekerjaan25 = AnggotaKeluarga::where('pekerjaan', 'Pedagang Keliling')->count(); 
        $pekerjaan26 = AnggotaKeluarga::where('pekerjaan', 'Pengemudi Becak')->count(); 
        $pekerjaan27 = AnggotaKeluarga::where('pekerjaan', 'Tukang')->count(); 
        $pekerjaan28 = AnggotaKeluarga::where('pekerjaan', 'Tukang Batu')->count(); 
        $pekerjaan29 = AnggotaKeluarga::where('pekerjaan', 'Tukang Kayu')->count(); 
        $pekerjaan30 = AnggotaKeluarga::where('pekerjaan', 'Tukang Las')->count(); 
        $pekerjaan31 = AnggotaKeluarga::where('pekerjaan', 'Tukang Urut')->count(); 
        $pekerjaan32 = AnggotaKeluarga::where('pekerjaan', 'Tukang Emas')->count(); 
        $pekerjaan33 = AnggotaKeluarga::where('pekerjaan', 'Tukang Bentor')->count(); 
        $pekerjaan34 = AnggotaKeluarga::where('pekerjaan', 'Pembantu Rumah Tangga')->count(); 
        $pekerjaan35 = AnggotaKeluarga::where('pekerjaan', 'Pengacara')->count(); 
        $pekerjaan36 = AnggotaKeluarga::where('pekerjaan', 'Notaris')->count(); 
        $pekerjaan37 = AnggotaKeluarga::where('pekerjaan', 'Dukun Tradisional')->count(); 
        $pekerjaan38 = AnggotaKeluarga::where('pekerjaan', 'Arsitektur/Desainer')->count(); 
        $pekerjaan39 = AnggotaKeluarga::where('pekerjaan', 'Karyawan Perusahaan Swasta')->count(); 
        $pekerjaan40 = AnggotaKeluarga::where('pekerjaan', 'Karyawan Perusahaan Pemenrintah')->count(); 
        $pekerjaan41 = AnggotaKeluarga::where('pekerjaan', 'Pembuat Kue')->count();
        $pekerjaan42 = AnggotaKeluarga::where('pekerjaan', 'Honorer')->count(); 
        $pekerjaan43 = AnggotaKeluarga::where('pekerjaan', 'UKM')->count(); 
        $pekerjaan44 = AnggotaKeluarga::where('pekerjaan', 'Wiraswasta')->count(); 
        $pekerjaan45 = AnggotaKeluarga::where('pekerjaan', 'Wirausaha')->count(); 
        $pekerjaan46 = AnggotaKeluarga::where('pekerjaan', 'Belum Bekerja')->count(); 
        $pekerjaan47 = AnggotaKeluarga::where('pekerjaan', 'Tidak Mempunyai Pekerjaan Tetap')->count(); 
        $pekerjaan48 = AnggotaKeluarga::where('pekerjaan', 'Pengrajin')->count(); 
        $pekerjaan49 = AnggotaKeluarga::where('pekerjaan', 'Pelajar')->count(); 
        $pekerjaan50 = AnggotaKeluarga::where('pekerjaan', 'Ibu Rumah Tangga')->count(); 
        $pekerjaan51 = AnggotaKeluarga::where('pekerjaan', 'Pensiunan')->count(); 
        $pekerjaan52 = AnggotaKeluarga::where('pekerjaan', 'Supir')->count(); 
        $pekerjaan53 = AnggotaKeluarga::where('pekerjaan', 'Pemulung')->count(); 
        $pekerjaan54 = AnggotaKeluarga::where('pekerjaan', 'Penambang Pasir')->count(); 
        $pekerjaan55 = AnggotaKeluarga::where('pekerjaan', 'N/A')->count(); 

        //akseptor_kb
        $akseptorKBSUNTIK = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Suntik')->count(); 
        $akseptorKBSPIRAL = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Spiral')->count(); 
        $akseptorKBIMPLAN = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Implan')->count(); 
        $akseptorKBVASEK = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Vasektomi')->count(); 
        $akseptorKBTUBEK = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Tubektomi')->count(); 
        $akseptorKBPIL = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi Pil')->count(); 
        $akseptorKBAK = AnggotaKeluarga::where('akseptor_kb', 'KB Alamiah/Kalender')->count(); 
        $akseptorKBIUD = AnggotaKeluarga::where('akseptor_kb', 'Alat Kontrasepsi IUD')->count(); 
        $akseptorKBTRAD = AnggotaKeluarga::where('akseptor_kb', 'Obat Tradisional')->count(); 
        $akseptorKBTMAK = AnggotaKeluarga::where('akseptor_kb', 'Tidak Menggunakan Alat Kontrasepsi')->count();

        //penyandang_cacat
        $penyandangCF = AnggotaKeluarga::where('penyandang_cacat', 'Cacat Fisik')->count();
        $penyandangCTR = AnggotaKeluarga::where('penyandang_cacat', 'Tuna Rungu')->count();
        $penyandangCTW = AnggotaKeluarga::where('penyandang_cacat', 'Tuna Wicara')->count();
        $penyandangCTN = AnggotaKeluarga::where('penyandang_cacat', 'Tuna Netra')->count();
        $penyandangCL = AnggotaKeluarga::where('penyandang_cacat', 'Lumpuh')->count();
        $penyandangCS = AnggotaKeluarga::where('penyandang_cacat', 'Sumbing')->count();
        $penyandangCM = AnggotaKeluarga::where('penyandang_cacat', 'Cacat Mental')->count();
        $penyandangCD = AnggotaKeluarga::where('penyandang_cacat', 'Disabilitas')->count();
        $penyandangCA = AnggotaKeluarga::where('penyandang_cacat', 'Autis')->count();
        $penyandangCSG = AnggotaKeluarga::where('penyandang_cacat', 'Stress/Gila')->count();
        $penyandangCNN = AnggotaKeluarga::where('penyandang_cacat', 'N/A')->count();
        
        //status_kepemilikan_rumah
        $statusKRMS = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Milik Sendiri')->count(); 
        $statusKROT = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Milik Orang Tua')->count(); 
        $statusKRS = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Milik Saudara')->count(); 
        $statusKRSK = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Sewa/Kontrak')->count(); 
        $statusKRB = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Budel')->count();
        $statusKRRDN = AnggotaKeluarga::where('status_kepemilikan_rumah', 'Rumah Dinas Negara')->count();
        $statusKRNN = AnggotaKeluarga::where('status_kepemilikan_rumah', 'N/A')->count();

        //penghasilan_perbulan
        $penghasilanP1 = AnggotaKeluarga::where('penghasilan_perbulan', 'Dibawah Rp.500.000')->count(); 
        $penghasilanP2 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.500.000-1.000.000')->count(); 
        $penghasilanP3 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.1.000.000-2.000.000')->count(); 
        $penghasilanP4 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.2.000.000-3.000.000')->count(); 
        $penghasilanP5 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.3.000.000-5.000.000')->count(); 
        $penghasilanP6 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.5.000.000-10.000.000')->count(); 
        $penghasilanP7 = AnggotaKeluarga::where('penghasilan_perbulan', 'Diatas Rp.10.000.000')->count(); 
        $penghasilanP8 = AnggotaKeluarga::where('penghasilan_perbulan', 'Tidak Tetap')->count();
        //pengeluaran_perbulan
        $pengeluaranPerbulan1 = AnggotaKeluarga::where('penghasilan_perbulan', '<Rp.500.000')->count(); 
        $pengeluaranPerbulan2 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.500.000-1.000.000')->count(); 
        $pengeluaranPerbulan3 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.1.000.000-2.000.000')->count(); 
        $pengeluaranPerbulan4 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.2.000.000-3.000.000')->count(); 
        $pengeluaranPerbulan5 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.3.000.000-5.000.000')->count(); 
        $pengeluaranPerbulan6 = AnggotaKeluarga::where('penghasilan_perbulan', 'Rp.5.000.000-10.000.000')->count(); 
        $pengeluaranPerbulan7 = AnggotaKeluarga::where('penghasilan_perbulan', '>Rp.10.000.000')->count(); 
        $pengeluaranPerbulan8 = AnggotaKeluarga::where('penghasilan_perbulan', 'Tidak Tetap')->count();
        //kepemilikan_lahan
        $kepemilikanLahan1 = AnggotaKeluarga::where('kepemilikan_lahan', 'Tidak Memiliki')->count(); 
        $kepemilikanLahan2 = AnggotaKeluarga::where('kepemilikan_lahan', '<0,5ha')->count();
        $kepemilikanLahan3 = AnggotaKeluarga::where('kepemilikan_lahan', '0.5-1.0ha')->count();
        $kepemilikanLahan4 = AnggotaKeluarga::where('kepemilikan_lahan', '>1.0ha')->count();
        $kepemilikanLahan5 = AnggotaKeluarga::where('kepemilikan_lahan', 'N/A')->count();

        $gender = [
            'laki-laki' => $genderM,
            'perempuan' => $genderF,
        ];

        $statusKeluarga = [
            'Anak Kandung' => $statusDKAK,
            'Suami' => $statusDKS,
            'Istri' => $statusDKI,
            'Kepala Keluarga' => $statusDKKK,
            'Cucu' => $statusDKC,
            'Anak Angkat' => $statusDKAA,
            'Saudara' => $statusDKS,
            'N/A' => $statusDKNN
        ];

        $statusPerkawinan = [
            'Kawin' => $statusPK,
            'Belum Kawin' => $statusPBK,
            'Duda' => $statusPD,
            'Janda' => $statusPJ,
        ];

        $agama = [
            'Kristen' => $agamaK,
            'Islam' => $agamaI,
            'Hindu' => $agamaH,
            'Budha' => $agamaB,
            'Konghucu' => $agamaKO,
            'Aliran Kepercayaan Kepada Tuhan YME' => $agamaYME,
            'Aliran Kepercayaan Lainnya' => $agamaAKL,
            'N/A' => $agamaNN
        ];

        $golonganDarah = [
            'A' => $golonganDA,
            'B' => $golonganDB,
            'AB' => $golonganDAB,
            'O' => $golonganDO,
            'N/A' => $golonganDNN,
        ];

        $kewarganegaraan = [
            'WNI' => $kewarganegaraanWNI,
            'WNA' => $kewarganegaraanWNA
        ];

        $pendidikanTerakhir = [
            'Belum Masuk TK'  => $pendidikanBMTK,
            'Sedang Paud' => $pendidikanSP,
            'Sedang TK' => $pendidikanSTK,
            'Tidak Pernah Sekolah' => $pendidikanTS,
            'Sedang SD/Sederajat' => $pendidikanSSD,
            'Tamat SD/Sederajat' => $pendidikanTSD,
            'Sedang SLTP/Sederajat' => $pendidikanSSLTP,
            'Tamat SLTP/Sederajat' => $pendidikanTSLTP,
            'Sedang SLTA/Sederajat' => $pendidikanSSLTA,
            ' Tamat SLTA/Sederajat' => $pendidikanTSLTA,
            ' Sedang Kuliah' => $pendidikanSK,
            ' Sedang D1/Sederajat' => $pendidikanSD1,
            'Tamat D1/Sederajat' => $pendidikanTD1,
            'Sedang D2/Sederajat' => $pendidikanSD2,
            'Tamat D2/Sederajat' => $pendidikanTD2,
            'Sedang D3/Sederajat' => $pendidikanSD3,
            ' Tamat D3/Sederajat' => $pendidikanTD3,
            'Sedang D4/Sederajat' => $pendidikanSD4,
            'Tamat D4/Sederajat' => $pendidikanTD4,
            'Sedang S1/Sederajat' => $pendidikanSS1,
            'Tamat S1/Sederajat' => $pendidikanTS1,
            'Sedang S2/Sederajat' => $pendidikanSS2,
            'Tamat S2/Sederajat' => $pendidikanTS2,
            'Sedang S3/Sederajat' => $pendidikanSS3,
            'Tamat S3/Sederajat' => $pendidikanTS3,
            'Tamat SLB/Sederajat' => $pendidikanTSLB,
            'N/A' => $pendidikanNN,
        ];

        $pekerjaan = [
            'Petani' => $pekerjaan1,
            'Buruh' => $pekerjaan2,
            'Abdi Puskesmas' => $pekerjaan3,
            'Imam' => $pekerjaan4,
            'Pegawai Negeri Sipil' => $pekerjaan5,
            'Karyawan Swasta' => $pekerjaan6,
            'Penjahit' => $pekerjaan7,
            'Pedagang' => $pekerjaan8,
            'Peternak' => $pekerjaan9,
            'Nelayan' => $pekerjaan10,
            'Montir' => $pekerjaan11,
            'Teknisi' => $pekerjaan12,
            'Dokter' => $pekerjaan13,
            'Perawat' => $pekerjaan14,
            'Bidan' => $pekerjaan15,
            'TNI' => $pekerjaan16,
            'POLRI' => $pekerjaan17,
            'SATPOL PP' => $pekerjaan18,
            'Petugas Keamanan' => $pekerjaan19,
            'Pengusaha kecil, menengah dan besar' => $pekerjaan20,
            'Guru' => $pekerjaan21,
            'Baby Sitter' => $pekerjaan22,
            'Dosen' => $pekerjaan23,
            'Seniman/artis' => $pekerjaan24,
            'Pedagang Keliling' => $pekerjaan25,
            'Pengemudi Becak' => $pekerjaan26,
            'Tukang' => $pekerjaan27,
            'Tukang Batu' => $pekerjaan28,
            'Tukang Kayu' => $pekerjaan29,
            'Tukang Las' => $pekerjaan30,
            'Tukang Urut' => $pekerjaan31,
            'Tukang Emas' => $pekerjaan32,
            'Tukang Bentor' => $pekerjaan33,
            'Pembantu Rumah Tangga' => $pekerjaan34,
            'Pengacara' => $pekerjaan35,
            'Notaris' => $pekerjaan36,
            'Dukun Tradisional' => $pekerjaan37,
            'Arsitektur/Desainer' => $pekerjaan38,
            'Karyawan Perusahaan Swasta' => $pekerjaan39,
            'Karyawan Perusahaan Pemenrintah' => $pekerjaan40,
            'Pembuat Kue' => $pekerjaan41,
            'Honorer' => $pekerjaan42,
            'UKM' => $pekerjaan43,
            'Wiraswasta' => $pekerjaan44,
            'Wirausaha' => $pekerjaan45,
            'Belum Bekerja' => $pekerjaan46,
            'Tidak Mempunyai Pekerjaan Tetap' => $pekerjaan47,
            'Pengrajin' => $pekerjaan48,
            'Pelajar' => $pekerjaan49,
            'Ibu Rumah Tangga' => $pekerjaan50,
            'Pensiunan' => $pekerjaan51,
            'Supir' => $pekerjaan52,
            'Pemulung' => $pekerjaan53,
            'Penambang Pasir' => $pekerjaan54,
            'N/A' => $pekerjaan55,
        ];

        $akseptor = [
            'Alat Kontrasepsi Suntik' => $akseptorKBSUNTIK,
            'Alat Kontrasepsi Spiral' => $akseptorKBSPIRAL,
            'Alat Kontrasepsi Implan' => $akseptorKBIMPLAN,
            'Alat Kontrasepsi Vasektomi' => $akseptorKBVASEK,
            'Alat Kontrasepsi Tubektomi' => $akseptorKBTUBEK,
            'Alat Kontrasepsi Pil' => $akseptorKBPIL,
            'KB Alamiah/Kalender' => $akseptorKBAK,
            'Alat Kontrasepsi IUD' => $akseptorKBIUD,
            'Obat Tradisional' => $akseptorKBTRAD,
            'Tidak Menggunakan Alat Kontrasepsi' => $akseptorKBTMAK,
        ];

        $cacat = [
            'Cacat Fisik' => $penyandangCF, 
            'Tuna Rungu' => $penyandangCTR,
            'Tuna Wicara' => $penyandangCTW,
            'Tuna Netra' => $penyandangCTN,
            'Lumpuh' => $penyandangCL,
            'Sumbing' => $penyandangCS,
            'Cacat Mental' => $penyandangCM,
            'Disabilitas' => $penyandangCD,
            'Autis' => $penyandangCA,
            'Stress/Gila' => $penyandangCSG,
            'N/A' => $penyandangCNN,
        ];

        $statusKepemilikanRumah = [
            'Milik Sendiri' => $statusKRMS, 
            'Milik Orang Tua' => $statusKROT, 
            'Milik Saudara' => $statusKRS,
            'Sewa/Kontrak' => $statusKRSK, 
            'Budel' => $statusKRB,
            'Rumah Dinas Negara' => $statusKRRDN,
            'N/A' => $statusKRNN, 
        ];

        $penghasilanP = [
            'Dibawah Rp.500.000' => $penghasilanP1,
            'Rp.500.000-1.000.000' => $penghasilanP2,
            'Rp.1.000.000-2.000.000' => $penghasilanP3,
            'Rp.2.000.000-3.000.000' => $penghasilanP4,
            'Rp.3.000.000-5.000.000' => $penghasilanP5,
            'Rp.5.000.000-10.000.000' => $penghasilanP6,
            'Diatas Rp.10.000.000' => $penghasilanP7,
            'Tidak Tetap' => $penghasilanP8,
        ];

        $pengeluaranP = [
            '<Rp.500.000' => $pengeluaranPerbulan1,
            'Rp.500.000-1.000.000' => $pengeluaranPerbulan2,
            'Rp.1.000.000-2.000.000' => $pengeluaranPerbulan3,
            'Rp.2.000.000-3.000.000' => $pengeluaranPerbulan4,
            'Rp.3.000.000-5.000.000' => $pengeluaranPerbulan5,
            'Rp.5.000.000-10.000.000' => $pengeluaranPerbulan6,
            '>Rp.10.000.000' => $pengeluaranPerbulan7,
            'Tidak Tetap' => $pengeluaranPerbulan8,
        ];

        $kepemilikanLahan = [
            'Tidak Memiliki' => $kepemilikanLahan1,
            '<0,5ha' => $kepemilikanLahan2,
            '0.5-1.0ha' => $kepemilikanLahan3,
            '>1.0ha' => $kepemilikanLahan4,
            'N/A' => $kepemilikanLahan5,
        ];


        // dd($data_keluarga);
        return view('rt.admin_showData')->with(
            compact(
                'gender', 
                'statusKeluarga', 
                'statusPerkawinan', 
                'golonganDarah', 
                'kewarganegaraan', 
                'pendidikanTerakhir', 
                'pekerjaan',
                'akseptor', 
                'cacat',
                'statusKepemilikanRumah',
                'penghasilanP',
                'pengeluaranP',
                'kepemilikanLahan'
            ));
    }

    function update(Request $request, $id)
    {
        $rules = [
            "kode" => "required",
            "contact" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];


        $this->validate($request, $rules, $customMessages);

        if (RukunWarga::where("kontak", '=', $request->contact)->where('id', '<>', $id)->count() > 0) {
            return back()->with(["error" => "Gagal Mengupdate Data, Kontak Sudah Digunakan Pada RW Lain"]);
        }
        if (RukunWarga::where("kode", '=', $request->kode)->where('id', '<>', $id)->count() > 0) {
            return back()->with(["error" => "Gagal Mengupdate Data, Kode RW Sudah Digunakan Pada RW Lain"]);
        }

        $object = RukunWarga::findOrFail($id);
        $object->kode = $request->kode;
        $object->nama = $request->nama;
        $object->kontak = $request->contact;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data"]);
        }
    }

    function adminChangePassword(Request $request, $id)
    {
        $rules = [
            "new_password" => "required|min:6",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu',
            'min' => 'Jumlah Karakter Minimum Untuk :attribute adalah :min'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = RukunWarga::findOrFail($id);
        $object->password = bcrypt($request->new_password);
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Password RW"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Password RW"]);
        }
    }
}
