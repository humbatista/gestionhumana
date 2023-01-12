<body>
<link rel="stylesheet" id="theme-style" href="<?php echo base_url('/public/assets/css/dashboad.css');?>">
    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Solicitudes Pendientes</h2>
            </header>
            <div class="w3-container">
                <table class="table texto-card">
                  <?php
                  foreach ($solicitudes as $rows) {
                      echo "<tr>";
                      echo "<td><h4>". $rows->Cantidad. "</h4></td>";
                      echo "<td><h4>". $rows->Descripcion. "</h4></td>";
                      echo "</tr>";
                  }
                  ?>
                </table>
            </div>
        </div>
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Total de Solicitudes por Distritos</h2>
            </header>
            <div class="w3-container">
              <table class="table texto-card">
                <?php
                  foreach ($distritos as $rows) {
                    echo "<tr>";
                    echo "<td><h4>". $rows->Cantidad. "</h4></td>";
                    echo "<td><h4>". $rows->Distrito. "</h4></td>";
                    echo "</tr>";
                  }
                ?>
              </table>
            </div>
        </div>
      </div>
    </div>
    <!-- este es el segundo row para mostrar las informaciones -->
    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Pendiente Registro de Vacaciones 2022</h2>
            </header>
            <div class="w3-container">
                <div>
                    <ol class="texto-card">
                      <?php
                        foreach ($faltantes as $rows) {
                          echo "<li>". $rows->nombre."-". $rows->apellido."</li>";
                        }
                      ?>
                    </ol>
                </div>
            </div>
        </div>
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Personal de Licencias</h2>
            </header>
            <div class="w3-container">
                <div>
                    <ol class="texto-card">
                      <?php
                        foreach ($licencia as $rows) {
                          echo "<li>". $rows->nombre."-". $rows->apellido." ".$rows->fechaini." ".$rows->fechafin."</li>";
                        }
                      ?>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- este es el tercer row para mostrar las informaciones -->
    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Estados de Situacion</h2>
            </header>
            <div class="w3-container">
                <div>
                    <ol class="texto-card">
                      <?php
                        foreach ($faltantes as $rows) {
                          echo "<li>". $rows->nombre."-". $rows->apellido."</li>";
                        }
                      ?>
                    </ol>
                </div>
            </div>
        </div>
      </div>
      <div class="col-sm-5">
        <br>
          <div class ="w3-card-4" style="width:80%">
            <header class="w3-container w3-blue">
              <h2>Personal de Licencias</h2>
            </header>
            <div class="w3-container">
                <div>
                    <ol class="texto-card">
                      <?php
                        foreach ($licencia as $rows) {
                          echo "<li>". $rows->nombre."-". $rows->apellido." ".$rows->fechaini." ".$rows->fechafin."</li>";
                        }
                      ?>
                    </ol>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>