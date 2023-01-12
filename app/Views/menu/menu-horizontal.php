<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Usuario: <?php echo session('usuario');?> Distrito: <?php echo session('distrito');?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav nav-pills mr-auto">
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/inicio') ?>" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/pension') ?>" class="nav-link">Pensiones</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/inclusion') ?>" class="nav-link">Inclusiones</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/exclusion') ?>" class="nav-link">Exclusiones</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/licencia') ?>" class="nav-link">Permiso y Licenci</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/renuncia') ?>" class="nav-link">Abandono y Renuncia</a>
                    </li>
                    <li class="nav-item active">
                      <a href="<?php echo base_url('/accionpersonal') ?>" class="nav-link">Acción de Personal</a>
                    </li>
                    <li class="nav-item active">
                         <a class="nav-link" href="<?php echo base_url('/salir') ?>">Salir <span class="sr-only">(current)</span></a>
                    </li>
               </ul>
          </div>
     </nav>