<!-- Page Content -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<div class="w3-container">
  <div class="container">
    <h3 style="text-align: center; margin-bottom: 20px;">Licencias y Permisos</h3>
      <br/>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nueva Solicitud</button>
      <a href="<?php echo base_url('solicitud/licencia_export'); ?>" class="btn btn-success">General Reportes Lic. Comunes</a>
        <a href="<?php echo base_url('solicitud/licencia_export_maternidad'); ?>" class="btn btn-success">General Reporte Licencias Maternidad</a>
        <a href="<?php echo base_url('solicitud/licencia/historico'); ?>" class="btn btn-info">Buscar Historico empleado</a>
      <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Distrito</th>
                      <th>Fecha</th>
                      <th>Nombre</th>
                      <th>Cedula</th>
                      <th>Tipo de Licencia</th>
                      <th>Dias</th>
                      <th>Fecha Inicio Licencia</th>
                      <th>Status</th>
                      <th>Estado</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($licencia as $row):
                 if($row['status']=='Rechazada'){
                    $semaforo = 'text-danger';
                } else if($row['status']=='Devuelta'){
                    $semaforo = 'text-warning';
                } else if($row['status']=='Aprobada'){
                    $semaforo = 'text-success';
                } else if($row['status']=='Aceptada'){
                    $semaforo = 'text-primary';
                } else{
                    $semaforo = 'text-light';
                }?>
                  <tr>
                      <td><?= $row['distrito'];?></td>
                      <td><?= $row['fecha'];?></td>
                      <td><?= $row['nombres'];?></td>
                      <td><?= $row['cedula'];?></td>
                      <td><?= $row['tipo_licencia'];?></td>
                      <td><?= $row['dias'];?></td>
                      <td><?= $row['fechaini'];?></td>
                      <td><?= $row['status'];?></td>
                      <td><i class='fa fa-circle <?php echo $semaforo; ?>'></i></td>
                      <td>
                      <button type="Button" onClick="funcionobs(<?= $row['id'];?>)" class="btn btn-sm btn-info" data-target="#obsModal">Observacion</button>
                          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row['id'];?>" data-name="<?= $row['nombres'];?>"
                          data-cedula="<?= $row['cedula'];?>" data-tipolicencia="<?= $row['tipo_licencia'];?>" data-dias="<?= $row['dias'];?>"
                          data-fechaini="<?= $row['fechaini'];?>" data-fechafin="<?= $row['fechafin'];?>" data-cargo="<?= $row['cargo']; ?>"
                          data-centro="<?= $row['centro_educativo'];?>" data-suplente="<?= $row['nombre_suplente'];?>" data-cedsuplente="<?= $row['cedula_suplente'];?>">Editar</a>
                          <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'];?>">Borrar</a>
                      </td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
      </div>
  
      </div>
      
      <!-- Modal Nueva Solicitud -->
      <form action="licencia/save" method="post">
          <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nueva Solicitud de Permiso o Licencia</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <div class="row">
                              <div class="col-sm">
                                  <label>Nombres:</label>
                                  <input type="text" name="nombres" class="form-control" placeholder="Jose Luis Almonte Martinez" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control" placeholder="001-0085294-6" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Dias:</label>
                                  <input type="text" name="dias" class="form-control" placeholder="30 Dias" required /></td>
                              </div>
                              <div class="col-sm">
                              <label>Tipo de Licencia o Permiso:</label>
                                  <select name="tipo" class="form-control tipo">
                                  <option value="">-Select-</option>
                                        <?php foreach($tipo as $row):?>
                                            <option value="<?= $row['idtipo'];?>"><?= $row['descripcion'];?></option>
                                        <?php endforeach;?>
                                    </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Fecha Inicio:</label>
                                  <input type="date" name="fechaini" class="form-control"  required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Final:</label>
                                  <input type="date" name="fechafin" class="form-control" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                              <label>Centro Educativo</label>
                              <select class="search form-control" name="search"></select>
                              </div>
                              <div class="col-sm">
                                  <label>Cargo:</label>
                                  <input type="text" name="cargo" class="form-control" placeholder="Auxiliar Administrativo" required/></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Suplente</label>
                                <input type="text" name="nombre_suplente" class="form-control" placeholder="Jairo Salas"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Suplente:</label>
                                  <input type="text" name="cedula_suplente" class="form-control" placeholder="407-0065874-3"/></td>
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
      <form action="licencia/update" method="post">
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
                                  <input type="text" name="nombres" class="form-control nombres" required/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control cedula" required/></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Dias:</label>
                                  <input type="text" name="dias" class="form-control dias" required/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Tipo de Licencia o Permiso:</label>
                                  <select name="tipo" class="form-control tipo">
                                  <option>-Select-</option>
                                        <?php foreach($tipo as $row):?>
                                            <option value="<?= $row['idtipo'];?>"><?= $row['descripcion'];?></option>
                                        <?php endforeach;?>
                                    </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Fecha Inicio:</label>
                                  <input type="date" name="fechaini" class="form-control fechaini" required/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Final:</label>
                                  <input type="date" name="fechafin" class="form-control fechafin" required/></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                              <label>Centro Educativo</label>
                              <select name="centro" class="form-control centro">
                                        <option value="">-Select-</option>
                                        <?php foreach($centro as $row):?>
                                            <option value="<?= $row->escuela_id;?>">(<?= $row->codigo_id;?>) <?= $row->nombre_escuela;?></option>
                                        <?php endforeach;?>
                                </select>
                              </div>
                              <div class="col-sm">
                                  <label>Cargo:</label>
                                  <input type="text" name="cargo" class="form-control cargo" required/></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Suplente</label>
                                <input type="text" name="nombre_suplente" class="form-control nombre_suplente"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Suplente:</label>
                                  <input type="text" name="cedula_suplente" class="form-control cedula_suplente"/></td>
                              </div>
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
                                var type = 'Licencia';
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
      
      <form action="Licencia/delete" method="post">
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
  
  <!-- <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script> -->
  <script>
      $(document).ready(function(){
  
          // get Edit Product
          $('.btn-edit').on('click',function(){
              // get data from button edit
              const id = $(this).data('id');
              const name = $(this).data('name');
              const dias = $(this).data('dias');
              const cedula = $(this).data('cedula');
              const tipolicencia = $(this).data('tipolicencia');
              const fechaini = $(this).data('fechaini');
              const fechafin = $(this).data('fechafin');
              const centro = $(this).data('centro');
              const cargo = $(this).data('cargo');
              const suplente = $(this).data('suplente');
              const cedsuplente = $(this).data('cedsuplente');
              
              // Set data to Form Edit
              $('.id').val(id);
              $('.nombres').val(name);
              $('.dias').val(dias);
              $('.cedula').val(cedula);
              $('.tipo').val(tipolicencia);
              $('.fechaini').val(fechaini);
              $('.fechafin').val(fechafin);
              $('.centro').val(centro);
              $('.cargo').val(cargo);
              $('.nombre_suplente').val(suplente);
              $('.cedula_suplente').val(cedsuplente);
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
      
