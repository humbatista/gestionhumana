<!-- Page Content -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


<div class="w3-container">
  <div class="container">
  <h3 style="text-align: center; margin-bottom: 20px;">Vacaciones</h3>
      <br/>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nuevo Registro</button>
      <a href="<?php echo base_url('solicitud/exclusion_export'); ?>" class="btn btn-success">General Reporte para enviar</a>
      <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Empleado</th>
                      <th>Cedula</th>
                      <th>Periodo</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Dias</th>
                      <th>Activa</th>
                      <th>Estado</th>
                      <th>Tipo</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($vacaciones as $row):
                 if($row->status=='Enviada'){
                    $semaforo = 'text-primary';
                } else if($row->status=='Devuelta'){
                    $semaforo = 'text-warning';
                } else if($row->status=='Aprobada'){
                    $semaforo = 'text-success';
                } else{
                    $semaforo = 'text-light';
                }?>
                  <tr>
                      <td><?= $row->empleado;?></td>
                      <td><?= $row->cedula;?></td>
                      <td><?= $row->distrito;?></td>
                      <td><?= $row->periodo;?></td>
                      <td><?= $row->fecha_inicio;?></td>
                      <td><?= $row->fecha_fin;?></td>
                      <td><?= $row->activa;?></td>
                      <td><?= $row->status;?></td>
                      <td><i class='fa fa-circle <?php echo $semaforo; ?>'></i></td>
                      <td>
                      <button type="Button" onClick="funcionobs(<?= $row->id;?>)" class="btn btn-sm btn-info" data-target="#obsModal">Observacion</button>
                          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->id;?>" data-empleado="<?= $row->empleado;?>"
                          data-cedula="<?= $row->cedula;?>" data-distrito="<?= $row->distrito;?>" data-periodo="<?= $row->periodo;?>"
                          data-fecha_inicio="<?= $row->fecha_inicio;?>" data-fecha_fin="<?= $row->fecha_fin;?>"
                          data-dias="<?= $row->dias;?>" data-estado="<?= $row->estado;?>" >Editar</a>
                          <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id;?>">Borrar</a>
                      </td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
      </div>
  
      </div>
      
      <!-- Modal Nueva Solicitud -->
      <form action="vacaciones/save" method="post">
          <div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ingresar Vacaciones</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <div class="row">
                              <div class="col-sm">
                                  <label>Empleado:</label>
                                  <input type="text" name="empleado" class="form-control" placeholder="Jose Luis Almonte Martinez" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control" placeholder="037-0066654-2" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Periodo:</label>
                                  <input type="text" name="periodo" class="form-control" placeholder="2022" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Fecha Inicio:</label>
                                  <input type="date" name="fecha_inicio" class="form-control" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Fin:</label>
                                  <input type="date" name="fecha_fin" class="form-control"  required /></td>
                              </div>
                          </div>
                          <div class="col-sm">
                              <label>Centro Educativo</label>
                              <select class="search form-control" name="search"></select>
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
      <form action="vacaciones/update" method="post">
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
                                  <label>Empleado:</label>
                                  <input type="text" name="empleado" class="form-control empleado" placeholder="Jose Luis Almonte Martinez" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control cedula" placeholder="037-0066654-2" required /></td>
                              </div>
                          </div>
                          <div class="row">

                              <div class="col-sm-6">
                                  <label>Periodo:</label>
                                  <input type="text" name="periodo" class="form-control periodo" placeholder="2022" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Fecha Inicio:</label>
                                  <input type="date" name="fecha_inicio" class="form-control fecha_inicio" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Fin:</label>
                                  <input type="date" name="fecha_fin" class="form-control fecha_fin"  required /></td>
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
                                var type = 'Exclusion';
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
      
      <form action="vacaciones/delete" method="post">
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
      
