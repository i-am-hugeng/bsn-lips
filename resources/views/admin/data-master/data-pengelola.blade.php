@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pengelola Layanan</h3>

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
                    <table class="table table-hover"  id="datatable-pengelola">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->password}}</td>
                                <td>
                                    <button title="edit" class="btn btn-sm btn-primary" data-id_pengelola="{{ $user->id }}" data-nama="{{ $user->name }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}" data-toggle="modal" data-target="#modal-edit-pengelola">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="footer-table"></div>
                </div>
            </div>
        </div>
    </section>


    <div id="modal-edit-pengelola" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
            <form id="data-pengelola" action="{{ route('data-pengelola.update') }}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Data Pengelola</h4>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="id_pengelola" id="id_pengelola" value="">
                        <div class="form-group">
                            <input type="text" name="nama" id="nama" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" id="email" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="password" id="password" value="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-success">Ubah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>

        </div>
     </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
              $('#datatable-pengelola').DataTable({
                "lengthMenu": [ 10, 25, 50, 75, 100, 200 ],
                  "columnDefs": [{
                      "searchable": true,
                      "orderable": true,
                      "targets": 0
                  }],
                  "order": [[ 0, "asc" ]]
              });
        });
    </script>

    <script>
        $('#modal-edit-pengelola').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id_pengelola = button.data('id_pengelola')
            var nama = button.data('nama')
            var email = button.data('email')
            var password = button.data('password')

            var modal = $(this)
            modal.find('.modal-body #id_pengelola').val(id_pengelola);
            modal.find('.modal-body #nama').val(nama);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #password').val(password);
        })
    </script>
@endsection
