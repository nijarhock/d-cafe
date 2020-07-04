<script>
$(document).ready(function() {
    $("#file").change(function () {
        if (this.files && this.files[0]) {
            $(".custom-file-label").empty();
            $(".custom-file-label").append(this.files[0].name);
            var reader = new FileReader();
            reader.onload = function () {
                $(".preview").css('background-image', 'url(' + reader.result + ')');
                $(".preview").css('background-repeat', 'no-repeat');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#formMovie").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/menu/store",
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            success: function(result) {
                if(result == "OK")
                {
                    swal("Berhasil!", "Berhasil Tambah Data", "success");
                    location.reload();
                }
                else
                {
                    swal("Gagal!", result, "error");
                }
            },
            error: function(result) {
                for(key in result.responseJSON)
                {
                    swal("Gagal!", result.responseJSON[key][0], "error");
                    break;
                    console.log(result.responseJSON[key][0]);
                }
            }
        })
    });

    $(".show").click(function() {
        let id = $(this).data("id");
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/menu/show",
            dataType: "json",
            data: {id:id, _token: "<?php echo csrf_token() ?>"},
            success: function(result) {
                let text = "";
                text += "<tr><th>Gambar</th><td><img src='"+result.url_gambar+"'></td></tr>";
                text += "<tr><th>Kategori</th><td>"+result.nama_kategori+"</td></tr>";
                text += "<tr><th>Kode</th><td>"+result.kode+"</td></tr>";
                text += "<tr><th>Nama</th><td>"+result.nama+"</td></tr>";
                text += "<tr><th>Keterangan</th><td>"+result.ket+"</td></tr>";
                text += "<tr><th>Stok Minimal</th><td>"+result.stok_min+"</td></tr>";
                text += "<tr><th>Stok</th><td>"+result.stok+"</td></tr>";
                text += "<tr><th>Harga</th><td>"+result.harga_format+"</td></tr>";
                text += "<tr><th>Status</th><td>"+result.status+"</td></tr>";

                $("#table-detail").empty();
                $("#table-detail").append(text);
                $("#modalDetail").modal("show");
            },
            error: function(result) {

            }
        });
    });

    $(".edit").click(function() {
        let id = $(this).data("id");
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/menu/show",
            dataType: "json",
            data: {id:id, _token: "<?php echo csrf_token() ?>"},
            success: function(result) {
                $("#kode").val(result.kode);
                $("#nama").val(result.nama);
                $("#ket").val(result.ket);
                $("#stok_min").val(result.stok_min);
                $("#stok").val(result.stok);
                $("#harga").val(result.harga);
                $("#status").val(result.status);
                $("#menu_kategori_id").val(result.menu_kategori_id);
                $("#id").val(result.id);
                $("#modalEdit").modal("show");
                $('#modalEdit').on('shown.bs.modal', function (e) {
                    $(".preview").css('background-image', "url('" + result.url_gambar + "')");
                    $(".preview").css('background-repeat', 'no-repeat');
                })
            },
            error: function(result) {

            }
        });
    });

    $(".hapus").click(function() {
        let id = $(this).data("id");
        swal({
            title: "Apakah Anda Yakin?",
            text: "File Tidak Bisa Di Kembalikan !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: "post",
                    url: "<?php echo url('/') ?>/menu/destroy",
                    dataType: "json",
                    data: {id:id, _token: "<?php echo csrf_token() ?>"},
                    success: function(result) {
                        if(result == "OK")
                        {
                            swal("Berhasil!", "Berhasil Hapus Data", "success");
                            location.reload();
                        }
                        else
                        {
                            swal("Gagal!", result, "error");
                        }
                    },
                    error: function(result) {
                        for(key in result.responseJSON)
                        {
                            swal("Gagal!", result.responseJSON[key][0], "error");
                            break;
                            console.log(result.responseJSON[key][0]);
                        }
                    }
                });
            }
        });
    });

    $("#formMenu").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/menu/update",
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            success: function(result) {
                if(result == "OK")
                {
                    swal("Berhasil!", "Berhasil Ubah Data", "success");
                    location.reload();
                }
                else
                {
                    swal("Gagal!", result, "error");
                }
            },
            error: function(result) {
                for(key in result.responseJSON)
                {
                    swal("Gagal!", result.responseJSON[key][0], "error");
                    break;
                    console.log(result.responseJSON[key][0]);
                }
            }
        })
    });
    
});
</script>