<script>
$(document).ready(function() {
    $("#btnSave").click(function() {
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/meja/store",
            dataType: "json",
            data: $("#formMovie").serialize(),
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
            url: "<?php echo url('/') ?>/meja/show",
            dataType: "json",
            data: {id:id, _token: "<?php echo csrf_token() ?>"},
            success: function(result) {
                let text = "";
                text += "<tr><th>Nama</th><td>"+result.nama+"</td></tr>";
                text += "<tr><th>Kapasitas</th><td>"+result.kapasitas+"</td></tr>";
                text += "<tr><th>Status</th><td><small class='badge badge-success'>"+result.status+"</small></td></tr>";

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
            url: "<?php echo url('/') ?>/meja/show",
            dataType: "json",
            data: {id:id, _token: "<?php echo csrf_token() ?>"},
            success: function(result) {
                $("#nama").val(result.nama);
                $("#kapasitas").val(result.kapasitas);
                $("#id").val(result.id);
                $("#modalEdit").modal("show");
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
                    url: "<?php echo url('/') ?>/meja/destroy",
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

    $("#btnEdit").click(function() {
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/meja/update",
            dataType: "json",
            data: $("#formMovie").serialize(),
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