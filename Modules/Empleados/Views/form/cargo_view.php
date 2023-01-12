<!-- Page Content -->
    <div class="container" style="margin-top: 20px; margin-left:15%;">
            <h3 style="text-align: center; margin-bottom: 20px;">Cargos y Puestos</h3>
            <a class="btn btn-success">Agregar</a>
        <table class="table table-hover" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cargo as $rows) {
                    echo "<tr>";
                    echo "<td>". $rows['codigo']. "</td>";
                    echo "<td>". $rows['descripcion']. "</td>";
                    echo "<td>". $rows['estado']. "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


    <!-- Paginacion -->
    <div style="margin-top: 10px;">
    <?= $pager->links() ?>
    </div>
    <!--- ventanas modales para agregar cargos -->

    <!-- Modal Add Cargos-->
    <form action="cargo/save" method="post">
        <div class="modal fade" id="InsertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Puesto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" class="form-control" name="descripcion">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Vacaciones-->
    </div>
    <script>
        $(document).ready(function(){
            $('.btn-success').on('click',function(){
                $('#InsertModal').modal('show');
            });
        });
    </script>