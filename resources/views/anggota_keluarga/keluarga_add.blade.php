@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Anggota Keluarga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Anggota Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')
   

    @include('components.message')


    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Tambah Anggota Keluarga Baru</h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">Keluarga : {{$keluarga->nama}}</h3>

            <h4>Tambah Anggota Keluarga Baru</h4>

            <hr>

            <form action="{{ url('keluarga/'.$keluarga->id.'/anggota/simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $keluarga->id }}">
                
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" required name="nama" 
                        placeholder="Nama Lengkap">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>
                
                <div class="form-group">
                    <label for="">Nomor Induk Kependudukan</label>
                    <input type="text" class="form-control" required name="nik" 
                        placeholder="Nomor Induk Kependudukan">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>

                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <select required class="form-control" name="gender">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Tempat Lahir</label>
                    <input required type="text" class="form-control" name="tempat_lahir" 
                        placeholder="Tempat Lahir">
                    <small class="form-text text-muted">Kota Kelahiran</small>
                </div>


                <div class="form-group">
                    <label for="">Tanggal Kelahiran</label>
                    <input type="date" name="tanggal_lahir" required class="form-control" value="2018-05-13">
                    <small class="form-text text-muted">Tanggal Kelahiran</small>
                </div>

                <div class="form-group">
                    <label for="">Status dalam keluarga</label>
                    <select required class="form-control" name="status_dalam_keluarga">
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Suami">Suami</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak Kandung">Anak Kandung</option>
                    <option value="Cucu">Cucu</option>
                    <option value="Anak Angkat">Anak Angkat</option>
                    <option value="Orang Tua">Orang Tu</option>
                    <option value="Famili Lain">Famili Lain</option>
                    <option value="Saudara">Saudara</option>
                  </select>
                    <small class="form-text text-muted">status dalam keluarga ( Sesuai KK ) </small>
                </div>

                <div class="form-group">
                    <label for="">Status Perkawinan</label>
                    <select required class="form-control" name="status_perkawinan">
                    <option value="Kawin">Kawin</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Duda">Duda</option>
                    <option value="Janda">Janda</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Agama</label>
                    <select required class="form-control" name="agama">
                    <option value="kristen">Kristen</option>
                    <option value="islam">Islam</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Aliran Kepercayaan Kepada Tuhan YME">Aliran Kepercayaan Kepada Tuhan YME</option>
                    <option value="Aliran Kepercayaan Lainnya">Aliran Kepercayaan Lainnya</option>
                  </select>
                    <small class="form-text text-muted">Agama ( Sesuai KTP ) </small>
                </div>

                <div class="form-group">
                    <label for="">Golongan Darah</label>
                    <select required class="form-control" name="golongan_darah">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="">Kewarganegaraan</label>
                    <select required class="form-control" name="kewarganegaraan">
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <select required class="form-control" name="pendidikan">
                        <option value="Belum Masuk TK">Belum Masuk TK</option>
                        <option value="Sedang PAUD">Sedang PAUD</option>
                        <option value="Sedang TK">Sedang TK</option>
                        <option value="Tidak Pernah Sekolah">Tidak Pernah Sekolah</option>
                        <option value="Sedang SD/Sederajat">Sedang SD/Sederajat</option>
                        <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                        <option value="Sedang SLTP/Sederajat">Sedang SLTP/Sederajat</option>
                        <option value="Tamat SLTP/Sederajat">Tamat SLTP/Sederajat</option>
                        <option value="Tamat SLTP/Sederajat">Tamat SLTP/Sederajat</option>
                        <option value="Sedang SLTA/Sederajat">Sedang SLTA/Sederajat</option>
                        <option value="Tamat SLTA/Sederajat">Tamat SLTA/Sederajat</option>
                        <option value="Sedang Kuliah">Sedang Kuliah</option>
                        <option value="Sedang D1/Sederajat">Sedang D1/Sederajat</option>
                        <option value="Tamat D1/Sederajat">Tamat D1/Sederajat</option>
                        <option value="Sedang D2/Sederajat">Sedang D2/Sederajat</option>
                        <option value="Tamat D2/Sederajat">Tamat D2/Sederajat</option>
                        <option value="Sedang D3/Sederajat">Sedang D3/Sederajat</option>
                        <option value="Tamat D3/Sederajat">Tamat D3/Sederajat</option>
                        <option value="Sedang D4/Sederajat">Sedang D4/Sederajat</option>
                        <option value="Tamat D4/Sederajat">Tamat D4/Sederajat</option>
                        <option value="Sedang S1/Sederajat">Sedang S1/Sederajat</option>
                        <option value="Tamat S1/Sederajat">Tamat S1/Sederajat</option>
                        <option value="Sedang S2/Sederajat">Sedang S2/Sederajat</option>
                        <option value="Tamat S2/Sederajat">Tamat S2/Sederajat</option>
                        <option value="Sedang S3/Sederajat">Sedang S3/Sederajat</option>
                        <option value="Tamat S3/Sederajat">Tamat S3/Sederajat</option>
                        <option value="Sedang SLB/Sederajat">Sedang SLB/Sederajat</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <select required class="form-control" name="pekerjaan">
                    <option value="Petani">Petani</option>
                    <option value="Buruh">Buruh</option>
                    <option value="Abdi Puskesmas'">Abdi Puskesmas</option>
                    <option value="Imam">Imam</option>
                    <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Penjahit">Penjahit</option>
                    <option value="Pedagang">Pedagang</option>
                    <option value="Peternak">Peternak</option>
                    <option value="Nelayan">Nelayan</option>
                    <option value="Montir">Montir</option>
                    <option value="Teknisi">Teknisi</option>
                    <option value="Dokter">Dokter</option>
                    <option value="Perawat">Perawat</option>
                    <option value="Bidan">Bidan</option>
                    <option value="TNI">TNI</option>
                    <option value="POLRI">POLRI</option>
                    <option value="SATPOL PP">SATPOL PP</option>
                    <option value="Petugas Keamanan">Petugas Keamanan</option>
                    <option value="Pengusaha kecil, menengah dan besar">Pengusaha kecil, menengah dan besar</option>
                    <option value="Guru">Guru</option>
                    <option value="Baby Sitter">Baby Sitter</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Seniman/artis">Seniman/artis</option>
                    <option value="Pedagang Keliling">Pedagang Keliling</option>
                    <option value="Pengemudi Becak">Pengemudi Becak</option>
                    <option value="Tukang">Tukang</option>
                    <option value="Tukang Batu">Tukang Batu</option>
                    <option value="Tukang Kayu">Tukang Kayu</option>
                    <option value="Tukang Las">Tukang Las</option>
                    <option value="Tukang Urut">Tukang Urut</option>
                    <option value="Tukang Emas">Tukang Emas</option>
                    <option value="Tukang Bentor">Tukang Bentor</option>
                    <option value="Pembantu Rumah Tangga">Pembantu Rumah Tangga</option>
                    <option value="Pengacara">Pengacara</option>
                    <option value="Notaris">Notaris</option>
                    <option value="Dukun Tradisional">Dukun Tradisional</option>
                    <option value="Arsitektur/Desainer">Arsitektur/Desainer</option>
                    <option value="Karyawan Perusahaan Swasta">Karyawan Perusahaan Swasta</option>
                    <option value="Karyawan Perusahaan Pemenrintah">Karyawan Perusahaan Pemenrintah</option>
                    <option value="Pembuat Kue">Pembuat Kue</option>
                    <option value="Honorer">Honorer</option>
                    <option value="UKM">UKM</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Wirausaha">Wirausaha</option>
                    <option value="Belum Bekerja">Belum Bekerja</option>
                    <option value="Tidak Mempunyai Pekerjaan Tetap">Tidak Mempunyai Pekerjaan Tetap</option>
                    <option value="Pengrajin">Pengrajin</option>
                    <option value="Pelajar">Pelajar</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Pensiunan">Pensiunan</option>
                    <option value="Supir">Supir</option>
                    <option value="Pemulung">Pemulung</option>
                    <option value="Penambang Pasir">Penambang Pasir</option>
                </select>
                </div>

                <div class="form-group">
                    <label for="">Akseptor KB</label>
                    <select required class="form-control" name="akseptor_kb">
                    <option value="Alat Kontrasepsi Suntik">Alat Kontrasepsi Suntik</option>
                    <option value="Alat Kontrasepsi Spiral">Alat Kontrasepsi Spiral</option>
                    <option value="Alat Kontrasepsi Implan">Alat Kontrasepsi Implan</option>
                    <option value="Alat Kontrasepsi Vasektomi">Alat Kontrasepsi Vasektomi</option>
                    <option value="Alat Kontrasepsi Tubektomi">Alat Kontrasepsi Tubektomi</option>
                    <option value="Alat Kontrasepsi Pil">Alat Kontrasepsi Pil</option>
                    <option value="KB Alamiah/Kalender">KB Alamiah/Kalender</option>
                    <option value="Alat Kontrasepsi IUD">Alat Kontrasepsi IUD</option>
                    <option value="Obat Tradisional">Obat Tradisional</option>
                    <option value="Tidak Menggunakan Alat Kontrasepsi">Tidak Menggunakan Alat Kontrasepsi</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Penyandang Cacat</label>
                    <select required class="form-control" name="penyandang_cacat">
                    <option value="Cacat Fisik">Cacat Fisik</option>
                    <option value="Tuna Rungu">Tuna Rungu</option>
                    <option value="Tuna Wicara">Tuna Wicara</option>
                    <option value="Tuna Netra">Tuna Netra</option>
                    <option value="Lumpuh">Lumpuh</option>
                    <option value="Sumbing">Sumbing</option>
                    <option value="Cacat Mental">Cacat Mental</option>
                    <option value="Disabilitas">Disabilitas</option>
                    <option value="Autis">Autis</option>
                    <option value="Stress/Gila">Stress/Gila</option>
                    <option value="N/A">N/A</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Status Kepemilikan Rumah</label>
                    <select required class="form-control" name="status_kepemilikan_rumah">
                    <option value="Milik Sendiri">Milik Sendiri</option>
                    <option value="Milik Orang Tua">Milik Orang Tua</option>
                    <option value="Milik Saudara">Milik Saudara</option>
                    <option value="Sewa/Kontrak">Sewa/Kontrak</option>
                    <option value="Budel">Budel</option>
                    <option value="Rumah Dinas Negara">Rumah Dinas Negara</option>
                    <option value="N/A">N/A</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Penghasilan Perbulan</label>
                    <select required class="form-control" name="penghasilan_perbulan">
                    <option value="Dibawah Rp.500.000">Dibawah Rp.500.000</option>
                    <option value="Rp.500.000-1.000.000">Rp.500.000-1.000.000</option>
                    <option value="Rp.1.000.000-2.000.000">Rp.1.000.000-2.000.000</option>
                    <option value="Rp.2.000.000-3.000.000">Rp.2.000.000-3.000.000</option>
                    <option value="Rp.3.000.000-5.000.000">Rp.3.000.000-5.000.000</option>
                    <option value="Rp.5.000.000-10.000.000">Rp.5.000.000-10.000.000</option>
                    <option value="Diatas Rp.10.000.000">Diatas Rp.10.000.000</option>
                    <option value="Tidak Tetap">Tidak Tetap</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Pengeluaran Perbulan</label>
                    <select required class="form-control" name="pengeluaran_perbulan">
                    <option value="<Rp.500.000">Dibawah Rp.500.000</option>
                    <option value="Rp.500.000-1.000.000">Rp.500.000-1.000.000</option>
                    <option value="Rp.1.000.000-2.000.000">Rp.1.000.000-2.000.000</option>
                    <option value="Rp.2.000.000-3.000.000">Rp.2.000.000-3.000.000</option>
                    <option value="Rp.3.000.000-5.000.000">Rp.3.000.000-5.000.000</option>
                    <option value="Rp.5.000.000-10.000.000">Rp.5.000.000-10.000.000</option>
                    <option value="'>Rp.10.000.000'">Diatas Rp.10.000.000</option>
                    <option value="Tidak Tetap">Tidak Tetap</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Pengeluaran Perbulan</label>
                    <select required class="form-control" name="kepemilikan_lahan">
                    <option value="Tidak Memiliki">Tidak Memiliki</option>
                    <option value="<0,5ha"><0,5ha</option>
                    <option value="0.5-1.0ha">0.5-1.0ha</option>
                    <option value=">1.0ha">>1.0ha</option>
                    <option value="N/A">N/A</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Alamat Saat Ini</label>
                    <textarea class="form-control" placeholder="Alamat Anggota Keluarga"  name="alamat" id=""
                        rows="5"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" value="{{ Auth::guard('keluarga')->id() }}">
                    <p class="card-text">Upload Foto KTP ( Jika Sudah Punya )</p>

                    <div class="custom-file">
                        <input name="photo" type="file" class="custom-file-input" id="inputGroupFile03">
                        <label class="custom-file-label" for="inputGroupFile03">Pilih Foto KTP</label>
                    </div>
                    <small class="form-text text-muted">Masukkan Foto KTP Disini</small>
                </div>
        

                <button type="submit" class="btn btn-block btn-primary">Tambahkan Data Keluarga</button>
            </form>
        </div>
    </div>


    <!-- Modal Add New -->
    <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="insert-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Tambah Data Guru Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="name">Judul/Nama Agenda Mutaba'ah</label>
                            <input type="hidden" required="" id="id" name="id" class="form-control">
                            <input type="" required="" id="name" placeholder="Judul Agenda Mutaba'ah" name="name"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_datetime">Tanggal Mutaba'ah</label>
                            <input type="date" required="" id="edit_date" name="edit_date" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="">Ganti Status Mutaba'ah</label>
                            <select class="form-control" required name="status" id="new_status">
                                <option value="">Pilih Status</option>
                                <option value="1">Dibuka</option>
                                <option value="0">Ditutup</option>
                                <option value="3">Pending</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New -->






@endsection


@section('app-script')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>




    <script type="text/javascript">
        $(function() {
            var table = $('#table_santri').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Data Santri Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
                ajax: {
                    type: "get",
                    url: "{{ url('admin/data/santri/manage') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    async: true,
                    error: function(xhr, error, code) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'asrama',
                        name: 'asrama'
                    },
                    {
                        data: 'jenjang',
                        name: 'jenjang'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

            $('body').on("click", ".btn-delete", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#destroy-modal").modal("show")
            });

            $('body').on("click", ".btn-add-new", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#insert-modal").modal("show")
            });


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.id)
                        $("#name").val(response.judul)
                        $("#edit_date").val(response.tanggal)
                        $("#role").val(response.role)
                    }
                })
            });

            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });


    </script>




@endsection
