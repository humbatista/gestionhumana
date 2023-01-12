<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:15%;">
        <h3 style="text-align: center; margin-bottom: 48px; font-size: 60px;">Listado Colaboradores</h3>
        <!--Formulario de busqueda -->
            <div class='row'> 
                <div class='col-md-5'> 
                    <form method="get" name="searchForm"action="empleados/" id="searchForm">
                        <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
                        <input type="submit" id="btnsearch" value="Submit" onclick='document.getElementById("SeachForm").submit();'>
                    </form>
                </div>
                <div class="col-md-5"> 
                    <a type='button' href='<?php echo base_url('empleados/export');?>' class="btn btn-success">Imprimir Listado</a>
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
                if($rows['vacaciones']=='SI'){
                    $color = '#E57373';
                    $semaforo = 'text-danger';
                } else{
                    $color = '#FFEE58';
                    $semaforo = 'text-success';
                }
                echo "<tr>";
                echo "<td>". $rows['nombre']. "</td>";
                echo "<td>". $rows['apellido']. "</td>";
                echo "<td>". $rows['cedula']. "</td>";
                echo "<td>". $rows['cargo']. "</td>";
                echo "<td>". $rows['funcion']. "</td>";
                echo "<td>". $rows['unidad']. "</td>";
                echo "<td>". $rows['fecingreso']. "</td>";
                echo "<td>". $rows['vacaciones']. "</td>";
                echo "<td><i class='fa fa-circle ".$semaforo."'></i></td>";
                echo "<td>
                        <a href='http://localhost/gestionhumana/empleados/servidor?codigo=".$rows['codigo']."'>Ver</a>
                        <a href= 'http://localhost/gestionhumana/empleados/editar?id=".$rows['codigo']."' class='btn btn-sm btn-warning' data-id=". $rows['codigo'].">Editar</a>
                        <a href='#' class='btn btn-success'>Certificado</a>
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

