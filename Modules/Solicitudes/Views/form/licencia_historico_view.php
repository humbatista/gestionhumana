<!-- Page Content -->
<div class="container" style="margin-top: 20px; margin-left:10%;">
    <div class ="w3-card-4" style="width:80%">
        <header class="w3-container w3-blue">
            <h2>HISTORICO DE LICENCIA</h2>
        </header>
        <div class="w3-container"><br>
            <div>
            <form method="get" action="historico" id="searchForm">
                <input type="text" name="search" value="<?= $search ?>" placeholder="Buscar">
                <input type="submit" id="btnsearch" value="Ver Historico" onclick='document.getElementById("SeachForm").submit();'>
                <a href="<?php echo base_url('solicitud/licencia'); ?>" class="btn btn-info">Retorna a Licencias</a>
            </form>
            </div><br>
            <div>
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
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($licencia as $users) {
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
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
            </div>
        </div>  
    </div>     
        <!-- Formulario de busqueda -->
        
        


    <!-- Paginacion -->
    <div style="margin-top: 10px;">
    <?= $pager->links() ?>
    </div>
</div>




<script>
    function observacion(valor){
        var id = valor;        
              // Set data to Form Edit
            $('.id').val(id);
            $('#obsModal').modal('show');
    }
</script>