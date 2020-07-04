<script>
    $(document).ready(function() {
        $("#konsumen_id").change(function() {
            console.log("here")
            $("#diskon").val($(this).find('option:selected').data('diskon'));
        })
        @if(Request::segment(2) == '')
        $("#menu_id").autocomplete ({
            source: function (request, response) {
                $.ajax({
                    type: "post",
                    url: "<?php echo url('/') ?>/menu/cari",
                    dataType: "json",
                    data: {term:request.term, _token: "<?php echo csrf_token() ?>"},
                    success: function(data) {
                        response(data);
                    }
                })
            }
        });
        $("#menu_id").data('ui-autocomplete')._renderItem = function (ul, item) {
            // return $('<li>')
            //     .append('<a>'+'<img src="'+item.url_gambar+'" width="50" height="50">' + item.label + '--' + item.kode + '--' + item.nama + '</a>')
            //     .appendTo(ul);
            return $( "<li><div><img src='"+item.url_gambar+"'><span>"+item.nama+"</span></div></li>" ).appendTo( ul );
        };
        @endif

        function detail(kode)
        {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/detail",
                dataType: "html",
                data: {kode:kode, _token: "{{ csrf_token() }}"},
                success: function(result) {
                    $("#detail").empty();
                    $("#detail").append(result);
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

        $("#btnSave").click(function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/store",
                dataType: "json",
                data: $("#formMovie").serialize(),
                success: function(result) {
                    if(result == "OK")
                    {
                        $("#formMovie").hide();
                        detail($("#kode").val());
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
        });

        $("#menu_id").keypress(function(e) {
            if(e.which == 13)
            {
                $.ajax({
                    type: "post",
                    url: "<?php echo url('/') ?>/pesanan/store_detail",
                    dataType: "json",
                    data: {menu_id:$("#menu_id").val(), kode:$("#kode").val(), _token: "{{ csrf_token() }}"},
                    success: function(result) {
                        if(result == "OK")
                        {
                            detail($("#kode").val());
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

        $(".add-menu").click(function() {
            let id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/store_detail",
                dataType: "json",
                data: {menu_id:id, kode:$("#kode").val(), _token: "{{ csrf_token() }}"},
                success: function(result) {
                    if(result == "OK")
                    {
                        detail($("#kode").val());
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
        })

        $(document).on("click", "#btnDeleteDtl", function() {
            let id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/hapus_detail",
                dataType: "json",
                data: {id:id, _token:"{{ csrf_token() }}"},
                success: function(result) {
                    detail($("#kode").val());
                }
            });
        });

        $(document).on("click", "#simpanBayar", function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/simpan_bayar",
                dataType: "json",
                data: {jenis_byr_id:$("#jenis_byr_id").val(), nilai_bayar:$("#nilai_bayar").val(), kode:$("#kode").val(), _token:"{{ csrf_token() }}"},
                success: function(result) {
                    if(result == "OK")
                    {
                        window.open("{{ url('/') }}/print_invoice?kode="+$("#kode").val());
                        window.location.href = "{{ url('/') }}/pesanan";
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
        });

        $(document).on("click", "#print_dapur", function() {
            window.open("{{ url('/') }}/print_dapur?kode="+$("#kode").val());
        });

        $(document).on("click", "#tutup", function() {
            window.location.href = "{{ url('/') }}/pesanan";
        });

        $(document).on("click", ".show", function() {
            console.log("here");
            let id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/show",
                dataType: "html",
                data: {id:id, _token: "<?php echo csrf_token() ?>"},
                success: function(result) {
                    $("#table-detail").empty();
                    $("#table-detail").append(result);
                    $("#modalDetail").modal("show");
                },
                error: function(result) {

                }
            });
        });

        $(".batal").click(function() {
            let id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/proses_batal",
                dataType: "json",
                data: {id:id, _token: "{{ csrf_token() }}"},
                success: function(result) {
                    if(result == "OK")
                    {
                        swal("Berhasil!", "Berhasil Batal", "success");
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
        })

        $(document).on("blur", "#qty", function() {
            let id = $(this).data("id");
            let qty = $(this).val();

            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/pesanan/update_detail",
                dataType: "json",
                data: {id:id,qty:qty, kode:$("#kode").val(), _token: "{{ csrf_token() }}"},
                success: function(result) {
                    if(result == "OK")
                    {
                        detail($("#kode").val());
                    }
                    else
                    {
                        swal("Gagal!", result, "error");
                        detail($("#kode").val());
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
        });

        @if(Request::get('kode'))
        $.ajax({
            type: "post",
            url: "<?php echo url('/') ?>/pesanan/check_lanjut",
            dataType: "json",
            data: {kode:"{{ Request::get('kode') }}", _token: "<?php echo csrf_token() ?>"},
            success: function(result) {
                if(result == "OK")
                {
                    $("#kode").val("{{ Request::get('kode') }}");
                    $("#formMovie").hide();
                    detail("{{ Request::get('kode') }}");
                }
                else
                {
                    swal("Gagal!", result, "error");
                }
            },
            error: function(result) {

            }
        });
        @endif
    });
</script>