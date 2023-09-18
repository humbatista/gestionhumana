<!-- Page Content -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<div class="w3-container">
  <div class="container">
    <h3 style="text-align: center; margin-bottom: 20px;">Accion de Personal</h3>
      <br/>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nueva Solicitud</button>
      <a href="<?php echo base_url('solicitud/accion_personal_export'); ?>" class="btn btn-success">General Reporte para enviar</a>
      <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Distrito</th>
                      <th>Fecha</th>
                      <th>Nombre</th>
                      <th>Cedula</th>
                      <th>Tipo de Accion</th>
                      <th>Cargo Propuesto</th>
                      <th>Observacion</th>
                      <th>Status</th>
                      <th>Estado</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($accion as $row):
                if($row['status']=='Rechazada'){
                    $semaforo = 'text-danger';
                } else if($row['status']=='Devuelta'){
                    $semaforo = 'text-warning';
                } else if($row['status']=='Aprobada'){
                    $semaforo = 'text-success';
                } else if($row['status']=='Aceptada'){
                    $semaforo = 'text-info';
                } else if($row['status']=='Enviado'){
                    $semaforo = 'text-primary';
                } else{
                    $semaforo = 'text-light';
                }?>
                  <tr>
                      <td><?= $row['distrito'];?></td>
                      <td><?= $row['fecha'];?></td>
                      <td><?= $row['nombre_recomendado'];?></td>
                      <td><?= $row['cedula_recomendado'];?></td>
                      <td><?= $row['tipo_accion'];?></td>
                      <td><?= $row['cargo_propuesto'];?></td>
                      <td><?= $row['observacion'];?></td>
                      <td><?= $row['status'];?></td>
                      <td><i class='fa fa-circle <?php echo $semaforo; ?>'></i></td>
                      <td>
                      <button type="Button" onClick="funcionobs(<?= $row['id'];?>)" class="btn btn-sm btn-info" data-target="#obsModal">Observacion</button>
                          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row['id'];?>" data-name="<?= $row['nombre_recomendado'];?>"
                          data-cedula="<?= $row['cedula_recomendado'];?>" data-tipo="<?= $row['tipo_accion'];?>" data-cargop="<?= $row['cargo_propuesto'];?>"
                          data-centro="<?= $row['centro_educativo'];?>"data-cargoa="<?= $row['cargo_actual'];?>" data-names="<?= $row['nombre_sustituido'];?>" 
                          data-cedulas="<?= $row['cedula_sustituido'];?>"data-observaciones="<?= $row['observacion'];?>">Editar</a>
                          <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'];?>">Borrar</a>
                      </td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
      </div>
  
      </div>
      
      <!-- Modal Nueva Solicitud -->
      <form action="accionpersonal/save" method="post">
          <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Accion de Personal</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <div class="row">
                              <div class="col-sm">
                                  <label>Nombres:</label>
                                  <input type="text" name="nombre" class="form-control" placeholder="Jose Luis Almonte Martinez" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control" placeholder="001-0085294-6" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Tipo:</label>
                                  <select name="tipo" class="form-control tipo">
                                      <option value="Sustitucion">Sustitucion</option>
                                      <option value="Nombramiento">Nombramiento</option>
                                      <option value="Traslado">Traslado</option>
                                      <option value="Cambio designación">Cambio Designaci&oacute;</option>
                                  </select>
                              </div>
                              <div class="col-sm">
                              <label>Centro Educativo</label>
                              <select class="search form-control" name="search"></select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Cargo Actual:</label>
                                  <input type="text" name="cargo_actual" class="form-control"  required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cargo Propuesto:</label>
                                  <input type="text" name="cargo_propuesto" class="form-control" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Sustituido</label>
                                <input type="text" name="nombre_sustituido" class="form-control" placeholder="Jairo Salas"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Suplente:</label>
                                  <input type="text" name="cedula_sustituido" class="form-control" placeholder="407-0065874-3"/></td>
                              </div>
                          </div>
                          <div class="row">
                              <label>Observaciones</label>
                              <textarea name="observaciones" class="form-control"></textarea></td>
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
      <form action="accionpersonal/update" method="post">
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
                                  <label>Nombres:</label>
                                  <input type="text" name="nombre" class="form-control nombre" placeholder="Jose Luis Almonte Martinez" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control cedula" placeholder="001-0085294-6" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Tipo:</label>
                                  <select name="tipo" class="form-control tipo">
                                      <option value="Sustitucion">Sustitucion</option>
                                      <option value="Nombramiento">Nombramiento</option>
                                      <option value="Traslado">Traslado</option>
                                  </select>
                              </div>
                              <div class="col-sm">
                              <label>Centro Educativo</label>
                              <select name="centro" class="form-control centro">
                                        <option value="">-Select-</option>
                                        <?php foreach($centro as $row):?>
                                            <option value="<?= $row->escuela_id;?>">(<?= $row->codigo_id;?>) <?= $row->nombre_escuela;?></option>
                                        <?php endforeach;?>
                                    </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Cargo Actual:</label>
                                  <input type="text" name="cargo_actual" class="form-control  cargo_actual"  required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cargo Propuesto:</label>
                                  <input type="text" name="cargo_propuesto" class="form-control cargo_propuesto" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Sustituido</label>
                                <input type="text" name="nombre_sustituido" class="form-control nombre_sustituido" placeholder="Jairo Salas"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Suplente:</label>
                                  <input type="text" name="cedula_sustituido" class="form-control cedula_sustituido" placeholder="407-0065874-3"/></td>
                              </div>
                          </div>
                          <div class="row">
                              <label>Observaciones</label>
                              <textarea name="observaciones" class="form-control observaciones"></textarea></td>
                          </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="id" class="id">
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
                                var type = 'AccionPers';
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
                
      <!-- Modal Delete Solicitud-->
      
      <form action="accionpersonal/delete" method="post">
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
                  <input type="hidden" name="id" class="id">
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
              const name = $(this).data('name');
              const cedula = $(this).data('cedula');
              const tipo = $(this).data('tipo');
              const observaciones = $(this).data('observaciones');
              const centro = $(this).data('centro');
              const cargo_actual = $(this).data('cargoa');
              const cargo_propuesto = $(this).data('cargop');
              const sustituido = $(this).data('names');
              const cedulasust = $(this).data('cedulas');
              
              // Set data to Form Edit
              $('.id').val(id);
              $('.nombres').val(name);
              $('.cedula').val(cedula);
              $('.tipo').val(tipo);
              $('.observaciones').val(observaciones);
              $('.centro').val(centro);
              $('.cargo_actual').val(cargo_actual);
              $('.cargo_propuesto').val(cargo_propuesto);
              $('.nombre_sustituido').val(sustituido);
              $('.cedula_sustituido').val(cedulasust);
              // Call Modal Edit
              $('#editModal').modal('show');
          });
  
          // get Delete Product
          $('.btn-delete').on('click',function(){
              // get data from button edit
              const id = $(this).data('id');
              // Set data to Form Edit
              $('.id').val(id);
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