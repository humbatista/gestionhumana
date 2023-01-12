<div id="pensionTable"></div>

<script>
    reloadTable()

    function reloadTable(){
        $.ajax({
            url: "<?php echo site_url('Pension_admin/pension_table'); ?>",
            beforeSend: function (f) {
                $('#pensionTable').html('Cargar Tabla...');
            },
            success: function (data) {
                $('#pensionTable').html(data);
            }
        })
    }
</script>