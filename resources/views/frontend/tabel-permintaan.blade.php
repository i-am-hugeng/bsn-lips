<!DOCTYPE html>
<html>
<head>

    <title>LIPS | Tabel Permintaan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">

    <!-- Font Family -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body>
    {{-- Navbar Start --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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

    <div class="container" id="table-wrapper">
        <div class="judul-tabel">
            <h2>Tabel Permintaan Dokumen Standar Internal</h2>
            <p class="title-footnote"><strong>*) Status permintaan bisa dilihat pada tabel berikut ini.</strong></p>
        </div>
        <table class="table table-sm table-hover"  id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Unit Kerja</th>
                    <th>Total Permintaan</th>
                    <th>Total Terlayani</th>
                    <th>Tanggal Permintaan</th>
                    <th>Tanggal Proses</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
        <div id="footer-table"></div>
    </div>

    {{-- Modal Lihat Keterangan --}}
    <div class="modal fade" id="modal-lihat-keterangan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-danger">Keterangan Gagal Proses Permintaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal-lihat-keterangan-body">
                  
                  
              </div>
              <div class="modal-footer justify-content-between">

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- End of - Modal Blokir Dokumen --}}

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/jquery.dataTables.js') }}"></script> --}}

<script type="text/javascript">
  $(document).ready(function(){
        $('#datatable').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{route('tabel-permintaan')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'DT_RowIndex',
                    name : 'DT_RowIndex',
                    orderable : false,
                },
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
                    data : 'terlayani',
                    name : 'terlayani',
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
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="badge badge-warning">Menunggu</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="badge badge-success">Terkirim</span>';
                        }
                        else {
                            return row.status = '<button type="button" id="'+ row.id +'" class="btn badge badge-danger tombol-lihat-keterangan">Gagal</button>';
                        }
                    }
                },
            ],
            columnDefs: [
                { width: "5%", targets: [3,4] },
                {className: "ver-all", target: 0}
            ],
            order : [[5, 'desc']],

            // "columnDefs": [{
            //     "searchable": true,
            //     "orderable": true,
            //     "targets": 0
            // }],
            // "order": [[ 3, "desc" ]]
        });

        $(document).on('click', '.tombol-lihat-keterangan', function() {
            $('#modal-lihat-keterangan-body').html('');

            var id_gagal = $(this).attr('id');

            $.ajax({
                type: "GET",
                url: "/tabel-permintaan/lihat-keterangan-gagal/"+id_gagal,
                success: function (response) {
                    $('#modal-lihat-keterangan-body').append(
                        '<table class="table table-bordered">\
                            <thead class="bg-danger text-white">\
                                <tr>\
                                    <th>No</th>\
                                    <th>Jenis Standar</th>\
                                    <th>Nomor Standar</th>\
                                    <th>Keterangan</th>\
                                </tr>\
                            </thead>\
                            <tbody id="data-list">\
                                \
                            </tbody>\
                        </table>'
                    );

                    $.each(response.data, function(key, item) {
                        $('#data-list').append(
                            '<tr>\
                                <td>'+(key+1)+'</td>\
                                <td>'+item.nomor_standar+'</td>\
                                <td>'+item.jenis_standar+'</td>\
                                <td>'+item.ket_blokir+'</td>\
                            </tr>'
                        );
                    });

                }
            });

            $('#modal-lihat-keterangan').modal('show');
        });

    });
</script>
@include('sweetalert::alert')
</html>
