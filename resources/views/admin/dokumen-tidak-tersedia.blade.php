@extends('layouts.master')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tabel Dokumen Standar Yang Tidak Tersedia | Nomor Standar</h3>

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
                <table class="table table-hover"  id="dokumen-tidak-tersedia-dt">
                    <thead>
                        <tr>
                            <th>Nomor Standar</th>
                            <th>Jenis Standar</th>
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

    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">Statistik Standar Tidak Terlayani | Jenis Standar</h3>

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
    </div>
</section>
@endsection

@section('footer')

<script type="text/javascript">
    $(document).ready(function(){
          $('#datatable-unit-kerja').DataTable({
              "columnDefs": [{
                  "searchable": true,
                  "orderable": true,
                  "targets": 0
              }],
              "order": [[ 2, "desc" ]]
          });
    });
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
    Highcharts.chart('container-jenis-standar', {
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
                        {{$sni_judul}},
                        {{$astm_judul}},
                        {{$iec_judul}},
                        {{$iso_judul}},
                        {{$lainnya_judul}}
                    ]
            },
            {
                name: 'Eks',
                data: [
                        {{$sni_eks}},
                        {{$astm_eks}},
                        {{$iec_eks}},
                        {{$iso_eks}},
                        {{$lainnya_eks}}
                    ]
            },
        ]
    });
</script>
@endsection
