@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pegawai Negeri Sipil BSN</h3>
                <button class="btn btn-sm btn-default" title="Tambah data pegawai" data-toggle="modal" data-target="#modal-tambah-pegawai">
                    <i class="fa fa-plus"></i>
                </button>

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
                    <table class="table table-hover"  id="pegawai-dt">
                        <thead>
                            <tr>
                                <th style="width: 20%">Nama Lengkap</th>
                                <th>NIP</th>
                                <th style="width: 50%">Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="footer-table"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Start: Modal Tambah Pegawai --}}
    <div class="modal fade" id="modal-tambah-pegawai">
        <form id="form-tambah-pegawai">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            Tambah Data Pegawai
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>    
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control nama_pegawai" id="nama_pegawai" placeholder="Masukkan nama pegawai...">
                        </div>
                        <div class="form-group">
                            <label for="nip_pegawai">NIP Pegawai</label>
                            <input type="text" name="nip_pegawai" class="form-control nip_pegawai" id="nip_pegawai" placeholder="Masukkan nip pegawai...">
                        </div>
                        <div class="form-group">
                            <label for="jabatan_pegawai">Jabatan Pegawai</label>
                            <input type="text" name="jabatan_pegawai" class="form-control jabatan_pegawai" id="jabatan_pegawai" placeholder="Masukkan jabatan pegawai...">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tambah-pegawai">Simpan</button>
                    </div>
                </div>
                <!-- /.modal-content -->
              </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    {{-- End: Modal Tambah Pegawai --}}

    {{-- Start: Modal Edit Pegawai --}}
    <div class="modal fade" id="modal-edit-pegawai">
        <form id="form-edit-pegawai">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            Edit Data Pegawai
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>    
                        </h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_pegawaiEdit">
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" name="nama_pegawaiEdit" class="form-control nama_pegawaiEdit" id="nama_pegawaiEdit" placeholder="Masukkan nama pegawai...">
                        </div>
                        <div class="form-group">
                            <label for="nip_pegawai">NIP Pegawai</label>
                            <input type="text" name="nip_pegawaiEdit" class="form-control nip_pegawaiEdit" id="nip_pegawaiEdit" placeholder="Masukkan nip pegawai...">
                        </div>
                        <div class="form-group">
                            <label for="jabatan_pegawai">Jabatan Pegawai</label>
                            <input type="text" name="jabatan_pegawaiEdit" class="form-control jabatan_pegawaiEdit" id="jabatan_pegawaiEdit" placeholder="Masukkan jabatan pegawai...">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary edit-pegawai">Simpan</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    {{-- End: Modal Edit Pegawai --}}

    {{-- Start : Modal Hapus Pegawai --}}
    <div class="modal fade" id="modal-hapus-pegawai">
        <form id="form-hapus-pegawai">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            Hapus Data Pegawai
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>    
                        </h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_pegawaiHapus">
                        <p>Anda yakin untuk hapus data pegawai ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger hapus-pegawai">Hapus</button>
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    {{-- End : Modal Hapus Pegawai --}}
@endsection

