<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Validasi PPDB</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/image/favicon.png')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS only -->


    <link rel="stylesheet" type="text/css" href="{{asset('/lib/@fortawesome/fontawesome-free/css/all.min.css')}}">
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
            <div class="card mt-5 mb-5">
                <div class="card-header bg-danger text-center">
                    <h2 class="text-white">Validasi Calon Peserta Didik SMA TELKOM BANDUNG</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped border-danger" id="example2">
                        <thead class="table-danger">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Daftar</th>
                            <th>Asal Sekolah</th>
                            <th>NPSN</th>
                            <th>NISN</th>
                            <th>Validasi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->student['nodaftar'] }}</td>
                                <td>
                                    <a href="https://referensi.data.kemdikbud.go.id/tabs.php?npsn={{$item->student['npsn_asal']}}"
                                       target="_blank">
                                        {{ $item->student['asal_sekolah'] }}
                                    </a>
                                </td>
                                <td>{{ $item->student['npsn_asal'] }}</td>
                                <td>{{ $item->student['nisn'] }}</td>
                                <td>
                                    @if ($item->student['valid'] == 1)
                                        <span class="badge badge-success">Valid</span>
                                    @else
                                        <span class="badge badge-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('validasi.edit', $item->id) }}" target="_blank"
                                       class="btn btn-secondary btn-sm">
                                        <i class="fa-solid fa-person-circle-check"></i> Verifikasi</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer text-center bg-danger text-white">
                    PPDB SMA TELKOM 2022
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" charset="utf8"
        src="{{asset('/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8"
        src="{{asset('/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8"
        src="{{asset('/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" charset="utf8"
        src="{{asset('/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8"
        src="{{asset('/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('/assets/js/dashforge.js')}}"></script>
<script>
    $('#example2').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        },
    });
</script>
</body>
</html>
