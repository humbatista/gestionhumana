<html>
    <body>
        <div class="container" style="margin-top: 20px; margin-left:10%;">
            <form action="vacaciones" method="get">
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
                </div>
            </form>
            <div class="panel" style="background:chocolate;">
            <div class="table-responsive sm">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Empleado</th>
                      <th>Cedula</th>
                      <th>Distrito</th>
                      <th>Periodo</th>
                      <th>Inicio</th>
                      <th>Fin</th>
                      <th>Dias</th>
                      <th>Centro Educativo</th>
                      <th>Activa</th>
                      <th>Estado</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($vacaciones as $row):?>
                 <tr>
                      <td><?= $row->empleado;?></td>
                      <td><?= $row->cedula;?></td>
                      <td><?= $row->distrito;?></td>
                      <td><?= $row->periodo;?></td>
                      <td><?= $row->fecha_inicio;?></td>
                      <td><?= $row->fecha_fin;?></td>
                      <td><?= $row->dias;?></td>
                      <td><?= $row->centro_educativo;?></td>
                      <td><?= $row->activa;?></td>
                      <td><?= $row->status;?></td>
                  </tr>
              <?php endforeach;?>
              </tbody>
          </table>
        </div>
    </body>
</html>