<script>
    $(document).ready(function() {
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        
        $('#reservationdate1').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $("#btnCariPesanan").click(function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/laporan/detail_pesanan",
                dataType: "html",
                data: $("#formLaporan").serialize(),
                success: function(result) {
                    $("#detail").empty();
                    $("#detail").append(result);
                },
                error: function(result) {

                }
            });
        });

        $("#btnCariBayar").click(function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/laporan/detail_bayar",
                dataType: "html",
                data: $("#formLaporan").serialize(),
                success: function(result) {
                    $("#detail").empty();
                    $("#detail").append(result);
                },
                error: function(result) {

                }
            });
        });

        $("#btnCariDetail").click(function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/laporan/detail_detail",
                dataType: "html",
                data: $("#formLaporan").serialize(),
                success: function(result) {
                    $("#detail").empty();
                    $("#detail").append(result);
                },
                error: function(result) {

                }
            });
        });

        $("#btnCariLogs").click(function() {
            $.ajax({
                type: "post",
                url: "<?php echo url('/') ?>/detail_logs",
                dataType: "html",
                data: $("#formLaporan").serialize(),
                success: function(result) {
                    $("#detail").empty();
                    $("#detail").append(result);
                },
                error: function(result) {

                }
            });
        });
    });
</script>