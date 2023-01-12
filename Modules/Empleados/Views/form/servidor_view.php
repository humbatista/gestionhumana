<section>
    <div class="w3-panel w3-card-4">
        <span>
            <h2>Datos del Servidor</h2>
            <div class="w3-bar w3-black">
                <a href="<?= base_url('empleados/')?>" class="w3-bar-item w3-button">REGRESAR</a>
                <a href="<?php echo base_url() ?>/empleados/editar?id=<?= esc($codigo) ?>" class="w3-bar-item w3-button">ACTUALIZAR</a>
            </div>
        </span>
        <div class='row'>
            <div data-id= <?= esc($codigo) ?> class="col-sm-5">
                <h4> Nombre: <?= esc($nombre) ?></h4>
                <h4> Apellido: <?= esc($apellido) ?></h4>
                <h4> Cedula: <?= esc($cedula)?></h4>
                <h4> Telefono: <?= esc($telefono)?></h4>
            </div>
            <div class="col-sm-7">
                <h4> Cargo: <?= esc($cargo) ?></h4>
                <h4> Funcion: <?= esc($funcion) ?></h4>
                <h4> Nacimiento: <?= esc($fecnacimiento) ?></h4>
                <h4> Ingreso: <?= esc($fecingreso)?></h4> 
            </div>
        </div>
    </div>
</section>


    <article>
        <div class="w3-panel w3-card-4">
            <h2>Vacaciones</h2>
            <div class="col-sm-8" id="vacaciones">
                <script>
                    $(document).ready(function() {
                    const id = <?= esc($codigo) ?>;
                    //const id = $(this).data('id');
                    //alert(id);
                    $.ajax({
                        url: "<?php echo base_url('empleados/servidor/vacaciones'); ?>",
                        type: "post",
                        data: {id: id},
                        dataType: 'json',
                        beforeSend: function (f) {
                        $('#vacaciones').html('Cargar Tabla...');
                        },
                                    success:function(data){
                                        //alert(data);
                                        $('#vacaciones').html(data);
                                    },
                                    error: function(){
                                        alert('No se encontraron registros');
                                    }
                                });
                    });
                </script>
            </div>
            <button style="margin-left: 93vW;" class="w3-button w3-circle w3-red btn-edit" href='#'>+</button>
        </div>
    </article>

    <article>
        <div class="w3-panel w3-card-4">
            <h2>Disfrute Vacaciones</h2>
            <div class="col-sm-8" id="disfrute">
                <script>
                    $(document).ready(function() {
                    const id = <?= esc($codigo) ?>;
                    //const id = 2;
                    //alert(id);
                    $.ajax({
                        url: "<?php echo base_url('empleados/servidor/disfrute'); ?>",
                        type: "post",
                        data: {id: id},
                        dataType: 'json',
                        beforeSend: function (f) {
                        $('#disfrute').html('Cargar Tabla...');
                        },
                                    success:function(data){
                                        //alert(data);
                                        $('#disfrute').html(data);
                                    },
                                    error: function(){
                                        alert('No se encontraron registros');
                                    }
                                });
                    });
                </script>
            </div>
            <button style="margin-left: 93vW;" class="w3-button w3-circle w3-red btn-delete" href='#'>+</button>
        </div>
    </article>

    <aside>
        <h2>Educacion</h2>
    </aside>
</div>

<!--- ventanas modales para editar los disfrutes y las vacaciones -->

    <!-- Modal Add Vacaciones-->
    <form action="vacaciones/save" method="post">
        <div class="modal fade" id="VacacionesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Vacaciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Periodo</label>
                            <input type="text" class="form-control" name="periodo" placeholder="2020">
                        </div>
                        
                        <div class="form-group">
                            <label>Dias Vacaciones</label>
                            <input type="text" class="form-control" name="dias" placeholder="20">
                        </div>

                        <div class="form-group">
                            <label>Dias Pendientes</label>
                            <input type="text" class="form-control" name="pendiente" placeholder="5">
                        </div>
                        <div class="form-group">
                            <label>Dias Disfrutados</label>
                            <input type="text" class="form-control" name="disfrutado" placeholder="15">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id='id' name="id" class="form-control id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Vacaciones-->


    <!-- Modal Add Disfrute-->
    <form action="disfrute/save" method="post">
        <div class="modal fade" id="DisfruteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Disfrute</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label>periodo</label>
                            <input type="text" class="form-control" name="vacaciones" placeholder="2020">
                        </div>
                        
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio">
                        </div>

                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin">
                        </div>
                        <div class="form-group">
                            <label>Dias</label>
                            <input type="text" class="form-control" name="dias" placeholder="15">
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="" name="tipo">
                                <option value="normal">Normal</option>
                                <option value="permiso">Permiso</option>
                                <option value="vacaciones atrasadas">Vacaciones Atrasadas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Razon</label>
                            <input type="text" class="form-control" name="razon" placeholder="razon de sus vacaciones">
                        </div>
                        <div class="form-group">
                            <label>Observacion</label>
                            <input type="text" class="form-control" name="observacion" placeholder="Observaciones">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id='id' name="id" class="form-control id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Product-->
<script>
    $(document).ready(function(){
 
        // get Vacaciones Modal
        $('.btn-edit').on('click',function(){
            // get data from button edit
            //alert('hola');
            const id = <?= esc($codigo) ?>;
            // Set data to Form Edit
            $('.id').val(id);
            //$('.nombre_escuela').val(name);
            //$('.distrito').val(distrito).trigger('change');
            // Call Modal Edit */
            $('#VacacionesModal').modal('show');
        });
 
        // get Disfrute Modal
        $('.btn-delete').on('click',function(){
            // get data from button edit
            //alert('adios');
            const id = <?= esc($codigo) ?>;
            $('.id').val(id);
            // Set data to Form Edit
            //$('.escuela_id').val(id);
            // Call Modal Edit
            $('#DisfruteModal').modal('show');
        });
         
    });
</script>
