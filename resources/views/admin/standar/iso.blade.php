@extends('layouts.master')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Statistik Permintaan ISO | Unit Kerja</h3>

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
              <div id="container">

            </div>
          </div>
        </div>
        {{-- <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>--}}
        <!-- /.box-footer-->
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tabel Permintaan Standar ISO | Unit Kerja</h3>

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
                            <th>Unit Kerja Es.II</th>
                            <th>Unit Kerja Es.I</th>
                            <th>Judul</th>
                            <th>Eksemplar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($unit_kerja as $data)
                        <tr>
                            <td>{{$data->unit_kerja}}</td>
                            <td>{{$data->eselon_satu}}</td>
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

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tabel Permintaan Standar ISO | Nomor Standar</h3>

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
                <table class="table table-hover"  id="iso-dt">
                    <thead>
                        <tr>
                            <th>Nomor Standar</th>
                            <th>Sestama</th>
                            <th>Pengembangan</th>
                            <th>Penguatan</th>
                            <th>Akreditasi</th>
                            <th>SNSU</th>
                            <th>KLT</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                </table>
                <div id="footer-table"></div>
            </div>
          </div>
    </div>
</section>
@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
    Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: null
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
                    'KLT',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Judul & Eksemplar'
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
                            {{$sestama_judul}},
                            {{$pengembangan_judul}},
                            {{$penerapan_judul}},
                            {{$akreditasi_judul}},
                            {{$snsu_judul}},
                            {{$klt_judul}}
                        ]
                },
                {
                    name: 'Eks',
                    data: [
                            {{$iso->sum('sestama')}},
                            {{$iso->sum('pengembangan')}},
                            {{$iso->sum('penerapan')}},
                            {{$iso->sum('akreditasi')}},
                            {{$iso->sum('snsu')}},
                            {{$iso->sum('klt')}},
                        ]
                },
            ]
        });
</script>

<script type="text/javascript">
$(document).ready(function(){
        $('#datatable-unit-kerja').DataTable({
            language: {
                url: "/json/id.json"
            },
            columnDefs: [
                {"searchable": true, "orderable": true, "targets": 0},
                { type: "html-num", targets: [2, 3] }
            ],
            order: [[ 2, "desc" ]]
        });
});
</script>
@endsection
