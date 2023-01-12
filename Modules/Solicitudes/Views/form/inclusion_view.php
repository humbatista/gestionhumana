<!-- Page Content -->

<div class="w3-container">
  <div class="container">
  <h3 style="text-align: center; margin-bottom: 20px;">Inclusion Dependientes</h3>
      <br/>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nueva Solicitud</button>
      <a href="<?php echo base_url('solicitud/inclusion_export'); ?>" class="btn btn-success">General Reporte para enviar</a>
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
                      <th>Status</th>
                      <th>Estado</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($inclusion as $row):
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
                      <td><?= $row->fecha;?></td>
                      <td><?= $row->nombre;?></td>
                      <td><?= $row->apellido;?></td>
                      <td><?= $row->cedula;?></td>
                      <td><?= $row->telefono;?></td>
                      <td><?= $row->status;?></td>
                      <td><i class='fa fa-circle <?php echo $semaforo; ?>'></i></td>
                      <td>
                      <button type="Button" onClick="funcionobs(<?= $row->idinclusion;?>)" class="btn btn-sm btn-info" data-target="#obsModal">Observacion</button>
                          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->idinclusion;?>" data-name="<?= $row->nombre;?>"
                          data-apellido="<?= $row->apellido;?>" data-cedula="<?= $row->cedula;?>" data-telefono="<?= $row->telefono;?>"
                          data-ndependiente="<?= $row->nombre_dependiente;?>" data-cdependiente="<?= $row->cedula_dependiente;?>"
                          data-relacion="<?= $row->relacion;?>" data-nacimiento="<?= $row->nacimiento;?>" data-ndependiente1="<?= $row->nombre_dependiente1;?>" 
                          data-cdependiente1="<?= $row->cedula_dependiente1;?>" data-relacion1="<?= $row->relacion1;?>" data-nacimiento1="<?= $row->nacimiento1;?>">Editar</a>
                          <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->idinclusion;?>">Borrar</a>
                      </td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
      </div>
  
      </div>
      
      <!-- Modal Nueva Solicitud -->
      <form action="inclusion/save" method="post">
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nueva Solicitud de Inclusi&oacute;n</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <div class="row">
                              <div class="col-sm">
                                  <label>Nombres:</label>
                                  <input type="text" name="nombre" class="form-control" placeholder="Jose Luis" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Apellidos:</label>
                                  <input type="text" name="apellido" class="form-control" placeholder="Almonte Martinez" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control" placeholder="037-0058475-5" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Telefono:</label>
                                  <input type="text" name="telefono" class="form-control" placeholder="809-586-9874" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Beneficiario:</label>
                                  <input type="text" name="nombre_dependiente" class="form-control" placeholder="Angela Maria Almonte Polanco" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Beneficiario:</label>
                                  <input type="text" name="cedula_dependiente" class="form-control" placeholder="407-0065841-2" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>relaci&oacute;n:</label>
                                  <input type="text" name="relacion" class="form-control" placeholder="Hija" required /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Nacimiento dependiente:</label>
                                  <input type="date" name="nacimiento" class="form-control" placeholder="27/06/2010" required /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Beneficiario:</label>
                                  <input type="text" name="nombre_dependiente1" class="form-control" placeholder="Angela Maria Almonte Polanco"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Beneficiario:</label>
                                  <input type="text" name="cedula_dependiente1" class="form-control" placeholder="407-0065841-2"  /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>relaci&oacute;n:</label>
                                  <input type="text" name="relacion1" class="form-control" placeholder="Hija"  /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Nacimiento dependiente:</label>
                                  <input type="date" name="nacimiento1" class="form-control" placeholder="27/06/2010" /></td>
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
      <form action="inclusion/update" method="post">
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
                                  <input type="text" name="nombre" class="form-control nombre"/></td>
                              </div>
                              <div class="col-sm">
                                  <label>Apellido:</label>
                                  <input type="text" name="apellido" class="form-control apellido" /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Cedula:</label>
                                  <input type="text" name="cedula" class="form-control cedula" /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Telefono:</label>
                                  <input type="text" name="telefono" class="form-control telefono" /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Dependiente:</label>
                                  <input type="text" name="nombre_dependiente" class="form-control nombre_dependiente" /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Dependiente:</label>
                                  <input type="text" name="cedula_dependiente" class="form-control cedula_dependiente" /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Relaci&oacute;n:</label>
                                  <input type="text" name="relacion" class="form-control relacion" /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Nacimiento Dependiente:</label>
                                  <input type="date" name="nacimiento" class="form-control nacimiento" /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Nombre Dependiente:</label>
                                  <input type="text" name="nombre_dependiente1" class="form-control nombre_dependiente1" /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Cedula Dependiente:</label>
                                  <input type="text" name="cedula_dependiente1" class="form-control cedula_dependiente1" /></td>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm">
                                  <label>Relaci&oacute;n:</label>
                                  <input type="text" name="relacion1" class="form-control relacion1" /></td>
                              </div>
                              <div class="col-sm">
                                  <label>Fecha Nacimiento Dependiente:</label>
                                  <input type="date" name="nacimiento1" class="form-control nacimiento1" /></td>
                              </div>
                          </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="idinclusion" class="idinclusion">
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
                                var type = 'Inclusion';
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
      
      <form action="inclusion/delete" method="post">
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
                  <input type="hidden" name="idinclusion" class="idinclusion">
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
              const apellido = $(this).data('apellido');
              const cedula = $(this).data('cedula');
              const telefono = $(this).data('telefono');
              const ndependiente = $(this).data('ndependiente');
              const cdependiente = $(this).data('cdependiente');
              const relacion = $(this).data('relacion');
              const nacimiento = $(this).data('nacimiento');
              const ndependiente1 = $(this).data('ndependiente1');
              const cdependiente1 = $(this).data('cdependiente1');
              const relacion1 = $(this).data('relacion1');
              const nacimiento1 = $(this).data('nacimiento1');
              
              // Set data to Form Edit
              $('.idinclusion').val(id);
              $('.nombre').val(name);
              $('.apellido').val(apellido);
              $('.cedula').val(cedula);
              $('.telefono').val(telefono);
              $('.nombre_dependiente').val(ndependiente);
              $('.cedula_dependiente').val(cdependiente);
              $('.relacion').val(relacion);
              $('.nacimiento').val(nacimiento);
              $('.nombre_dependiente1').val(ndependiente1);
              $('.cedula_dependiente1').val(cdependiente1);
              $('.relacion1').val(relacion1);
              $('.nacimiento1').val(nacimiento1);
              // Call Modal Edit
              $('#editModal').modal('show');
          });
  
          // get Delete Product
          $('.btn-delete').on('click',function(){
              // get data from button edit
              const id = $(this).data('id');
              // Set data to Form Edit
              $('.idinclusion').val(id);
              // Call Modal Edit
              $('#deleteModal').modal('show');
          });
          
      });
  </script>
</div>
      
