@extends('layouts.master')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tabel Unit Kerja - Jenis Standar | Deputi Bidang Pengembangan Standar</h3>

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
                <table class="table table-hover"  id="datatable-standar">
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
                    @foreach ($pengembangan as $data)
                        <tr>
                            <td>{{$data->unit}}</td>
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
          <h3 class="box-title">Tabel Permintaan | Deputi Bidang Pengembangan Standar</h3>

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
              <table class="table table-hover"  id="pengembangan-dt">
                  <thead>
                      <tr>
                          <th>Nama</th>
                          <th>Unit Kerja</th>
                          <th>Judul</th>
                          <th>Waktu Permintaan</th>
                          <th>Waktu Proses</th>
                          <th>Status</th>
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

<script type="text/javascript">
    $(document).ready(function(){
          $('#datatable-standar').DataTable({
              "searching"   : false,
              "paging"      : false,
              "info"        : false,
              "lengthChange": false,
              "columnDefs"  : [{
                  "searchable": true,
                  "orderable": true,
                  "targets": 0
              }],
              "order": [[ 0, "asc" ]]
          });
    });
  </script>
@endsection
