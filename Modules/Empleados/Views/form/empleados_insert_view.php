<!-- Page Content -->
<div class="w3-container" style="margin-top: 20px; margin-left:15%;">
    <div class ="w3-card-4">
        <header class="w3-container w3-blue">
            <h3>Crear Nuevo Empleado</h3>
        </header>
        <body class="w3-container">
            <div class="container">
                <form action="save" method="POST" >
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Datos Personales</h5>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input class="form-control" type="text" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input class="form-control" type="text" name="apellido">
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cedula:</label>
                            <input class="form-control" type="text" name="cedula">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono:</label>
                            <input class="form-control" type="text" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="fecnacimiento">Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" name="fecnacimiento">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" name="sexo">
                                <option value='M'>Hombre</option>
                                <option value='F'>Mujer</option>
                            </select>
                        </div><br>
                    </div>
                    <div class="col-sm-6">
                        <h5> Datos Posicion Ocupada</h5>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <select name="cargo" class="form-control">
                                <?php foreach($cargo as $row):?>
                                    <option value="<?= $row['codigo'];?>"><?= $row['descripcion'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="funciones">Funcion</label>
                            <select name="funciones" class="form-control">
                                <option value="1">No Aplica</option>
                                <?php foreach($funcion as $row):?>
                                    <option value="<?= $row['id'];?>"><?= $row['descripcion'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="grupo">Grupo:</label>
                            <Select class="form-control" name="grupo">
                                <option value="1">Grupo I</option>
                                <option value="2">Grupo II</option>
                                <option value="3">Grupo III</option>
                            </Select>
                        </div>
                        <div class="form-group">
                            <label for="unidad">Cargo</label>
                            <select name="unidad" class="form-control">
                                <?php foreach($unidad as $row):?>
                                    <option value="<?= $row['codigo'];?>"><?= $row['descripcion'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecingreso">Fecha de Ingreso:</label>
                            <input class="form-control" type="date" name="fecingreso">
                        </div>
                        <div class="form-group">
                            <label for="supervisor">Supervisor</label>
                            <select name="supervisor" class="form-control">
                                <?php foreach($encargados as $row):?>
                                    <option value="<?= $row['codigo'];?>"><?= $row['nombre']. ' '. $row['apellido'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                            <p>Este Empleado Supervisa a otros:<br>
                                <input type="radio" name="encargado" value="S">Si<br>
                                <input type="radio" name="encargado" value="N" checked>No<br>
                            </p>
                    </div>
                </div>
                <button class="form-control btn btn-success" type="submit">Guardar</button><br>
                </form>
            </div>
        </body>
    </div>
</div>