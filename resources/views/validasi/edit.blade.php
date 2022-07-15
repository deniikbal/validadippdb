<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit User</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/image/favicon.png')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS only -->


    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="{{asset('/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/typicons.font/typicons.css')}}" rel="stylesheet">
    <link href="{{asset('/lib/prismjs/themes/prism-vs.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}">
    <link href="{{asset('/assets/css/dashforge.css')}}" rel="stylesheet">
</head>
<body class="antialiased">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="card mt-5 mb-5">
                    <div class="card-header bg-danger text-center">
                        <h3 class="text-white">
                            {{$user->name}} ({{$user->student['nodaftar']}})
                        </h3>
                    </div>
                    <div class="card-body py-2 px-3">
                        <form action="{{route('validasi.update', $user->id)}}" method="post">
                            @csrf
                            @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Berhasil!</strong> {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="d-flex justify-content-md-between mt-4">
                                <h4>
                                    Data Pribadi
                                    @if($user->student['valid'] == 1)
                                        <span class="badge badge-success">Valid</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Valid</span>
                                    @endif
                                </h4>
                                <div>

                                    @if($user->student['valid'] == 0)
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#validasi{{$user->id}}">
                                            <i class="fa-solid fa-user-check"></i> validasi
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#unvalidasi{{$user->id}}">
                                            <i class="fa-solid fa-user-check"></i> Un Valididasi
                                        </button>
                                    @endif
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#unverifikasi{{$user->id}}">
                                            Un-Verifikasi
                                        </button>
                                    <a href="{{route('home')}}" class="btn btn-danger btn-sm"><i
                                            class="fa-solid fa-arrow-left"></i> Back</a>

                                </div>
                            </div>

                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name"
                                           class="form-control form-control-sm @error('name') is_invalid @enderror"
                                           placeholder="Nama Lengkap"
                                           value="{{old('name',$user->name) }}">
                                </div>
                                <div class="col-sm-4">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin"
                                            class="form-control form-control-sm @error('jenis_kelamin')is-invalid @enderror">
                                        <option value="">--Pilih--</option>
                                        @foreach($jenis_kelamin as $item)
                                            <option
                                                value="{{$item}}" {{$item== old('jenis_kelamin',$user->student['jenis_kelamin']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>NISN</label>
                                    <input type="text" name="nisn"
                                           class="form-control form-control-sm @error('nisn')is-invalid @enderror"
                                           placeholder="NISN"
                                           value="{{old('nisn',$user->student['nisn'])}}">
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label>Nomor Induk Kependudukan</label>
                                    <input type="text" name="nik"
                                           class="form-control form-control-sm @error('nik')is-invalid @enderror"
                                           placeholder="NIK"
                                           value="{{old('nik',$user->student['nik'])}}">
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label>No Kartu Keluarga</label>
                                    <input type="text" name="no_kk"
                                           class="form-control form-control-sm @error('no_kk')is-invalid @enderror"
                                           placeholder="No KK"
                                           value="{{old('no_kk',$user->student['no_kk'])}}">
                                    @error('no_kk')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat"
                                           class="form-control form-control-sm @error('tempat')is-invalid @enderror"
                                           placeholder="Tempat Lahir"
                                           value="{{old('tempat',$user->student['tempat'])}}">
                                    @error('tempat')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                           class="form-control form-control-sm @error('tanggal_lahir')is-invalid @enderror"
                                           value="{{old('tanggal_lahir',$user->student['tanggal_lahir'])}}">
                                    @error('tanggal_lahir')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Agama</label>
                                    <select class="form-control form-control-sm @error('agama')is-invalid @enderror"
                                            name="agama">
                                        <option value="">--Pilih--</option>
                                        @foreach($agama as $item)
                                            <option
                                                value="{{$item}}"{{$item==$user->student['agama'] ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Tempat Tinggal</label>
                                    <select class="form-control form-control-sm @error('tinggal')is-invalid @enderror"
                                            name="tinggal">
                                        <option value="">--Pilih--</option>
                                        @foreach($tinggal as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('tinggal',$user->student['tinggal']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('tinggal')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Moda Transportasi</label>
                                    <select class="form-control form-control-sm @error('mobil')is-invalid @enderror"
                                            name="mobil">
                                        <option value="">--Pilih--</option>
                                        @foreach($alat_transportasi as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('mobil',$user->student['mobil']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('mobil')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                {{--                                <div class="col-sm-3">--}}
                                {{--                                    <label>Ukuran Baju</label>--}}
                                {{--                                    <select class="form-control form-control-sm @error('baju')is-invalid @enderror" name="baju">--}}
                                {{--                                        <option value="">--Pilih--</option>--}}
                                {{--                                        @foreach($baju as $item)--}}
                                {{--                                            <option value="{{$item}}"{{$item==old('baju',$user->student['baju']) ? 'selected' : ''}}>{{$item}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                    @error('baju')--}}
                                {{--                                    <div class="invalid-feedback">--}}
                                {{--                                        {{$message}}--}}
                                {{--                                    </div>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                                <div class="col-sm-4">
                                    <label>Anak Ke-berapa (Berdasarkan KK)</label>
                                    <input type="text" name="anak_ke"
                                           class="form-control form-control-sm @error('anak_ke')is-invalid @enderror"
                                           placeholder="Anak Ke"
                                           value="{{old('anak_ke',$user->student['anak_ke'])}}">
                                    @error('anak_ke')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label>Alamat Rumah</label>
                                    <input type="text" name="alamat"
                                           class="form-control form-control-sm @error('alamat')is-invalid @enderror"
                                           placeholder="Alamat Rumah"
                                           value="{{old('alamat',$user->student['alamat'])}}">
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>RT</label>
                                    <input type="text" name="rt"
                                           class="form-control form-control-sm @error('rt')is-invalid @enderror"
                                           placeholder="RT"
                                           value="{{old('rt',$user->student['rt'])}}">
                                    @error('rt')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>RW</label>
                                    <input type="text" name="rw"
                                           class="form-control form-control-sm @error('rw')is-invalid @enderror"
                                           placeholder="RW"
                                           value="{{old('rw',$user->student['rw'])}}">
                                    @error('rw')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3">
                                    <label>Desa</label>
                                    <input type="text" name="desa_siswa"
                                           class="form-control form-control-sm @error('desa_siswa')is-invalid @enderror"
                                           placeholder="Desa"
                                           value="{{old('desa_siswa',$user->student['desa_siswa'])}}">
                                    @error('desa_siswa')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>Kecamatan</label>
                                    <input type="text" name="kec_siswa"
                                           class="form-control form-control-sm @error('kec_siswa')is-invalid @enderror"
                                           placeholder="Kecamatan"
                                           value="{{old('kec_siswa',$user->student['kec_siswa'])}}">
                                    @error('kec_siswa')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>Kabupaten</label>
                                    <input type="text" name="kab_siswa"
                                           class="form-control form-control-sm @error('kab_siswa')is-invalid @enderror"
                                           placeholder="Kabupaten"
                                           value="{{old('kab_siswa',$user->student['kab_siswa'])}}">
                                    @error('kab_siswa')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>Provinsi</label>
                                    <input type="text" name="prov_siswa"
                                           class="form-control form-control-sm @error('prov_siswa')is-invalid @enderror"
                                           placeholder="Provinsi"
                                           value="{{old('prov_siswa',$user->student['prov_siswa'])}}">
                                    @error('prov_siswa')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5>Data Orang Tua</h5>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah"
                                           class="form-control form-control-sm @error('nama_ayah')is-invalid @enderror"
                                           placeholder="Nama Ayah"
                                           value="{{old('nama_ayah',$user->student['nama_ayah'])}}">
                                    @error('nama_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>NIK Ayah</label>
                                    <input type="text" name="nik_ayah"
                                           class="form-control form-control-sm @error('nik_ayah')is-invalid @enderror"
                                           placeholder="NIK Ayah"
                                           value="{{old('nik_ayah',$user->student['nik_ayah'])}}">
                                    @error('nik_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Tahun Lahir Ayah</label>
                                    <input type="text" name="tahun_ayah"
                                           class="form-control form-control-sm @error('tahun_ayah')is-invalid @enderror"
                                           placeholder="Tahun Lahir Ayah"
                                           value="{{old('tahun_ayah',$user->student['tahun_ayah'])}}">
                                    @error('tahun_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Pendidikan Ayah</label>
                                    <select class="form-control form-control-sm @error('pend_ayah')is-invalid @enderror"
                                            name="pend_ayah">
                                        <option value="">Pilih Pendidikan</option>
                                        @foreach($pendidikan as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('pend_ayah',$user->student['pend_ayah']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('pend_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Pekerjaan Ayah</label>
                                    <select
                                        class="form-control form-control-sm @error('pekerjaan_ayah')is-invalid @enderror"
                                        name="pekerjaan_ayah">
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('pekerjaan_ayah',$user->student['pekerjaan_ayah']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Penghasilan Ayah</label>
                                    <select
                                        class="form-control form-control-sm @error('penghasilan_ayah')is-invalid @enderror"
                                        name="penghasilan_ayah">
                                        <option value="">--Pilih Penghasilan--</option>
                                        @foreach($penghasilan as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('penghasilan_ayah',$user->student['penghasilan_ayah']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('penghasilan_ayah')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu"
                                           class="form-control form-control-sm @error('nama_ibu')is-invalid @enderror"
                                           placeholder="Nama Ibu"
                                           value="{{old('nama_ibu',$user->student['nama_ibu'])}}">
                                    @error('nama_ibu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>NIK Ibu</label>
                                    <input type="text" name="nik_ibu"
                                           class="form-control form-control-sm @error('nik_ibu')is-invalid @enderror"
                                           placeholder="NIK Ibu"
                                           value="{{old('nik_ibu',$user->student['nik_ibu'])}}">
                                    @error('nik_ibu')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Tahun Lahir Ibu</label>
                                    <input type="text" name="tahun_ibu"
                                           class="form-control form-control-sm @error('tahun_ibu')is-invalid @enderror"
                                           placeholder="Tahun Lahir Ibu"
                                           value="{{old('tahun_ibu',$user->student['tahun_ibu'])}}">
                                    @error('tahun_ibu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Pendidikan Ibu</label>
                                    <select class="form-control form-control-sm @error('pend_ibu')is-invalid @enderror"
                                            name="pend_ibu">
                                        <option value="">Pilih Pendidikan</option>
                                        @foreach($pendidikan as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('pend_ibu',$user->student['pend_ibu']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('pend_ibu')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Pekerjaan Ibu</label>
                                    <select
                                        class="form-control form-control-sm @error('pekerjaan_ibu')is-invalid @enderror"
                                        name="pekerjaan_ibu">
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach($pekerjaan as $item)
                                            <option
                                                value="{{$item}}"{{$item==old('pekerjaan_ibu',$user->student['pekerjaan_ibu']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ibu')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Penghasilan Ibu</label>
                                    <select
                                        class="form-control form-control-sm @error('penghasilan_ibu')is-invalid @enderror"
                                        name="penghasilan_ibu">
                                        <option value="">--Pilih Penghasilan--</option>
                                        @foreach($penghasilan as $item)
                                            <option
                                                value="{{$item}}" {{$item == old('penghasilan_ibu',$user->student['penghasilan_ibu']) ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('penghasilan_ibu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5>Data Periodik</h5>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-2">
                                    <label>Tinggi Badan</label>
                                    <input type="text" name="tinggi_badan"
                                           class="form-control form-control-sm @error('tinggi_badan')is-invalid @enderror"
                                           placeholder="dalam Centimeter"
                                           value="{{old('tinggi_badan',$user->student['tinggi_badan'])}}">
                                    @error('tinggi_badan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label>Berat Badan</label>
                                    <input type="text" name="berat_badan"
                                           class="form-control form-control-sm @error('berat_badan')is-invalid @enderror"
                                           placeholder="dalam Kilogram"
                                           value="{{old('berat_badan',$user->student['berat_badan'])}}">
                                    @error('berat_badan')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>Jarak Rumah Ke Sekolah</label>
                                    <input type="text" name="jarak"
                                           class="form-control form-control-sm @error('jarak')is-invalid @enderror"
                                           placeholder="dalam Kilometer"
                                           value="{{old('jarak',$user->student['jarak'])}}">
                                    @error('jarak')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label>Waktu tempuh</label>
                                    <input type="text" name="waktu"
                                           class="form-control form-control-sm @error('waktu')is-invalid @enderror"
                                           placeholder="dalam Menit"
                                           value="{{old('waktu',$user->student['waktu'])}}">
                                    @error('waktu')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label>Jumlah Saudara Kandung</label>
                                    <input type="text" name="jumlah_saudara"
                                           class="form-control form-control-sm @error('jumlah_saudara')is-invalid @enderror"
                                           placeholder="Saudara"
                                           value="{{old('jumlah_saudara',$user->student['jumlah_saudara'])}}">
                                    @error('jumlah_saudara')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5>Data Asal Sekolah</h5>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Asal Sekolah SMP/MTs</label>
                                    <input type="text" name="asal_sekolah"
                                           class="form-control form-control-sm @error('asal_sekolah')is-invalid @enderror"
                                           placeholder="Asal Sekolah"
                                           value="{{old('asal_sekolah',$user->student['asal_sekolah'])}}">
                                    @error('asal_sekolah')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>NPSN</label>
                                    <input type="text" name="npsn_asal"
                                           class="form-control form-control-sm @error('npsn_asal')is-invalid @enderror"
                                           placeholder="NPSN"
                                           value="{{old('npsn_asal',$user->student['npsn_asal'])}}">
                                    @error('npsn_asal')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Desa Sekolah</label>
                                    <input type="text" name="desa"
                                           class="form-control form-control-sm @error('desa')is-invalid @enderror"
                                           placeholder="Desa Sekolah"
                                           value="{{old('desa',$user->student['desa'])}}">
                                    @error('desa')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label>Kecamatan Sekolah</label>
                                    <input type="text" name="kecamatan"
                                           class="form-control form-control-sm @error('kecamatan')is-invalid @enderror"
                                           placeholder="Asal Sekolah"
                                           value="{{old('kecamatan',$user->student['kecamatan'])}}">
                                    @error('kecamatan')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Kabupaten Sekolah</label>
                                    <input type="text" name="kota"
                                           class="form-control form-control-sm @error('kota')is-invalid @enderror"
                                           placeholder="Kabupaten Sekolah"
                                           value="{{old('kota',$user->student['kota'])}}">
                                    @error('kota')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label>Provinsi Sekolah</label>
                                    <input type="text" name="provinsi"
                                           class="form-control form-control-sm @error('provinsi')is-invalid @enderror"
                                           placeholder="Provinsi Sekolah"
                                           value="{{old('provinsi',$user->student['provinsi'])}}">
                                    @error('provinsi')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mb-3 mt-3">
                                <button class="btn btn-danger"
                                        type="submit" {{$user->student['valid']==1 ? 'disabled': ''}}><i
                                        class="fa-solid fa-arrow-up-from-bracket"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-danger text-white text-center">
                        PPDB SMA TELKOM {{carbon\carbon::now()->year}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="validasi{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validadi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"> Yakin mau validasi data {{$user->name}}?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('validasi',$user->id)}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-check"></i> Validasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unvalidasi{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Un Validasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"> Yakin mau unvalidasi data {{$user->name}}?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('unvalidasi',$user->id)}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i> Close
                    </button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-user-check"></i> UnValidasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unverifikasi{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Un Verifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"> Yakin mau unvalidasi data oke {{$user->name}}?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('unverifikasi',$user->id)}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i> Close
                    </button>
                    <button type="submit" class="btn btn-dark"><i class="fa-solid fa-user-check"></i> UnVerifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable();
    });
</script>
</body>
</html>
