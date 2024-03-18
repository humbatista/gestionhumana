<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
        <h3 style="text-align: center; margin-bottom: 20px;">Pensiones solicitadas</h3>
        <div class="row">
        <!-- Formulario de busqueda -->
        <form method="get" action="admpension" id="searchForm">
            <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
            <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
        </form>
        <a href="<?php echo base_url('solicitud/admin/admpension/export'); ?>" class="btn btn-success">General Reporte para enviar</a>
        </div>
        <br />

        <table class="table table-hover" style="border-collapse: collapse;">
        <thead>
            <tr>
                <td>Distrito</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Cedula</td>
                <td>Telefono</td>
                <td>Usuario</td>
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
                echo "<td>". $users['nombre']. "</td>";
                echo "<td>". $users['apellido']. "</td>";
                echo "<td>". $users['cedula']. "</td>";
                echo "<td>". $users['telefono']. "</td>";
                echo "<td>". $users['usuario']. "</td>";
                echo "<td>". $users['status']. "</td>";
                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                echo "<td>
                <a href='#' class='btn btn-info btn-sm' data-id=". $users['idpension'].">Aceptar</a>
                        <a href='#' class='btn btn-sm btn-success btn-edit' data-id=". $users['idpension'].">Aprobar</a>
                        <a href='#' class='btn btn-sm btn-warning' data-id=". $users['idpension'].">Devolver</a>
                        <a href='#' class='btn btn-danger btn-sm btn-delete' data-id=". $users['idpension'].">Rechazar</a>
                        <a href='oficiopension/".$users['idpension']."' class='btn btn-primary btn-sm' data-id=". $users['idpension'].">Solicitar</a>
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
                <input type="hidden" name="tipo" value="Pension">
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
                url:'<?php echo base_url('solicitud/admin/pension/aprobar');?>',
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
                url:'<?php echo base_url('solicitud/admin/pension/devolver');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    //location.reload();
                    observacion (id);
                    },
                    error: function(){
                        alert('Error devolver');
                    }
            });
        });
        $('.btn-delete').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/pension/rechazar');?>',
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
                url:'<?php echo base_url('solicitud/admin/pension/aceptar');?>',
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