<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
        <h3 style="text-align: center; margin-bottom: 20px;">Registros Desvinculaciones</h3>

        <div class="row">
                <!-- Formulario de busqueda -->
                <form method="get" action="admdesvinculacion" id="searchForm">
                <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
                <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
                </form>
                <!-- Para impresion de los reportes descomente la proxima linea -->
                <!-- <a href="<?php echo base_url('solicitud/admin/admdesvinculacion/export'); ?>" class="btn btn-success">General Reporte para enviar</a> -->
        </div><br/>

        <table class="table table-hover" style="border-collapse: collapse;">
                <thead>
                        <tr>
                                <td>Distrito</td>
                                <td>Nombre</td>
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
                                echo "<td>". $users['cedula']. "</td>";
                                echo "<td>". $users['telefono']. "</td>";
                                echo "<td>". $users['usuario']. "</td>";
                                echo "<td>". $users['status']. "</td>";
                                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                                echo "<td>
                                        <a href='#' class='btn btn-sm btn-success btn-edit' data-id=". $users['id'].">Enviada</a>
                                        <a href='#' class='btn btn-sm btn-warning' data-id=". $users['id'].">Recibida</a>
                                        <a href='#' class='btn btn-danger btn-sm btn-delete' data-id=". $users['id'].">Entregada</a>
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



<!-- Seccion de Scripting
        en esta parte encontraremos todas las funciones
        para los botones de accion de la pagina -->
<script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/admdesvinculacion/enviada');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    location.reload();
                    },
                    error: function(){
                        alert('Error Enviada');
                    }
            });
        });
 
        // get Delete Product
        $('.btn-warning').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/admdesvinculacion/recibida');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    location.reload();
                     /* La siguiente linea se comento ya que hasta ahora los rechazados no requieren observaciones */
                    //observacion (id);
                    },
                    error: function(){
                        alert('Error recibida');
                    }
            });
        });
        $('.btn-delete').on('click',function(){
            const id = $(this).data('id');
            //alert(id)
            $.ajax({
                url:'<?php echo base_url('solicitud/admin/admdesvinculacion/entregada');?>',
                type: "post",
                data: {'id': id},
                success:function(){
                    location.reload();
                    /* La siguiente linea se comento ya que hasta ahora los rechazados no requieren observaciones */
                    //observacion (id);
                    },
                    error: function(){
                        alert('Error entregada');
                    }
            });
        });
    });
</script>


