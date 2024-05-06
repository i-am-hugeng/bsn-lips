    @extends('layouts.frontend')

    @section('title', 'Dashboard')

    @section('css')
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.signature.css') }}">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

        <link rel="stylesheet" type="text/css" href="{{asset('select2/dist/css/select2.min.css')}}">
    @endsection

    @section('content')
        <div class="container items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <table class="table-bordered table-responsive">
                <tr>
                    <td rowspan="0" style="width: 20%">
                        <img src="{{asset('logo/bsn.png')}}" class="logo-header-tabel">
                    </td>
                    <td rowspan="0" style="width: 55%">
                        <div class="judul-tabel">
                            <h3>Formulir Permintaan Dokumen Standar Internal</h3>
                            <small class="title-footnote">*)Formulir ini hanya digunakan untuk kebutuhan dokumen standar di internal BSN</small>
                        </div>
                    </td>
                    <td style="padding-left: 0.5%">No. Dok.</td>
                    <td style="text-align: center">:</td>
                    <td style="padding-left: 0.5%">F.HKI.17.3.1</td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5%">Revisi</td>
                    <td style="text-align: center">:</td>
                    <td style="padding-left: 0.5%">0</td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5%">Tgl. Terbit</td>
                    <td style="text-align: center">:</td>
                    <td style="padding-left: 0.5%">10-08-2019</td>
                </tr>
                <tr>
                    <td style="padding-left: 0.5%">Halaman</td>
                    <td style="text-align: center">:</td>
                    <td style="padding-left: 0.5%">1 dari 1</td>
                </tr>
            </table>
            <div class="d-flex justify-content-center mt-3">
                <small class="inline font-weight-bold">Petunjuk pengisian formulir dapat dilihat pada halaman <a href="/tutorial">tutorial</a>.</small>
            </div>

            <form id="main_form" action="store" class="mt-5" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" id="counter" value="0">

                <h2 class="inline">Data Diri Pemohon</h2>
                <small class="footnote inline">( Tidak diperkenankan menggunakan identitas pegawai lain. )</small>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control autocomplete_txt ui-autocomplete-input" name="nama" id="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" class="form-control autocomplete_txt ui-autocomplete-input" name="nip" id="nip" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email BSN</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select id="unit_kerja" data-width="100%" class="form-select" name="unit_kerja"></select>
                </div>
                <h2 class="inline">Pejabat Pemberi Referensi</h2>
                <small class="footnote inline">( Data diri sesuai pimpinan yang berwenang di <strong>unit kerja</strong> pemohon. )</small>
                <hr>
                <div class=mb-3">
                    <label class="form-label">Nama Pejabat</label>
                    <input type="text" class="form-control" name="pejabat" id="nama_pejabat">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" id="jabatan" readonly>
                </div>
                <h2 class="inline">Watermark</h2>
                <small class="footnote inline">( <strong>Unit Kerja / Komite Teknis</strong> yang bertanggungjawab atas penggunaan dokumen standar. )</small>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Penanggung Jawab Dokumen</label>
                    <input type="text" class="form-control" name="watermark">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tujuan Penggunaan</label>
                    <select id="tujuan_penggunaan" class="form-control" name="tujuan_penggunaan"></select>
                </div>
                <div class="mb-3">
                    <select id="status" class="form-select" name="status" hidden>
                        <option value="0" selected></option>
                        <option value="1"></option>
                        <option value="2"></option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-9">
                        <h2 class="inline">Dokumen Standar</h2>
                        <small class="footnote inline">( Opsi format dokumen <strong>'word'</strong> hanya berlaku untuk jenis standar <strong>ISO</strong>. )</small>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="button" id="add_fields" class="btn btn-success"><span class="fa fa-plus"></span> Dokumen</button>
                    </div>
                </div>
                <hr>
                <div  id="add_document_div" class="mb-3"></div>
                <div class="row mb-3">
                    <div class="col-sm-8">
                        <table class="agreement">
                            <tr>
                                <td colspan="2" style="text-align: left;">
                                    Hal-hal yang perlu diperhatikan oleh pemohon dokumen standar :
                                </td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td style="text-align: left;">Formulir yang diisi dengan data invalid tidak akan diproses (Gagal Proses).</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td style="text-align: left;">Petugas layanan tidak akan melakukan proses pengiriman dokumen standar di luar akun email BSN.</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td style="text-align: left;">Layanan ini hanya digunakan bagi kebutuhan Standardisasi dan Penilaian Kesesuaian dalam internal BSN.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <label class="" for="">Tanda Tangan Pemohon</label>
                        <div id="sig" class="form-control"></div>
                        <button id="clear" class="btn btn-danger form-control">Hapus Tanda Tangan</button>
                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                    </div>
                </div>
                <br>
                <hr>
                <div class="mb-3">
                    <button id="submit" type="submit" class="btn btn-primary col-sm-2">Kirim Formulir</button>
                </div>
            </form>
        </div>
    @endsection

    @section('scripts')
        <!-- Script Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.signature.js') }}"></script>

        <script type="text/javascript">
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function() {
                $('#add_fields').click(function(){
                    add_inputs();
                });

                //Delete esign
                var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
                $('#clear').click(function(e) {
                    e.preventDefault();
                    sig.signature('clear');
                    $("#signature64").val('');
                });


                function add_inputs(){
                    var counter = parseInt($('#counter').val());
                    var html = '<div id="record['+ counter +']" class="row record" style="margin-top: 2%">'+
                        '<div class="col-sm-6">'+
                        '<input type="text" class="form-control nomor_standar" placeholder="--Nomor Standar--" name="nomor_standar['+ counter +']">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<select id="jenis_standar['+ counter +']" class="form-control jenis_standar" name="jenis_standar['+ counter +']">'+
                        '<option value="" selected>--Jenis Standar--</option>'+
                        '@foreach($jenis_standar_list as $jenis_standar)'+
                        '<option value="{{$jenis_standar['jenis_standar']}}">{{$jenis_standar['jenis_standar']}}</option>'+
                        '@endforeach'+
                        '</select>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                        '<select id="format['+ counter +']" class="form-control format" name="format['+ counter +']">'+
                        '<option value="'+0+'" selected>pdf</option>'+
                        '</select>'+
                        '</div>'+
                        '<div class="col-sm-1">'+
                        '<button type="button" class="remove_fields btn btn-danger form-control">Hapus</button>'+
                        '</div>'+
                        '</div>'+
                        '<select class="form-control" name="blokir['+ counter +']" hidden>'+
                            '<option value="'+0+'" selected></option>'+
                            '<option value="'+1+'"></option>'+
                        '</select>';
                    $('#add_document_div').append(html);
                    $('select[name="jenis_standar['+ counter +']"]').on('change', function() {
                        if($('select[name="jenis_standar['+ counter +']"]').val() == 'ISO') {
                            $('select[name="format['+ counter +']"]').append('<option value="'+1+'">word</option>')
                        }
                        else if($('select[name="jenis_standar['+ counter +']"]').val() != 'ISO') {
                            $('select[name="format['+ counter +']"] option[value="'+1+'"]').remove();
                        }
                    });
                    $('#counter').val( counter + 1 );
                }
                $(document).on('click','.remove_fields', function() {
                    $(this).closest('.record').remove();
                });

                //validasi eksistensi class record
                $('#submit').on('click', function (e) {
                    if ($('.record').length == 0) {
                        e.preventDefault();
                        Swal.fire({
                            icon : "warning",
                            title: "Peringatan",
                            text: "Data dokumen standar wajib diisi.",
                        });
                    }
                    else if($('#signature64').val() == ''){
                        e.preventDefault();
                        Swal.fire({
                            icon : "warning",
                            title: "Peringatan",
                            text: "Tanda tangan wajib diisi.",
                        });
                    }
                    else{
                        //dynamic field validation
                        $('form#main_form').on('submit', function(event) {
                            $('.nomor_standar').each(function() {
                                $(this).rules("add",
                                    {
                                        required: true,
                                        maxlength: 40,
                                        messages: {
                                            required: "Nomor standar wajib diisi.",
                                            maxlength: "Hanya satu nomor standar yang ditulis pada tiap kolom pengisian.",
                                        }
                                    }
                                );
                            });
                            $('.jenis_standar').each(function() {
                                $(this).rules("add",
                                        {
                                            required: true,
                                            messages: {
                                                required: "Jenis standar wajib diisi."
                                            }
                                        }
                                );
                            });
                            $('.format').each(function() {
                                $(this).rules("add",
                                        {
                                            required: true,
                                            messages: {
                                                required: "Format dokumen wajib diisi."
                                            }
                                        }
                                );
                            });
                        }).validate({
                            rules : {
                                nama : {
                                    required : true
                                },
                                nip : {
                                    required  : true
                                },
                                email : {
                                    required : true,
                                    maxlength: 50,
                                    email    : true
                                },
                                pejabat : {
                                    required : true
                                },
                                jabatan : {
                                    required : true
                                },
                                unit_kerja : {
                                    required : true
                                },
                                tujuan_penggunaan : {
                                    required : true
                                },
                                watermark : {
                                    required : true
                                }
                            },
                            messages : {
                                nama : {
                                    required : "Nama wajib diisi."
                                },
                                nip : {
                                    required : "NIP wajib diisi."
                                },
                                email : {
                                    required : "Email wajib diisi.",
                                    maxlength: "Email tidak boleh lebih dari 50 karakter.",
                                    email    : "Isi sesuai dengan format penulisan email."
                                },
                                pejabat : {
                                    required : "Nama wajib diisi."
                                },
                                jabatan : {
                                    required : "Nama wajib diisi."
                                },
                                unit_kerja : {
                                    required : "Unit Kerja wajib diisi."
                                },
                                tujuan_penggunaan : {
                                    required : "Tujuan penggunaan wajib diisi."
                                },
                                watermark : {
                                    required : "Tujuan penggunaan wajib diisi."
                                }
                            }
                        })
                    }
                });

                //autocomplete pemohon
                $("#nama").autocomplete({
                    source : function(request, response){
                        $.ajax({
                            url: "{{route('cari-nama-pemohon')}}",
                            type: "post",
                            dataType: "json",
                            data: {
                                _token: CSRF_TOKEN,
                                search: request.term
                            },
                            success: function (data) {
                                // console.log(data);
                                response($.map(data, function (item) {
                                    return {
                                        label: item.label,
                                        value: item.value
                                    }
                                }))
                            },
                            minLength: 3,
                            delay: 100
                        });
                    },
                    select : function(event, ui){
                        $('#nama').val(ui.item.label);
                        $('#nip').val(ui.item.value);
                        return false;
                    }
                });

                //select2 unit kerja
                $( "#unit_kerja" ).select2({
                    placeholder:true,
                    allowClear: true,
                    width: "resolve",
                    ajax: {
                    url: "{{route('cari-unit-kerja')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 100,
                    data: function (params) {
                        return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        console.log(response);
                        return {
                        results: response
                        };
                    },
                    cache: true
                    }
                });

                //autocomplete pejabat
                $("#nama_pejabat").autocomplete({
                    source : function(request, response){
                        $.ajax({
                            url: "{{route('cari-nama-pejabat')}}",
                            type: "post",
                            dataType: "json",
                            data: {
                                _token: CSRF_TOKEN,
                                search: request.term
                            },
                            success: function (data) {
                                console.log(data);
                                response($.map(data, function (item) {
                                    return {
                                        label: item.label,
                                        value: item.value
                                    }
                                }))
                            },
                            minLength: 3,
                            delay: 100
                        });
                    },
                    select : function(event, ui){
                        $('#nama_pejabat').val(ui.item.label);
                        $('#jabatan').val(ui.item.value);
                        return false;
                    }
                });
            });
        </script>
        {{-- <script src="{{asset('js/loading.js')}}"></script> --}}
        <script src="{{asset('js/dropdown.js')}}"></script>
        @include('sweetalert::alert')
    @endsection
