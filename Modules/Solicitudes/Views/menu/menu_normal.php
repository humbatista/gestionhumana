<div class="w3-bar w3-black">
          <span class="w3-bar-item" href="#">Usuario: <?php echo session('nombre');?> Distrito: <?php echo session('distrito');?></span>
          <a href="<?php echo base_url('solicitud') ?>" class="w3-bar-item w3-button w3-mobile">Home</a>
          <a href="<?php echo base_url('solicitud/pension') ?>"class="w3-bar-item w3-button w3-mobile">Pensiones</a>
          <a href="<?php echo base_url('solicitud/inclusion') ?>" class="w3-bar-item w3-button w3-mobile">Inclusiones</a>
          <a href="<?php echo base_url('solicitud/exclusion') ?>" class="w3-bar-item w3-button w3-mobile">Exclusiones</a>
          <a href="<?php echo base_url('solicitud/licencia') ?>" class="w3-bar-item w3-button w3-mobile">Permisos y Licencias</a>
          <a href="<?php echo base_url('solicitud/renuncia') ?>" class="w3-bar-item w3-button w3-mobile">Abandono y Renuncia</a>
          <a href="<?php echo base_url('solicitud/accionpersonal') ?>" class="w3-bar-item w3-button w3-mobile">Accion de Personal</a>
          <a href="<?php echo base_url('solicitud/vacaciones') ?>" class="w3-bar-item w3-button w3-mobile">Vacaciones</a>
          <a href="<?php echo base_url('salir') ?>" class="w3-bar-item w3-button w3-mobile">Salir</a>
     </div>