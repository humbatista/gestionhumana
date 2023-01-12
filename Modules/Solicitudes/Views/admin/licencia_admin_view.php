<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
        <h3 style="text-align: center; margin-bottom: 20px;">Licencias y Permisos</h3>
        <div class="row"> 
        <!-- Formulario de busqueda -->
        <form method="get" action="admlicencia" id="searchForm">
            <!-- <div class="form-group">
                <input type="radio" name="distrito" value="11-00"> 11-00
                <input type="radio" name="distrito" value="11-01"> 11-01
                <input type="radio" name="distrito" value="11-02"> 11-02
                <input type="radio" name="distrito" value="11-03"> 11-03
                <input type="radio" name="distrito" value="11-04"> 11-04
                <input type="radio" name="distrito" value="11-05"> 11-05
                <input type="radio" name="distrito" value="11-06"> 11-06
                <input type="radio" name="distrito" value="11-07"> 11-07
            </div> -->
            <select name="distrito">
                <option value="11-00">11-00</option>
                <option value="11-01">11-01</option>
                <option value="11-02">11-02</option>
                <option value="11-03">11-03</option>
                <option value="11-04">11-04</option>
                <option value="11-05">11-05</option>
                <option value="11-06">11-06</option>
                <option value="11-07">11-07</option>
            </select><br>
            <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
            <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
        </form><br>
        <a href="<?php echo base_url('solicitud/admin/licencia_export'); ?>" class="btn btn-success">General Reportes Lic. Comunes</a>
        <a href="<?php echo base_url('solicitud/admin/admlicenciamat/export'); ?>" class="btn btn-success">General Reporte Licencias Maternidad</a>
        </div>
        <br />

        <table class="table table-hover" style="border-collapse: collapse;">
        <thead>
            <tr>
                <td>Distrito</td>
                <td>Fecha</td>
                <td>Nombre</td>
                <td>Cedula</td>
                <td>Tipo Licencia</td>
                <td>Fecha</td>
                <td>Dias</td>
                <td>Fecha Inicial</td>
                <td>Fecha Fin</td>
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
                echo "<td>". $users['nombres']. "</td>";
                echo "<td>". $users['cedula']. "</td>";
                echo "<td>". $users['tipo_licencia']. "</td>";
                echo "<td>". $users['fecha']. "</td>";
                echo "<td>". $users['dias']. "</td>";
                echo "<td>". $users['fechaini']. "</td>";
                echo "<td>". $users['fechafin']. "</td>";
                echo "<td>". $users['status']. "</td>";
                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                echo "<td>
                <a href='#' class='btn btn-info btn-sm' data-id=". $users['id'].">Aceptar</a>
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
                <input type="hidden" name="tipo" value="Licencia">
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
                url:'<?php echo base_url('solicitud/admin/licencia/aprobar');?>',
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
                url:'<?php echo base_url('solicitud/admin/licencia/devolver');?>',
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
                url:'<?php echo base_url('solicitud/admin/licencia/rechazar');?>',
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
                url:'<?php echo base_url('solicitud/admin/licencia/aceptar');?>',
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