@section('footer')
<script type="text/javascript">

    $(document).ready(function() {
        
        load_pegawai();

        function load_pegawai() {
            /** Fetch data permintaan **/
            $('#pegawai-dt').DataTable({
                language: {
                    url: "/json/id.json"
                },
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{url('admin/data-master/data-pegawai')}}",
                    type : 'GET',
                },
                columns : [
                    {
                    data : 'nama_pegawai',
                    name : 'nama_pegawai',
                    },
                    {
                    data : 'nip_pegawai',
                    name : 'nip_pegawai',
                    },
                    {
                    data : 'jabatan_pegawai',
                    name : 'jabatan_pegawai',
                    },
                    {
                    data : 'aksi',
                    name : 'aksi',
                    },
                ],
                order : [[0, 'asc']],
            });
        }

        /******** Delete Data *********/
        $(document).on('click', '.tombol-hapus', function (e) {
            var pegawai_id = $(this).attr('id');
            //alert(element_id);
            $('#id_pegawaiHapus').val(pegawai_id);

            $('#modal-hapus-pegawai').modal('show');                
        });

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $(document).on('click', '.hapus-pegawai', function (e) {
            e.preventDefault();
            
            var pegawai_id = $('#id_pegawaiHapus').val();

            $.ajax({
                type: "DELETE",
                url: "/admin/data-master/data-pegawai/hapus-pegawai/"+pegawai_id,
                success: function (response) {
                    $('#modal-hapus-pegawai').modal('hide');
                    swal({
                        title : "Berhasil",
                        text  : "Data pegawai telah dihapus.",
                        icon  : "success",
                    });
                    setTimeout(function () {
                        var oTable = $('#pegawai-dt').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    })
                },
            });
        });

        /******** Edit Data Pegawai *********/
        $(document).on('click', '.tombol-edit', function(e) {
            var id_pegawai = $(this).attr('id');

            $('#modal-edit-pegawai').modal('show');

            $.ajax({
                type: "GET",
                url: "{{url('admin/data-master/data-pegawai/edit-pegawai')}}/"+id_pegawai,
                success: function (response) {
                    $('#id_pegawaiEdit').val(response.pegawai.id);
                    $('#nama_pegawaiEdit').val(response.pegawai.nama_pegawai);
                    $('#nip_pegawaiEdit').val(response.pegawai.nip_pegawai);
                    $('#jabatan_pegawaiEdit').val(response.pegawai.jabatan_pegawai);
                }
            });
        });

        $(document).on('click', '.edit-pegawai',function () {
            var pegawai_id = $('#id_pegawaiEdit').val();
            var data = {
                'nama_pegawaiEdit'    : $('#nama_pegawaiEdit').val(),
                'nip_pegawaiEdit'     : $('#nip_pegawaiEdit').val(),
                'jabatan_pegawaiEdit' : $('#jabatan_pegawaiEdit').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/admin/data-master/data-pegawai/update-pegawai/"+pegawai_id,
                data: data,
                dataType: "json",
            });

            $.validator.setDefaults({
                submitHandler: function () {
                    $('#modal-edit-pegawai').modal('hide');
                    $('#form-edit-pegawai').find('input').val("");
                    swal({
                        title: "Berhasil",
                        text: "Data pegawai telah diubah.",
                        icon: "success",
                    });
                    setTimeout(function () {
                        var oTable = $('#pegawai-dt').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    })
                }
            });    

            $('#form-edit-pegawai').validate({
                rules: {
                    nama_pegawaiEdit: {
                        required: true,
                    },
                    nip_pegawaiEdit: {
                        required: true,
                        number: true,
                    },
                    jabatan_pegawaiEdit: {
                        required: true,
                    },
                },
                messages: {
                    nama_pegawaiEdit: {
                        required: "Masukkan data nama pegawai.",
                    },
                    nip_pegawaiEdit: {
                        required: "Masukkan data NIP pegawai.",
                        number: "NIP pegawai harus berupa angka.",
                    },
                    jabatan_pegawaiEdit: {
                        required: "Masukkan data jabatan pegawai.",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });

        /******** Tambah Data Pegawai *********/
        $(document).on('click', '.tambah-pegawai', function(e) {               
            var data = {
                'nama_pegawai'   : $('.nama_pegawai').val(),
                'nip_pegawai'    : $('.nip_pegawai').val(),
                'jabatan_pegawai': $('.jabatan_pegawai').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type     : "POST",
                url      : "{{url('admin/data-master/data-pegawai')}}",
                data     : data,
                dataType : "json",
            });

            /******** Validasi Tambah Data Pegawai *********/
            $.validator.setDefaults({
                submitHandler: function () {
                // alert( "Form successful submitted!" );
                    $('#modal-tambah-pegawai').modal('hide');
                    $('#form-tambah-pegawai').find('input').val("");
                    setTimeout(function () {
                        var oTable = $('#pegawai-dt').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    swal({
                        title: "Berhasil",
                        text: "Data pegawai telah ditambahkan.",
                        icon: "success",
                    });
                }
            });
            
            $('#form-tambah-pegawai').validate({
                rules: {
                    nama_pegawai: {
                        required: true,
                    },
                    nip_pegawai: {
                        required: true,
                        number: true,
                    },
                    jabatan_pegawai: {
                        required: true,
                    },
                },
                messages: {
                    nama_pegawai: {
                        required: "Masukkan data nama pegawai.",
                    },
                    nip_pegawai: {
                        required: "Masukkan data NIP pegawai.",
                        number: "NIP pegawai harus berupa angka.",
                    },
                    jabatan_pegawai: {
                        required: "Masukkan data jabatan pegawai.",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
    });    

</script>
        
@endsection
