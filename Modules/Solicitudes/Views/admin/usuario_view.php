
<!-- Page Content -->
<div style="margin-left:20%">

<div class="w3-container w3-teal">
  <h1>Listado de Usuarios registrados</h1>
  
</div>


<div class="w3-container">

<div class="container">
    <br/>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Nuevo Usuario</button>
 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Distrito</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($usuarios as $row):?>
                <tr>
                    <td><?= $row->id;?></td>
                    <td><?= $row->username;?></td>
                    <td><?= $row->name;?></td>
                    <td><?= $row->type;?></td>
                    <td><?= $row->distrito_id;?></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->id;?>" data-username="<?= $row->username;?>"data-name="<?= $row->name;?>" 
                        data-type="<?= $row->type;?>" data-distrito_id="<?= $row->distrito_id;?>" data-empleado="<?= $row->empleado;?>">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id;?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
 
    </div>
     
    <!-- Modal Add Product-->
    <form action="usuario/save" method="post">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control" name="username" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" class="form-control" name="password" placeholder="Clave">
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="type" class="form-control">
                        <option value="U">Usuario</option>
                        <option value="A">Administrador</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Distrito</label>
                    <select name="distrito_id" class="form-control">
                        <option value="">-Select-</option>
                        <?php foreach($distritos as $row):?>
                        <option value="<?= $row->distrito_id;?>"><?= $row->descripcion;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="empleado" class="form-control">
                        <option value="">-Select-</option>
                        <?php foreach($empleados as $row):?>
                        <option value="<?= $row->codigo;?>"><?= $row->nombre. ' '.$row->apellido;?></option>
                        <?php endforeach;?>
                    </select>
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
    <!-- End Modal Add Product-->
 
    <!-- Modal Edit Product-->
    <form action="usuario/update" method="post">
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
             
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control username" name="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control name" name="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" class="form-control" name="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="type" class="form-control type">
                        <option value="U">Usuario</option>
                        <option value="A">Administrador</option>
                        <option value="T">Tecnico</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Distrito</label>
                    <select name="distrito_id" class="form-control distrito">
                        <option value="">-Select-</option>
                        <?php foreach($distritos as $row):?>
                        <option value="<?= $row->distrito_id;?>"><?= $row->descripcion;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="empleado" class="form-control empleado">
                        <option value="">-Select-</option>
                        <?php foreach($empleados as $row):?>
                        <option value="<?= $row->codigo;?>"><?= $row->nombre. ' '.$row->apellido;?></option>
                        <?php endforeach;?>
                    </select>
                </div> 
             
            </div>
            <div class="modal-footer">
                <input type="hidden" name="usuario_id" class="usuario_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Edit Product-->
 
    <!-- Modal Delete Product-->
    <!--
    <form action="escuela/delete" method="post">
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
               <h4>Are you sure want to delete this product?</h4>
             
            </div>
            <div class="modal-footer">
                <input type="hidden" name="product_id" class="productID">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </div>
        </div>
        </div>
    </form> -->
    <!-- End Modal Delete Product-->
 
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const username = $(this).data('username');
            const name = $(this).data('name');
            const type = $(this).data('type');
            const distrito = $(this).data('distrito_id');
            const empleado = $(this).data('empleado');
            // Set data to Form Edit
            $('.usuario_id').val(id);
            $('.username').val(username)
            $('.name').val(name);
            $('.type').val(type).trigger('change');
            $('.distrito').val(distrito).trigger('change');
            $('.empleado').val(empleado).trigger('change');
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
         
    });
</script>
</div>

</div>
      



