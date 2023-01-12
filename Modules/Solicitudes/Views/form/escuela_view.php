
<!-- Page Content -->
<div style="margin-left:15%">

<div class="w3-container w3-teal">
  <h1>Listado de Centros Educativos Registrados</h1>
  
</div>


<div class="w3-container">

<div class="container">
    <br/>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Escuela</button>
 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Distrito</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($escuela as $row):?>
                <tr>
                    <td><?= $row->escuela_id;?></td>
                    <td><?= $row->codigo;?></td>
                    <td><?= $row->nombre_escuela;?></td>
                    <td><?= $row->distrito_id;?></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->escuela_id;?>" data-codigo="<?= $row->codigo;?>" 
                        data-name="<?= $row->nombre_escuela;?>" data-distrito_id="<?= $row->distrito;?>">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->escuela_id;?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
 
    </div>
     
    <!-- Modal Add Product-->
    <form action="centros/save" method="post">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Nueva Escuela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Codigo de Centro</label>
                    <input type="text" class="form-control" name="codigo" placeholder="Nombre Escuela">
                </div>
                <div class="form-group">
                    <label>Dependencia</label>
                    <input type="text" class="form-control" name="dependencia" placeholder="Nombre Escuela">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre_escuela" placeholder="Nombre Escuela">
                </div>
                
                 
                <div class="form-group">
                    <label>Distrito</label>
                    <select name="distrito" class="form-control">
                        <option value="">-Select-</option>
                        <?php foreach($distrito as $row):?>
                        <option value="<?= $row->id;?>"><?= $row->descripcion;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nivel</label>
                    <select name="nivel" class="form-control">
                        <option value="1">Primaria</option>
                        <option value="2">Primaria Secundaria</option>
                        <option value="3">Secundaria</option>
                        <option value="4">IP</option>
                        <option value="5">SP/Media</option>
                        <option value="6">S/Politecnico</option>
                        <option value="7">SP/Media</option>
                        <option value="8">S/Politecnico</option>
                        <option value="9">SB</option>
                        <option value="10">SP/B</option>
                        <option value="11">SP/Basica</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanda</label>
                    <select name="tanda" class="form-control">
                        <option value="J.E.E">J.E.E</option>
                        <option value="M/V">M/V</option>
                        <option value="M">M</option>
                        <option value="V">V</option>
                        <option value="N">N</option>
                        <option value="S">S</option>
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
    <form action="escuela/update" method="post">
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
                    <label>Escuela</label>
                    <input type="text" class="form-control nombre_escuela" name="nombre_escuela" placeholder="Nombre Escuela">
                </div>

                <div class="form-group">
                    <label>Codigo</label>
                    <input type="text" class="form-control codigo" name="codigo" placeholder="codigo de centro">
                </div>
                 
                <div class="form-group">
                    <label>Distrito</label>
                    <select name="distrito" class="form-control distrito">
                        <option value="">-Select-</option>
                        <?php foreach($distrito as $row):?>
                        <option value="<?= $row->id;?>"><?= $row->descripcion;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
             
            </div>
            <div class="modal-footer">
                <input type="hidden" name="escuela_id" class="escuela_id">
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
            const id = $(this).data('id');
            const name = $(this).data('name');
            const distrito = $(this).data('distrito_id');
            // Set data to Form Edit
            $('.escuela_id').val(id);
            $('.codigo').val(codigo);
            $('.nombre_escuela').val(name);
            $('.distrito').val(distrito).trigger('change');
            // Call Modal Edit
            $('#editModal').modal('show');
        });
 
        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('escuela_id');
            // Set data to Form Edit
            $('.escuela_id').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
         
    });
</script>
</div>

</div>
      



