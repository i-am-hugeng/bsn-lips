<!DOCTYPE html>
<html>
<head>

    <title>LIPS | Statistik</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">

    <!-- Font Family -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- JQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/skins/_all-skins.min.css">

</head>
<body>
    {{-- Navbar Start --}}

    <nav class="navbar navbar-font-weight navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logo/web-icon.png') }}" height="40px" alt="">
                    Layanan Internal Permintaan Standar
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Formulir Permintaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tabel-permintaan') ? 'active' : '' }}" href="{{ url('/tabel-permintaan') }}">Tabel Permintaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('statistik') ? 'active' : '' }}" href="{{ url('/statistik') }}">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tutorial') ? 'active' : '' }}" href="{{ url('/tutorial') }}">Tutorial</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Navbar End --}}

    {{-- Content Start --}}
    <!-- Main content -->
    <div class="container">
        <div class="judul-tabel">
            <h2>Statistik Layanan Internal Permintaan Standar</h2>
            <p class="title-footnote"><strong>*) Data statistik secara akumulatif diambil dari awal LIPS beroperasi (11 September 2021).</strong></p>
        </div>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Status Permintaan</h3>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{$permintaan_all}}</h3>

                                <p>Total Permintaan</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{$terkirim}}</h3>

                                <p>Terkirim</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{$belum_terkirim}}</h3>

                                <p>Belum Terkirim</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-hourglass-start"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{$gagal_proses}}</h3>

                                <p>Gagal Proses</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-ban"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div id="container-layanan">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div id="container-dokumen">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div id="container-jenis-standar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                {{-- Tabel rekap tujuan penggunaan - jenis standar --}}
                <div class="box">
                    <div class="box-body">
                        <div class="container-fluid">
                            <table class="table table-sm table-hover"  id="datatable-jenis-standar">
                                <thead>
                                    <tr>
                                        <th>JENIS STANDAR</th>
                                        <th>JUDUL</th>
                                        <th>EKSEMPLAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_tabel_standar as $data)
                                    <tr>
                                        <td>{{ $data->jenis_standar }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td >{{ $data->eksemplar }}</td>
                                    </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="footer-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik unit kerja --}}
        <div class="box">
            <div class="box-body">
                <div class="container-fluid">
                    <div id="container-unit-kerja">

                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <div class="container-fluid">
                    <div id="containerBar">

                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel rekap unit kerja - jenis standar --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tabel Rekap Unit Kerja Eselon I - Jenis Standar (eksemplar)</h3>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-sm table-hover"  id="datatable-unit-kerja">
                        <thead>
                            <tr>
                                <th>Unit Kerja</th>
                                <th>SNI</th>
                                <th>ASTM</th>
                                <th>IEC</th>
                                <th>ISO</th>
                                <th>Lainnya</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data_tabel_unit as $data)
                            <tr>
                                <td>{{$data->eselon_satu}}</td>
                                <td>{{$data->sni}}</td>
                                <td>{{$data->astm}}</td>
                                <td>{{$data->iec}}</td>
                                <td>{{$data->iso}}</td>
                                <td>{{$data->lainnya}}</td>
                                <td>{{$data->total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="footer-table"></div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tabel Rekap Unit Kerja Eselon II</h3>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-sm table-hover" id="datatable-unit-eselon-dua">
                        <thead>
                            <tr>
                                <th>Unit Kerja</th>
                                <th>Permintaan</th>
                                <th>Judul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_unit_kerja as $unit)
                            <tr>
                                <td>{{$unit->unit_kerja}}</td>
                                <td>{{$unit->permintaan}}</td>
                                <td>{{$unit->judul}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>--}}
            <!-- /.box-footer-->
        </div>


        {{-- Tabel rekap tujuan penggunaan - jenis standar --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tabel Rekap Tujuan Penggunaan - Jenis Standar (eksemplar)</h3>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-sm table-hover"  id="datatable-tujuan">
                        <thead>
                            <tr>
                                <th>TUJUAN PENGGUNAAN</th>
                                <th>SNI</th>
                                <th>ASTM</th>
                                <th>IEC</th>
                                <th>ISO</th>
                                <th>Lainnya</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data_tabel_tujuan as $data)
                            <tr>
                                <td>{{$data->tujuan_penggunaan}}</td>
                                <td>{{$data->sni}}</td>
                                <td>{{$data->astm}}</td>
                                <td>{{$data->iec}}</td>
                                <td>{{$data->iso}}</td>
                                <td>{{$data->lainnya}}</td>
                                <td>{{$data->total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="footer-table"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
    {{-- Content End --}}

    {{-- Footer Start --}}
    <footer class="footer page-footer font-small text-white bg-dark">
        <div class="container">
            <div class="footer-copyright text-center py-3">Copyright © 2022
                <a href="https://bsn.go.id/" class="text-white"> Badan Standardisasi Nasional</a>
            </div>
        </div>
    </footer>
    {{-- Footer End --}}

</body>
{{-- <script src="{{asset('js/loading.js')}}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Jquery Validate -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <script src="https://code.highcharts.com/highcharts.js"></script>
      {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}

      {{-- Pie Chart --}}
      <script>
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });

            Highcharts.chart('container-unit-kerja', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik Unit Kerja | Pie Chart'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Permintaan',
                    data: [
                        { name: 'Sestama', y: {{$sestama}} },
                        { name: 'Deputi Pengembangan', y: {{$pengembangan}} },
                        { name: 'Deputi Penerapan', y: {{$penerapan}} },
                        { name: 'Deputi Akreditasi', y: {{$akreditasi}} },
                        { name: 'Deputi SNSU', y: {{$snsu}} },
                        { name: 'KLT', y: {{$klt}} }
                    ]
                }]
            });

            // Pie Chart Permintaan
            Highcharts.chart('container-layanan', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik Layanan Permintaan | Pie Chart'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Permintaan',
                    data: [
                        { name: 'Terlayani ('+{{$terlayani}}+' permintaan)', y: {{$terlayani}} },
                        { name: 'Tidak Terlayani ('+{{$tidak_terlayani}}+' permintaan)', y: {{$tidak_terlayani}} },
                    ]
                }]
            });

            //Pie Chart Dokumen
            Highcharts.chart('container-dokumen', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik Layanan Dokumen | Pie Chart'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Permintaan',
                    data: [
                        { name: 'Tersedia ('+{{$tersedia}}+' judul)', y: {{$tersedia}} },
                        { name: 'Tidak Tersedia ('+{{$tidak_tersedia}}+' judul)', y: {{$tidak_tersedia}} },
                    ]
                }]
            });
      </script>
      {{-- Bar Chart --}}
      <script>
        Highcharts.chart('containerBar', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Permintaan Standar | Bar Chart'
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com'
            // },
            xAxis: {
                categories: [
                    'Sestama',
                    'Pengembangan',
                    'Penerapan',
                    'Akreditasi',
                    'SNSU',
                    'KLT'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Permintaan, Judul dan Eksemplar'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        allowOverlap: true
                    }
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series:
            [
                {
                    name: 'Permintaan',
                    data: [
                            {{$sestama}},
                            {{$pengembangan}},
                            {{$penerapan}},
                            {{$akreditasi}},
                            {{$snsu}},
                            {{$klt}},
                        ]
                },
                {
                    name: 'Judul',
                    data: [
                            {{$sestama_judul}},
                            {{$pengembangan_judul}},
                            {{$penerapan_judul}},
                            {{$akreditasi_judul}},
                            {{$snsu_judul}},
                            {{$klt_judul}},
                        ]
                },
                {
                    name: 'Eksemplar',
                    data: [
                            {{$sestama_eks}},
                            {{$pengembangan_eks}},
                            {{$penerapan_eks}},
                            {{$akreditasi_eks}},
                            {{$snsu_eks}},
                            {{$klt_eks}},
                        ]
                },
            ]
        });
      </script>

    <script>
        Highcharts.chart('container-jenis-standar', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Permintaan Standar | Jenis Standar'
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com'
            // },
            xAxis: {
                categories: [
                    'SNI',
                    'ASTM',
                    'IEC',
                    'ISO',
                    'Lainnya',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Judul dan Eksemplar'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        allowOverlap: true
                    }
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series:
            [
                {
                    name: 'Judul',
                    data: [
                            {{$sni_judul->count('nomor_standar')}},
                            {{$astm_judul->count('nomor_standar')}},
                            {{$iec_judul->count('nomor_standar')}},
                            {{$iso_judul->count('nomor_standar')}},
                            {{$lainnya_judul->count('nomor_standar')}}
                        ]
                },
                {
                    name: 'Eks',
                    data: [
                            {{$sni_eks->count('nomor_standar')}},
                            {{$astm_eks->count('nomor_standar')}},
                            {{$iec_eks->count('nomor_standar')}},
                            {{$iso_eks->count('nomor_standar')}},
                            {{$lainnya_eks->count('nomor_standar')}}
                        ]
                },
            ]
        });
    </script>

</html>
