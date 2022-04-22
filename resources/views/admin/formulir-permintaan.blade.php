@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Formulir Permintaan - Tanggal : {{$data_signed->created_at->format('d-m-Y')}}</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <h3>Data Diri Pemohon</h3>
                <input type="hidden" id="id_user" value="{{ $data_signed->id }}">
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$data_signed->nama}}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{$data_signed->nip}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$data_signed->email}}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td>{{$data_signed->unit_kerja}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Pejabat Pemberi Referensi</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pejabat</td>
                        <td>:</td>
                        <td>{{$data_signed->pejabat}}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{$data_signed->jabatan}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Watermark</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">Penanggung Jawab</td>
                        <td>:</td>
                        <td>{{$data_signed->watermark}}</td>
                    </tr>
                    <tr>
                        <td>Tujuan Penggunaan</td>
                        <td>:</td>
                        <td>{{$data_signed->tujuan_penggunaan}}</td>
                    </tr>
                </table>
                <h3>Nomor Standar Yang Diminta</h3>
                <table class="table table-bordered" id="dokumen-dt">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 20%">Jenis Standar</th>
                            <th>Nomor Standar</th>
                            <th>Format</th>
                            <th style="width: 20%">Aksi</th>
                            <th>Keterangan Blokir</th>
                        </tr>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-md-5 col-md-offset-7" style="text-align: center; margin-top: 3%">
                        <div>
                            <p>Jakarta, {{$data_signed->created_at->format('d-m-Y')}}</p>
                        </div>
                        <div>
                            <img src="{{asset('signupload/'.$data_signed->signed)}}" width="150px">
                        </div>
                        <div>
                            <p>{{$data_signed->nama}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Blokir Dokumen --}}
    <div class="modal fade" id="modal-blokir-dokumen">
        <form id="form-blokir-dokumen">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Blokir Dokumen Standar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal-blokir-dokumen-body">
                      
                      
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger tombol-blokir-dokumen">Blokir</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    {{-- End of - Modal Blokir Dokumen --}}

</div>

<!-- DOM Halaman Formulir Permintaan -->
<script type="text/javascript">
    $(document).ready(function() {
        /** TOKEN **/
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        load_dokumen();

        function load_dokumen() {
            /** Get id user **/
            user_id = $('#id_user').val();

            /** Fetch data dokumen **/
            $('#dokumen-dt').DataTable({
                ordering   : false,
                paging     : false,
                searching  : false,
                info       : false,
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{url('/admin/permintaan/lihat')}}/" + user_id,
                    type : 'GET',
                },
                columns : [
                    {
                        data : 'DT_RowIndex',
                        name : 'DT_RowIndex',
                    },
                    {
                        data : 'jenis_standar',
                        name : 'jenis_standar',
                    },
                    {
                        data : 'nomor_standar',
                        name : 'nomor_standar',
                    },
                    {
                        data : 'format',
                        name : 'format',
                        render : 
                            function(data, type, row) {
                                if(row.format == 0) {
                                    return row.format = '<span class="label label-primary">pdf</span>';
                                }
                                else {
                                    return row.format = '<span class="label label-default">word</span>';
                                }
                            }
                    },
                    {
                    data : 'aksi',
                    name : 'aksi',
                    },
                    {
                    data : 'ket_blokir',
                    name : 'ket_blokir',
                    },
                ],
            });
        }

        /******** Modal Blokir Dokumen Standar *********/
        $(document).on('click', '.blokir', function (e) {
            $('#modal-blokir-dokumen-body').html('');
            var id_blokir = $(this).attr('id');
            // alert(id_blokir_kwitansi);

            $.ajax({
                type: "GET",
                url: "/admin/permintaan/lihat/"+id_blokir+"/modal-blokir",
                success: function (response) {
                    $('#modal-blokir-dokumen-body').append(
                        '<input type="hidden" id="id_blokir_dokumen">\
                        <h6>Alasan memblokir dokumen standar <strong>'+ response.data.nomor_standar +'</strong> :</h6>\
                        <small class="text-danger">Sekali diblokir maka status blokir dokumen tidak dapat dirubah kembali.</small>\
                        <input type="hidden" id="status_blokir">\
                        <div class="form-group">\
                            <input type="text" name="ket_blokir" class="form-control ket_blokir" id="ket_blokir" placeholder="Masukkan alasan blokir dokumen...">\
                        </div>'
                    );
                    $('#id_blokir_dokumen').val(response.data.id);
                    $('#status_blokir').val(1);
                }
            });

            $('#modal-blokir-dokumen').modal('show');                
        });

        /** Blokir Dokumen Yang Tidak Tersedia **/
        $(document).on('click', '.tombol-blokir-dokumen', function(e) {
            // e.preventDefault();
            user_id = $('#id_user').val();
            doc_id = $('#id_blokir_dokumen').val();
            // alert(doc_id);

            var data = {
                'ket_blokir'   : $('.ket_blokir').val(),
            }

            url_1 = "/admin/permintaan/lihat/";
            url_2 = "/blokir/";
            // alert(url_1+user_id+url_2);

            $.ajax({
                url: url_1 + user_id + url_2 + doc_id, //eksekusi ajax ke url ini
                type: 'PUT',
                data: data,
                dataType: 'json',
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        var oTable = $('#dokumen-dt').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    swal({
                        title : "Berhasil",
                        text  : "Dokumen tidak tersedia telah diblokir.",
                        icon  : "success",
                    });
                    $('#modal-blokir-dokumen').modal('hide');
                }
            })
            return false;
        })
    });
</script>
@endsection
