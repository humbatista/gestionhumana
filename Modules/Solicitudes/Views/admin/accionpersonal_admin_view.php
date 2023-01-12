<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
        <h3 style="text-align: center; margin-bottom: 20px;">Accion de Personal</h3>
        <div class="row">
        <!-- Formulario de busqueda -->
        <form method="get" action="admaccion" id="searchForm">
            <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
            <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
        </form>
        <a href="<?php echo base_url('solicitud/admin/admaccion/export'); ?>" class="btn btn-success">General Reporte para enviar</a>
        </div>
        <br />

        <table class="table table-hover" style="border-collapse: collapse;">
        <thead>
            <tr>
                <td>Distrito</td>
                <td>Fecha</td>
                <td>Nombre del Recomendado</td>
                <td>Cedula del Recomendado</td>
                <td>Tipo Accion de Personal</td>
                <td>Cargo Actual</td>
                <td>Cargo Propuesto</td>
                <td>Nombre de la Persona Sustituida</td>
                <td>Cedula de la Persona Sustituida</td>
                <td>Observacion</td>
                <td>Status</td>
                <td>Estado</td>
                <td>Acci&oacute;n</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $users) {
                if($users['status']=='Rechazada'){
                    $color = '#E57373';
                    $semaforo = 'text-danger';
                } else if($users['status']=='Devuelta'){
                    $color = '#FFEE58';
                    $semaforo = 'text-warning';
                } else if($users['status']=='Aprobada'){
                    $color = '#C5E1A5';
                    $semaforo = 'text-success';
                } else if($users['status']=='Aceptada'){
                    $color = '#C5E1A5';
                    $semaforo = 'text-primary';
                } else{
                    $color ='#FFFFFF';
                    $semaforo = 'text-light';
                }
                echo "<tr>";
                echo "<td>". $users['distrito']. "</td>";
                echo "<td>". $users['fecha']. "</td>";
                echo "<td>". $users['nombre_recomendado']. "</td>";
                echo "<td>". $users['cedula_recomendado']. "</td>";
                echo "<td>". $users['tipo_accion']. "</td>";
                echo "<td>". $users['cargo_actual']. "</td>";
                echo "<td>". $users['cargo_propuesto']. "</td>";
                echo "<td>". $users['nombre_sustituido']. "</td>";
                echo "<td>". $users['cedula_sustituido']. "</td>";
                echo "<td>". $users['observacion']. "</td>";
                echo "<td>". $users['status']. "</td>";
                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                echo "<td>
                        <a href='#' class='btn secondary btn-sm' data-id=". $users['id']." onclick='observacion(".$users['id'].")'>Observacion</a>
                        <a href='#' class='btn btn-info btn-sm' data-id=". $users['id'].">Aceptar</a>
                        <a href='#' class='btn btn-primary btn-sm' data-id=". $users['id'].">Enviar</a>
                        <a href='#' class='btn btn-sm btn-success btn-edit' data-id=". $users['id'].">Aprobar</a>
                        <a href='#' class='btn btn-sm btn-warning' data-id=". $users['id'].">Devolver</a>
                        <a href='#' class='btn btn-danger btn-sm btn-delete' data-id=". $users['id'].">Rechazar</a>
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


<!-- Modal Observaciones -->
<form action="obssave" method="post">
    <div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="obsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea class="form-control observaciones" id="observaciones"  name="observaciones" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id">
                <input type="hidden" name="tipo" value='AccionPers'>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
    </div>
</form>
<script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-edit').on('click',function(){
            var id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/exclusion/aprobar');?>',
                type: "post",
                data: {valor: id},
                success:function(){
                    location.reload();
                    },
                    error: function(){
                        alert('Error');
                    }
            });
        });
 
        // get Delete Product
        $('.btn-warning').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/accionpersonal/devolver');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    //location.reload();
                    observacion (id);
                    },
                    error: function(){
                        alert('Error devorver');
                    }
            });
        });
        $('.btn-delete').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/accionpersonal/rechazar');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    //location.reload();
                    observacion (id);
                    },
                    error: function(){
                        alert('Error rechazar');
                    }
            });
        });
        $('.btn-info').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/accionpersonal/aceptar');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    location.reload();
                    },
                    error: function(){
                        alert('Error aceptar');
                    }
            });
        });

        $('.btn-primary').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/accionpersonal/enviar');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    location.reload();
                    },
                    error: function(){
                        alert('Error enviar');
                    }
            });
        });
    });
</script>

<script>
    function observacion(valor){
        var id = valor;        
              // Set data to Form Edit
            $('.id').val(id);
            $('#obsModal').modal('show');
    }
</script>