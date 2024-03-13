<!-- Page Content -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<div class="w3-container">
    <div class="container">
        <h3 style="text-align: center; margin-bottom: 20px;">Solicitud de Pensiones</h3>
        <br/>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nueva Solicitud</button>
        <a href="<?php echo base_url('solicitud/pension_export'); ?>" class="btn btn-success">General Reporte para enviar</a>
        <div class="table-responsive sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Distrito</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pension as $row):
                    if($row->status=='Rechazada'){
                        $semaforo = 'text-danger';
                    } else if($row->status=='Devuelta'){
                        $semaforo = 'text-warning';
                    } else if($row->status=='Aprobada'){
                        $semaforo = 'text-success';
                    } else if($row->status=='Aceptada'){
                        $semaforo = 'text-primary';
                    } else{
                        $semaforo = 'text-light';
                    }?>
                    <tr>
                        <td><?= $row->distrito;?></td>
                        <td><?= $row->fecha_solicitud;?></td>
                        <td><?= $row->nombre;?></td>
                        <td><?= $row->apellido;?></td>
                        <td><?= $row->cedula;?></td>
                        <td><?= $row->telefono;?></td>
                        <td><i class='fa fa-circle <?php echo $semaforo; ?>'></i></td>
                        <td>
                            <button type="Button" onClick="funcionobs(<?= $row->idpension;?>)" class="btn btn-sm btn-info" data-target="#obsModal">Observacion</button>
                            <a href="#" class="btn btn-edit btn-info btn-sm" data-id="<?= $row->idpension;?>" data-fecha="<?= $row->fecha_solicitud; ?>" 
                            data-nombre="<?= $row->nombre; ?>" data-apellido="<?= $row->apellido; ?>" data-cedula="<?= $row->cedula; ?>" 
                            data-inicio= "<?= $row->anio_inicio; ?>" data-telefono="<?= $row->telefono; ?>" data-celular="<?= $row->celular; ?>"
                            data-centro="<?= $row->centro_educativo;?>" data-puesto="<?= $row->puesto;?>" data-area="<?= $row->area;?>">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->idpension;?>">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- Modal Nueva Solicitud -->
        <form action="pension/save" method="post">
            <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Solicitud de Pensi&oacute;n</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                                <div class="col-sm">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre1" class="form-control" placeholder="Jose" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido1" class="form-control" placeholder="Almonte" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Cedula:</label>
                                    <input type="text" name="cedula" class="form-control" placeholder="037-0058475-5" required /></td>
                                </div>
                                <div class="col-sm">
                                    <label>Fecha Ingreso:</label>
                                    <input type="text" name="anio_inicio" class="form-control" placeholder="2005" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Telefono:</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="809-586-5428" required /></td>
                                </div>
                                <div class="col-sm">
                                    <label>Celular:</label>
                                    <input type="text" name="celular" class="form-control" placeholder="849-847-2548" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Centro Educativo:</label>
                                    <select class="search form-control" name="search"></select>
                                </div>
                                <div class="col-sm">
                                    <label>Puesto Desempeñado:</label>
                                    <input type="text" name="puesto" class="form-control puesto" placeholder="Auxiliar Policia Escolar" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                <label>Area:</label>
                                    <select name="area" class="form-control area">
                                        <option value="">-Select-</option>
                                        <?php foreach($area as $row):?>
                                            <option value="<?= $row->id;?>"><?= $row->descripcion;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div>
                                    <label>Tipo Pension:</label>
                                        <select name="tipo" class="form-control tipo">
                                            <option value="">-Select-</option>
                                            <?php foreach($tipo as $row):?>
                                                <option value="<?= $row->id;?>"><?= $row->tipo;?></option>
                                            <?php endforeach;?>
                                        </select>
                                </div>
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
        <!-- Fin Modal Nueva Solicitud -->
        <!-- Modal Editar Solicitud-->
        <form action="pension/update" method="post">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                                <div class="col-sm">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" class="form-control nombre" placeholder="Jose" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido" class="form-control apellido" placeholder="Almonte" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Cedula:</label>
                                    <input type="text" name="cedula" class="form-control cedula" placeholder="037-0058475-5" required /></td>
                                </div>
                                <div class="col-sm">
                                    <label>Fecha Ingreso:</label>
                                    <input type="text" name="anio_inicio" class="form-control anio_inicio" placeholder="2005" required /></td>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label>Telefono:</label>
                                    <input type="text" name="telefono" class="form-control telefono" placeholder="809-586-5428" required /></td>
                                </div>
                                <div class="col-sm">
                                    <label>Celular:</label>
                                    <input type="text" name="celular" class="form-control celular" placeholder="849-847-2548" required /></td>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm">
                                    <label>Centro Educativo:</label>
                                    <select name="centro" class="form-control centro">
                                        <option value="">-Select-</option>
                                        <?php foreach($centro as $row):?>
                                            <option value="<?= $row->escuela_id;?>">(<?= $row->codigo_id;?>) <?= $row->nombre_escuela;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label>Puesto Desempeñado:</label>
                                    <input type="text" name="puesto" class="form-control puesto" required /></td>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm">
                                    <label>Area:</label>
                                    <select name="area" class="form-control area">
                                        <option value="">-Select-</option>
                                        <?php foreach($area as $row):?>
                                            <option value="<?= $row->id;?>"><?= $row->descripcion;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idpension" class="idpension idpension">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- Fin Modal Editar Solicitud-->
        <!-- Modal Observaciones-->
        <div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                    <div id="observaciones">
                        <script>
                            function funcionobs (valor) {
                                var type = 'Pension';
                                //alert('esto es una funcion')
                                $.ajax({
                                    url: "<?php echo base_url('solicitud/buscar'); ?>",
                                    type: "post",
                                    data: {id: valor, type: type},
                                    dataType: 'json',
                                    beforeSend: function (f) {
                                        $('#observaciones').html('Cargar Tabla...');
                                    },
                                    success:function(data){
                                        //alert(data);
                                        $('#obsModal').modal('show');
                                        $('#observaciones').html(data);
                                    },
                                    error: function(){
                                        alert('No se encontraron registros');
                                    }
                                });
                            };
                        </script>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Fin Modal Observaciones-->
    
        <!-- Modal Delete -->
        
        <form action="solicitud/pension/delete" method="post">
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrar Solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4>Esta seguro de eliminar esta solicitud</h4>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idpension" class="idpension">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- Fin Modal Borrar Solicitud-->
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
    
            // get Edit Product
            $('.btn-edit').on('click',function(){
                // get data from button edit
                const id = $(this).data('id');
                const nombre = $(this).data('nombre');
                const apellido = $(this).data('apellido');
                const cedula = $(this).data('cedula');
                const inicio = $(this).data('inicio');
                const telefono = $(this).data('telefono');
                const celular = $(this).data('celular');
                const centro = $(this).data('centro');
                const puesto = $(this).data('puesto');
                const area = $(this).data('area');
                
                // Set data to Form Edit
                $('.idpension').val(id);
                $('.nombre').val(nombre);
                $('.apellido').val(apellido);
                $('.cedula').val(cedula);
                $('.anio_inicio').val(inicio);
                $('.telefono').val(telefono);
                $('.celular').val(celular);
                $('.centro').val(centro);
                $('.puesto').val(puesto);
                $('.area').val(area);
                // Call Modal Edit
                $('#editModal').modal('show');
            });
    
            // get Delete Product
            $('.btn-delete').on('click',function(){
                // get data from button edit
                const id = $(this).data('id');
                // Set data to Form Edit
                $('.idpension').val(id);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });
            $('.search').select2({
                placeholder: '--- Ingrese el centro Educativo ---',
                tabindex: null,
                ajax:{
                    url: '<?php echo base_url('solicitud/centro_ajaxsearch');?>',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data){
                        return {
                        results: data
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
</div>