<html>
    <body>
        <div class="container" style="margin-top: 20px; margin-left:10%;">
            <form action="pension" method="get">
                <div class="row">
                    <div class="group-form">
                        <label for="fechaini">Fecha Inicio</label>
                        <input type="date" name="fechaini" id="fechaini" class="form-control">
                    </div>
                    <div class="group-form">
                        <label for="fechafin">Fecha Final</label>
                        <input type="date" name="fechafin" id="fechafin" class="form-control">
                    </div>
                    <div class="group-form">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoReporte" id="pantalla" value="1" checked class="form-control">
                            <label class="form-check-label" for="pantalla">
                                Reporte en Pantalla
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoReporte" id="impreso" value="2" class="form-control">
                            <label class="form-check-label" for="impreso">
                                Reporte Impreso
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reporte</button>
<!--                     <button type="Button" onclick="ImpReporte()" class="btn btn-success">Imprimir</button> -->
                </div>
            </form>
            <div class="panel" style="background:chocolate;">
            <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Cedula</th>
                      <th>Telefono</th>
                      <th>Distrito</th>
                      <th>Centro Educativo</th>
                      <th>Area</th>
                      <th>Puesto</th>
                      <th>Solicitud</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($pensiones as $row):?>
                 <tr>
                      <td><?= $row->nombre;?></td>
                      <td><?= $row->apellido;?></td>
                      <td><?= $row->cedula;?></td>
                      <td><?= $row->telefono;?></td>
                      <td><?= $row->distrito;?></td>
                      <td><?= $row->centro_educativo;?></td>
                      <td><?= $row->area;?></td>
                      <td><?= $row->puesto;?></td>
                      <td><a href="<?php echo base_url(); ?>/solicitud/admin/oficiopension/<?php echo $row->idpension;?>" ><i  class="fa fa-file" aria-hidden="true"></i> </a></td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
        </div>
    </body>
    <!-- <script>
    function ImpReporte() {
        var fechaini = $('#fechaini').val();
        var fechafin = $('#fechafin').val();
        //alert(fechafin);
        $.ajax({
            url: '<?php //echo base_url('solicitud/reporte/inclusion/export');?>',
           //url:"<?php //echo base_url() ?>/solicitud/reporte/inclusion/export",
            type: "post",
            //data: {'valor1': fechaini, 'valor2': fechafin},
            data:{},
        });
    };
    </script> -->
</html>