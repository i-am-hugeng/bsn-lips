/**
 * Created by Seto Kuncoro on 29/04/2021.
 */
if ($("#main_form").length > 0) {
    $("#main_form").validate({
        rules: {
            nama: {
                required : true,
                maxlength: 50
            },
            nip: {
                numeric  : true,
                required : true,
                maxlength: 18
            },
            email: {
                required : true,
                maxlength: 50,
                email    : true
            },
            level1: {
                required : true
            },
            level2: {
                required : true
            },
            level3: {
                required : true
            },
            tujuan_pengguna: {
                required : true
            },
            nomor_standar: {
                required : true
            },
            jenis_standar: {
                required : true
            }
        },
        messages: {
            nama: {
                required: "Nama wajib diisi.",
                maxlength: "Nama tidak boleh lebih dari 50 karakter."
            },
            nip: {
                required: "NIP wajib diisi.",
                maxlength: "NIP tidak boleh lebih dari 18 karakter."
            },
            email: {
                required: "Email wajib diisi.",
                email: "Isi sesuai dengan format penulisan email.",
                maxlength: "Email tidak boleh lebih dari 50 karakter."
            },
            level1: {
                required: "Unit Kerja Es. I wajib diisi."
            },
            level2: {
                required: "Unit Kerja Es. II wajib diisi."
            },
            level3: {
                required: "Unit Kerja Es. III wajib diisi."
            },
            tujuan_pengguna: {
                required: "Tujuan pengguna wajib diisi."
            },
            nomor_standar: {
                required: "Nomor standar wajib diisi."
            },
            jenis_standar: {
                required: "Jenis standar wajib diisi."
            }
        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submit').html('Please Wait...'). attr("disabled", true);
            $.ajax({
                url: "{{url('store-data')}}",
                type: "POST",
                data: $('#contactUsForm').serialize(),
                success: function() {
                    $('#submit').html('Submit').attr("disabled", false);
                    swal('Done','Ajax form has been submitted successfully','success');
                    document.getElementById('contactUsForm').reset();
                }
            });
        }
    })
}
