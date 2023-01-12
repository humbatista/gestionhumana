<html>
    <body>
        <div class="container" style="margin-top: 20px; margin-left:10%;">
            <form action="inclusion" method="get">
                <div class="row">
                    <div class="group-form">
                        <label for="fechaini">Fecha Inicio</label>
                        <input type="date" name="fechaini" id="fechaini">
                    </div>
                    <div class="group-form">
                        <label for="fechafin">Fecha Final</label>
                        <input type="date" name="fechafin" id="fechafin">
                    </div>
                    <div class="group-form">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoReporte" id="pantalla" value="1" checked>
                            <label class="form-check-label" for="pantalla">
                                Reporte en Pantalla
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoReporte" id="impreso" value="2">
                            <label class="form-check-label" for="impreso">
                                Reporte Impreso
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reporte</button>
                    <button type="Button" onclick="ImpReporte()" class="btn btn-success">Imprimir</button>
                </div>
            </form>
            <div class="panel" style="background:chocolate;">
            <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Fecha</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Cedula</th>
                      <th>Telefono</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($inclusion as $row):?>
                 <tr>
                      <td><?= $row->idinclusion;?></td>
                      <td><?= $row->fecha;?></td>
                      <td><?= $row->nombre;?></td>
                      <td><?= $row->apellido;?></td>
                      <td><?= $row->cedula;?></td>
                      <td><?= $row->telefono;?></td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
            <form method="post" action="reporte/inclusion/export">
                <a href="<?php echo base_url('export'); ?>" class="btn btn-success">General Excel</a>
            </form>
        </div>
    </body>
    <script>
    function ImpReporte() {
        var fechaini = $('#fechaini').val();
        var fechafin = $('#fechafin').val();
        //alert(fechafin);
        $.ajax({
            url: '<?php echo base_url('solicitud/reporte/inclusion/export');?>',
           //url:"<?php //echo base_url() ?>/solicitud/reporte/inclusion/export",
            type: "post",
            //data: {'valor1': fechaini, 'valor2': fechafin},
            data:{},
        });
    };
    </script>
</html>