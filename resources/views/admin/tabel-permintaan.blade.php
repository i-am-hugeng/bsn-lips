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
        <h3 class="box-title">Tabel Permintaan</h3>

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
            <table class="table table-hover" style="font-size: 0.9em"  id="permintaan-dt">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Unit Kerja</th>
                        <th>Judul</th>
                        <th>Waktu Permintaan</th>
                        <th>Waktu Proses</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            <div id="footer-table"></div>
        </div>
      </div>
    </div>
      {{-- <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box --> --}}

  </section>
  <!-- /.content -->

<script type="text/javascript">
  $(document).ready(function(){
    /** TOKEN **/
    $(document).ready(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      });

      load_permintaan();

      function load_permintaan() {
        /** Fetch data permintaan **/
        $('#permintaan-dt').DataTable({
          language: {
              url: "/json/id.json"
          },
          processing : true,
          serverSide : true,
          ajax : {
              url : "{{route('tabel-permintaan-admin')}}",
              type : 'GET',
          },
          columns : [
            {
              data : 'nama',
              name : 'nama',
            },
            {
              data : 'singkatan',
              name : 'singkatan',
            },
            {
              data : 'permintaan',
              name : 'permintaan',
            },
            {
              data : 'created_at',
              name : 'created_at',
            },
            {
              data : 'updated_at',
              name : 'updated_at',
            },
            {
              data : 'status',
              name : 'status',
              render : 
                function(data, type, row) {
                    if(row.status == 0) {
                        return row.status = '<span class="label label-warning">Menunggu</span>';
                    }
                    else if(row.status == 1) {
                        return row.status = '<span class="label label-success">Terkirim</span>';
                    }
                    else {
                        return row.status = '<span class="label label-danger">Gagal</span>';
                    }
                }
            },
            {
              data : 'petugas',
              name : 'petugas',
            },
            {
              data : 'aksi',
              name : 'aksi',
            },
          ],
          order : [[3, 'desc']],
        });
      }

      //jika tombol blokir pada row datatable hasil survey di klik maka
      $(document).on('click', '.proses', function () {
          data_id = $(this).attr('id');
          // alert(data_id);

          $.ajax({
              url: "{{url('/admin/permintaan/proses')}}/" + data_id, //eksekusi ajax ke url ini
              type: 'PUT',
              success: function (data) { //jika sukses
                  setTimeout(function () {
                      var oTable = $('#permintaan-dt').dataTable();
                      oTable.fnDraw(false); //reset datatable
                  });
                  swal({
                      title : "Berhasil",
                      text  : "Permintaan dokumen telah diproses.",
                      icon  : "success",
                  });
              }
          })
      })
  });
</script>
  @endsection

