@extends('layouts.master')

@section('content')
<section class="content">
    <!-- Default box -->
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
                <form action="reporting/filter-data" method="POST">
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
        <h3 class="box-title">Tabel Permintaan Standar | Unit Kerja</h3>

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
            <table class="table table-hover">
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

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Permintaan Standar | Tujuan Penggunaan</h3>

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
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th>Tujuan Penggunaan</th>
                          <th>Permintaan</th>
                          <th>Judul</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($data_tujuan as $tujuan)
                      <tr>
                          <td>{{$tujuan->tujuan_penggunaan}}</td>
                          <td>{{$tujuan->permintaan}}</td>
                          <td>{{$tujuan->judul}}</td>
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

    <!-- /.box -->

  </section>
  @endsection

  @section('footer')
    <!-- Highchart. -->
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
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jenis Standar'
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
  @endsection
