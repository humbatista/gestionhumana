<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
        <h3 style="text-align: center; margin-bottom: 20px;">Inclusion Dependientes</h3>
        <!--Formulario de busqueda -->
                <form method="get" name="searchForm"action="adminclusion" id="searchForm">
                    <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
                    <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
                </form>
                <a href="<?php echo base_url('solicitud/admin/adminclusion/export'); ?>" class="btn btn-success">General Reporte para enviar</a>
                <!-- <form method="post" action="Inclusion_admin/export1">
        <div class="row">
            <div><label> Fecha Inicial Reporte </label><input type='date' id="fechaini" name='fechaini' class="form-control"/></div>
            <hr width="5" size="500">
            <div><label> Fecha Final Reporte </label><input type='date' id="fechafin" name='fechafin' class="form-control"/></div>

        </div>
        <div class="row">
            <button type="Button" onClick="funBuscar()" class="btn btn-success">Buscar aqui</button>
            <button type="submit"  class="btn btn-info">General Reporte</button> -->
        <br />

        <table class="table table-hover" style="border-collapse: collapse;">
        <thead>
            <tr>
                <td>Distrito</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Telefono</td>
                <td>Dependiente</td>
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
                echo "<td>". $users['fecha']. "</td>";
                echo "<td>". $users['nombre']. "</td>";
                echo "<td>". $users['apellido']. "</td>";
                echo "<td>". $users['telefono']. "</td>";
                echo "<td>". $users['nombre_dependiente']. "</td>";
                echo "<td>". $users['usuario']. "</td>";
                echo "<td>". $users['status']. "</td>";
                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                echo "<td>
                <a href='#' class='btn btn-info btn-sm' data-id=". $users['idinclusion'].">Aceptar</a>
                        <a href='#' class='btn btn-sm btn-success btn-edit' data-id=". $users['idinclusion'].">Aprobar</a>
                        <a href='#' class='btn btn-sm btn-warning' data-id=". $users['idinclusion'].">Devolver</a>
                        <a href='#' class='btn btn-danger btn-sm btn-delete' data-id=". $users['idinclusion'].">Rechazar</a>
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
                    <input type="hidden" name="tipo" value='Inclusion'>
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
                //url:"<?php echo base_url() ?>/Inclusion_admin/aprobar",
                url:'<?php echo base_url('solicitud/admin/inclusion/aprobar');?>',
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
                url:'<?php echo base_url('solicitud/admin/inclusion/devolver');?>',
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
                url:'<?php echo base_url('solicitud/admin/inclusion/rechazar');?>',
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
                url:'<?php echo base_url('solicitud/admin/inclusion/aceptar');?>',
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

<script>
    function ImpReporte () {
        var fechaini = $('#fechaini').val();
        var fechafin = $('#fechafin').val();
        //alert(fechafin);
        $.ajax({
            url:"<?php echo base_url() ?>/Inclusion_admin/export",
            type: "post",
            data: {'valor1': fechaini, 'valor2': fechafin},
        });
    };
</script>