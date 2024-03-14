<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:15%;">
    <h3 style="text-align: center; margin-bottom: 48px; font-size: 60px;">Listado Colaboradores</h3>
    <!--Formulario de busqueda -->
    <div class='row'>
        <div class='col-md-5'>
            <form method="get" name="searchForm" action="empleados/" id="searchForm">
                <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
                <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
            </form>
        </div>
        <div class="col-md-5">
            <a type='button' href='<?php echo base_url('empleados/export'); ?>' class="btn btn-success">Imprimir Listado</a>
        </div>
    </div>

    <table class="table table-hover" style="border-collapse: collapse;">
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Cedula</td>
                <td>Cargo</td>
                <td>Funcion</td>
                <td>Unidad</td>
                <td>Ingreso</td>
                <td>Vacaciones</td>
                <td>Estado</td>
                <td>Acci&oacute;n</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($empleados as $rows) {
                if ($rows['vacaciones'] == 'SI') {
                    $color = '#E57373';
                    $semaforo = 'text-danger';
                } else {
                    $color = '#FFEE58';
                    $semaforo = 'text-success';
                }
                echo "<tr>";
                echo "<td>" . $rows['nombre'] . "</td>";
                echo "<td>" . $rows['apellido'] . "</td>";
                echo "<td>" . $rows['cedula'] . "</td>";
                echo "<td>" . $rows['cargo'] . "</td>";
                echo "<td>" . $rows['funcion'] . "</td>";
                echo "<td>" . $rows['unidad'] . "</td>";
                echo "<td>" . $rows['fecingreso'] . "</td>";
                echo "<td>" . $rows['vacaciones'] . "</td>";
                echo "<td><i class='fa fa-circle " . $semaforo . "'></i></td>";
                echo "<td>
                        <a href='http://localhost/gestionhumana/empleados/servidor?codigo=" . $rows['codigo'] . "'class='btn  btn-info'>Ver</a>
                        <a href= 'http://localhost/gestionhumana/empleados/editar?id=" . $rows['codigo'] . "' class='btn  btn-warning' data-id=" . $rows['codigo'] . ">Editar</a>
                        <a href= 'http://localhost/gestionhumana/empleados/certificado?id=" . $rows['codigo'] . "' class='btn btn-success'>Certificado</a>
                        <a href= '#' class='btn btn-danger' data-id=" . $rows['codigo'] . ">Desactivar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>


    <!-- Paginacion -->
    <div style="margin-top: 10px;">
        <?= $pager->links() ?>
    </div>

</div>


<!-- Modal Validacion desactivar -->
<form action="empleados/desactivar" method="post">
    <div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="obsModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmacion desactivar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</spanF>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea desactivar este Colaborador</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Si</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function ImpCertificado() {
        //alert('funciona');
        $.ajax({
            //url: '<?php //echo base_url('solicitud/reporte/inclusion/export');
                    ?>',
            url: '<?php echo base_url('empleados/export'); ?>',
            type: "post",
            data: {},
        });
    };
</script>

<script>
    $(document).ready(function() {
        $('.btn-danger').on('click', function() {
            var id = $(this).data('id');
            //alert(id)
            $('.id').val(id);
            $('#obsModal').modal('show');
        });
    });
</script>