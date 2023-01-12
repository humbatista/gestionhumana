<body>
    <div class="container">
        <?php foreach ($evaluaciones as $rows): ?>
            <div class='w3-card-4'>
                <header class='w3-container w3-gray'>
                    <h1><?= $rows->nombres." ". $rows->apellidos; ?></h1>
                </header>
                <body class='w3-container'>
                    <div class='row'>
                        <div class='col-sm-5'>
                            <p>Cedula: <?= $rows->cedula; ?></p>
                            <p>Calificacion: <?= $rows->calificacion; ?></p>
                        </div>
                        <div class='col-sm-5'>
                            <p>Fecha Evaluacion: <?= $rows->fecha; ?></p>
                            <p>Periodo: <?= $rows->periodo; ?></p>
                        </div>
                        <div class='col-sm-2'>
                            <form action="evaluar/print" method="post">
                                <input type="hidden" name="id" value=<?= $rows->id;?>>
                                <button type="submit" class='btn' ><i class='fa fa-edit'></i></button>
                                <a class='btn' onclick=ImpReporte(<?= $rows->id;?>)><i class='fa fa-print'></i></a>
                            </form>
                        </div>
                    </div>
                </body>
            </div><br>
        <?php endforeach; ?> 
    </div>

    <!-- Modal Historico-->
    <div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>HISTORICO DE EVALUACIONES</h2>
                    </div>
                    <div class="modal-body">
                    <div id="historico">
                        <script src=<?php echo base_url('public/assets/js/historico.js');?>></script>
                        <!-- <script>
                            function funcionhist(valor) {
                                $.ajax({
                                    url: "<?php //echo base_url('empleados/historico'); ?>",
                                    type: "post",
                                    data: {id: valor},
                                    dataType: 'json',
                                    beforeSend: function (f) {
                                        $('#historico').html('Cargar Tabla...');
                                    },
                                    success:function(data){
                                        $('#obsModal').modal('show');
                                        $('#historico').html(data);
                                    },
                                    error: function(){
                                        alert('No se encontraron registros');
                                    }
                                });
                            };
                        </script> -->
            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
    function ImpReporte (valor) {
        //var id = $('#fechaini').val();
        id = valor;
        //alert(valor);
        $.ajax({
            url:"<?php echo base_url() ?>/empleados/evaluar/print",
            type: "post",
            data: {'id': id},
        });
    };
</script>
</body>