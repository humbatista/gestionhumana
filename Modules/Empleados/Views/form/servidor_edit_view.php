<body>
    <div class="w3-container w3-indigo">
        <header>
            <h1>Editar Servidor</h1>
        </header>
    </div>
    <div style="margin-left:10%">
        <section class="w3-container"><br>
            <div class="w3-card-4" style="width:60%">
                <header class="w3-container w3-blue">
                    <h1>Editar Servidor</h1>
                </header>
                <form class="form"  action="servidor/update" method="POST" style="margin-left:5%; margin-right:5%">
                <form class="form">
                    <h2>Datos Personales del Servidor Publico</h2>
                    <div class="w3-bar w3-black">
                        <a href="<?php echo base_url() ?>/empleados/servidor?codigo=<?= esc($codigo) ?>" class="w3-bar-item w3-button">REGRESAR</a>
                        <a href="<?= base_url('empleados/')?>" class="w3-bar-item w3-button">IR A EMPLEADOS</a>
                    </div>
                    <div class='row'>
                        <div class="col-sm-6">
                            <label for="nombre">Nombre:</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" value= <?= esc($nombre) ?>><br>
                            <label for="apellido">Apellido:</label>
                            <input class="form-control" type="text" id="apellido" name="apellido" value= <?= esc($apellido) ?> ><br>
                            <label for="cedula">Cedula:</label>
                            <input class="form-control" type="text" id="cedula" name="cedula" value= <?= esc($cedula) ?>><br>
                            <label for="telefono">Telefono:</label>
                            <input class="form-control" type="text" id="telefono" name="telefono" value= <?= esc($telefono) ?>><br>
                            <label for="sexo">Sexo:</label>
                            <!-- <Select class="form-control sexo" name="sexo" id="sexo">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                            </Select> -->
                            <input type="text" name="sexo" id="sexo" value = <?= $sexo ?>>
                            <label for="fecnacimiento">Fecha Nacimiento:</label>
                            <input type="date" id="fecnaciemiento" class="form-control" name="fecnacimiento" value=<?= esc($fecnacimiento) ?>><br>
                        </div>
                        <div class="col-sm-6">
                            <label for="cargo">Cargo:</label>
                            <select name="cargo" class="form-control cargo" id="cargo" value="33">
                                <option value= <?= esc($cargo)?> selected>Selecciona Cargos</option>
                            </select>
                            <label for="funciones">Funcion:</label>
                            <select name="funciones" class="form-control funciones" id="funciones">
                                <option value= <?= esc($funciones)?> selected>Selecciona Cargos</option>
                            </select>
                            <label for="grupo">Grupo:</label>
                            <Select class="form-control grupo" name="grupo"  value="2">
                                    <option value="1">Grupo I</option>
                                    <option value="2">Grupo II</option>
                                    <option value="3">Grupo III</option>
                            </Select>
                            <label for="unidad">Unidad:</label>
                            <select name="unidad" class="form-control unidad" id="unidad" value=<?= esc($unidad) ?>>
                                <option value= <?= esc($unidad) ?>>Selecciona Unidad</option>
                            </select>
                            <label for="supervisor">Supervisado por:</label>
                            <select name="supervisor" class="form-control supervisor" id="supervisor" value=<?= esc($supervisor) ?>>
                                <option value= <?= esc($supervisor) ?>>Selecciona Supervisor</option>
                            </select>
                            <label for="sueldo">Sueldo:</label>
                            <input class="form-control sueldo" type="text" name="sueldo" id="sueldo" value=<?= esc($sueldo)?>>
                            <label for="fecingreso">Fecha Ingreso:</label>
                            <input type="date" class="form-control" id="fecingreso" name="fecingreso" value= <?= esc($fecingreso) ?>><br>
                            
                        </div>
                    </div>
                    <input type="hidden" name="codigo" id="codigo" value=<?= esc($codigo) ?> >
                    <button type="submit" class="btn btn-primary" style="background: #163eac; width: 100%;">Guardar</button>
                    <br>
                </form>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function(){
            const id_cargo = <?= esc($cargo)?>;
            const id_unidad = <?= esc($unidad) ?>;
            const id_funcion = <?= esc($funciones) ?>;
            const id_grupo = <?= esc($grupo)?>;
            const id_encargado = <?= esc($supervisor) ?>;
            $('.grupo').val(id_grupo);
            $.ajax({
                url: "<?php echo base_url('empleados/editar/get_cargos'); ?>",
                type: "post",
                data: {},
                dataType: 'json',
                success: function(data){
                    $('#cargo').html(data);
                    $('.cargo').val(id_cargo);
                },
                error: function(){
                    alert("error en cargar cargos");
                }
            });

            $.ajax({
                url: "<?php echo base_url('empleados/editar/get_unidad'); ?>",
                type: "post",
                data: {},
                dataType: 'json',
                success: function(data){
                    $('#unidad').html(data);
                    $('.unidad').val(id_unidad);
                },
                error: function(){
                    alert("error en cargar unidad");
                }
            });

            $.ajax({
                url: "<?php echo base_url('empleados/editar/get_funcion'); ?>",
                type: "post",
                data: {},
                dataType: 'json',
                success: function(data){
                    $('#funciones').html(data);
                    $('.funciones').val(id_funcion);
                },
                error: function(){
                    alert("error en cargar funciones");
                }
            });

            $.ajax({
                url: "<?php echo base_url('empleados/editar/get_encargado'); ?>",
                type: "post",
                data: {},
                dataType: 'json',
                success: function(data){
                    $('#supervisor').html(data);
                    $('.supervisor').val(id_encargado);
                },
                error: function(){
                    alert("error en cargar supervisores");
                }
            });
        });
    </script>
</body>
