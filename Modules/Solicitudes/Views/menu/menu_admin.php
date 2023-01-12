<div class="w3-bar w3-black">
          <span class="w3-bar-item" href="#">Usuario: <?php echo session('nombre');?></span>
          <a href="<?php echo base_url('solicitud/admin/pension') ?>"class="w3-bar-item w3-button w3-mobile">Pensiones</a>
          <a href="<?php echo base_url('solicitud/admin/inclusion') ?>" class="w3-bar-item w3-button w3-mobile">Inclusiones</a>
          <a href="<?php echo base_url('solicitud/admin/exclusion') ?>" class="w3-bar-item w3-button w3-mobile">Exclusiones</a>
          <a href="<?php echo base_url('solicitud/admin/licencia') ?>" class="w3-bar-item w3-button w3-mobile">Permisos y Licencias</a>
          <a href="<?php echo base_url('solicitud/admin/renuncia') ?>" class="w3-bar-item w3-button w3-mobile">Abandono y Renuncia</a>
          <a href="<?php echo base_url('solicitud/admin/accion') ?>" class="w3-bar-item w3-button w3-mobile">Accion de Personal</a>
          <a href="<?php echo base_url('solicitud/admin/vacaciones') ?>" class="w3-bar-item w3-button w3-mobile">Vacaciones</a>
          <a href="<?php echo base_url('/salir') ?>" class="w3-bar-item w3-button w3-mobile">Salir</a>
     </div>