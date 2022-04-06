    @extends('layouts.master')

    @section('content')
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <h1>
          Blank page
          <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
          <li><a href="#">Examples</a></li>
          <li class="active">Blank page</li>
        </ol>
      </section> --}}

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Status Permintaan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
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
                            <a href="#" class="small-box-footer">
                              More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
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
                            <a href="#" class="small-box-footer">
                              More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
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
                            <a href="#" class="small-box-footer">
                              More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
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
                            <a href="#" class="small-box-footer">
                              More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Laporan Permintaan Standar</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                    <form action="{{url('admin/dashboard/filter-data')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-daterange" style="height: 25px" id="from_date" name="from_date" readonly>
                            </div>
                            <div class="col-md-1">
                                <label style="text-align: center">sampai</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-daterange" style="height: 25px" id="to_date" name="to_date" readonly>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" id="submit_filter" value="filter" class="btn btn-default">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistik Layanan Permintaan | Pie Chart</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                  title="Collapse">
                            <i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>
                      </div>
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
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistik Layanan Dokumen | Pie Chart</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                  title="Collapse">
                            <i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>
                      </div>
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
                    <div class="box-header with-border">
                    <h3 class="box-title">Statistik Permintaan Standar | Jenis Standar</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <div class="box-body">
                        <div class="container-fluid">
                            <div id="container-jenis-standar">

                            </div>
                        </div>
                    </div>
                    {{-- <!-- /.box-body -->
                    <div class="box-footer">
                    Footer
                    </div>--}}
                    <!-- /.box-footer-->
                </div>
            </div>

            <div class="col-md-6">
                {{-- Tabel rekap tujuan penggunaan - jenis standar --}}
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tabel Rekap Jenis Standar | Judul - Eksemplar</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="container-fluid">
                            <table class="table table-hover"  id="datatable-jenis-standar">
                                <thead>
                                    <tr>
                                        <th>JENIS STANDAR</th>
                                        <th>JUDUL</th>
                                        <th>EKSEMPLAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SNI</td>
                                        <td>{{ count($sni_judul) }}</td>
                                        <td>{{ count($sni_eks) }}</td>
                                    </tr>
                                    <tr>
                                        <td>ASTM</td>
                                        <td>{{ count($astm_judul) }}</td>
                                        <td>{{ count($astm_eks) }}</td>
                                    </tr>
                                    <tr>
                                        <td>IEC</td>
                                        <td>{{ count($iec_judul) }}</td>
                                        <td>{{ count($iec_eks) }}</td>
                                    </tr>
                                    <tr>
                                        <td>ISO</td>
                                        <td>{{ count($iso_judul) }}</td>
                                        <td>{{ count($iso_eks) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Lainnya</td>
                                        <td>{{ count($lainnya_judul) }}</td>
                                        <td>{{ count($lainnya_eks) }}</td>
                                    </tr>
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
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Unit Kerja | Pie Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="container-fluid">
                <div id="container-unit-kerja">

                </div>
              </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Unit Kerja | Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
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

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                </div>
                <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-hover"  id="datatable-unit-kerja">
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

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="container-fluid">
                  <table class="table table-hover" id="datatable-unit-eselon-dua">
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

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                </div>
                <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-hover"  id="datatable-tujuan">
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

        {{-- Tabel rekap petugas --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tabel Rekap Petugas - Permintaan, Judul, Eksemplar</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                </div>
                <div class="box-body">
                <div class="container-fluid">
                    <table class="table table-hover"  id="datatable-petugas">
                        <thead>
                            <tr>
                                <th>PETUGAS</th>
                                <th>PERMINTAAN</th>
                                <th>JUDUL</th>
                                <th>EKSEMPLAR</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data_tabel_petugas as $data)
                            <tr>
                                <td>{{$data->petugas}}</td>
                                <td>{{$data->permintaan}}</td>
                                <td>{{$data->judul}}</td>
                                <td>{{$data->eksemplar}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="footer-table"></div>
                </div>
            </div>
        </div>
      </section>
      <!-- /.content -->
      @endsection

      @section('footer')
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script>
        $(document).ready(function(){
            $(".input-daterange").datepicker({
                todayBtn   :'linked',
                dateFormat : 'yy-mm-dd',
                autoclose  : true
            });

            $("#submit_filter").on('click', function(e){
                if($("#from_date").val() == '' || $("#to_date").val() == ''){
                    e.preventDefault();
                    Swal.fire({
                        icon : "warning",
                        title: "Peringatan",
                        text: "Pilih filter data mulai dari tanggal berapa sampai tanggal berapa.",
                    });
                }
            })
        })
      </script>


      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>

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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatable-jenis-standar').DataTable({
                "searching"      : false,
                "paging"         : false,
                "info"           : false,
            "lengthChange"     : false,
                // "columnDefs"     : [{
                //     "searchable" : true,
                //     "orderable"  : true,
                //     "targets"    : 0
                // }],
                "order"          : [[ 1, "desc" ]]
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
                $('#datatable-unit-kerja').DataTable({
                    "searching"      : false,
                    "paging"         : false,
                    "info"           : false,
                "lengthChange"     : false,
                    "columnDefs"     : [{
                        "searchable" : true,
                        "orderable"  : true,
                        "targets"    : 0
                    }],
                    "order"          : [[ 6, "desc" ]]
                });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatable-unit-eselon-dua').DataTable({
                "columnDefs"     : [{
                    "searchable" : true,
                    "orderable"  : true,
                    "targets"    : 0
                }],
                "order"          : [[ 2, "desc" ]]
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
            $('#datatable-tujuan').DataTable({
                "searching"      : false,
                "paging"         : false,
                "info"           : false,
            "lengthChange"     : false,
                "columnDefs"     : [{
                    "searchable" : true,
                    "orderable"  : true,
                    "targets"    : 0
                }],
                "order"          : [[ 6, "desc" ]]
            });
    });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
                $('#datatable-petugas').DataTable({
                    "searching"      : false,
                    "paging"         : false,
                    "info"           : false,
                "lengthChange"     : false,
                    "columnDefs"     : [{
                        "searchable" : true,
                        "orderable"  : true,
                        "targets"    : 0
                    }],
                    "order"          : [[ 1, "desc" ]]
                });
        });
    </script>

    @endsection
