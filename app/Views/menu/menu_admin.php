<div class="w3-bar w3-black">
          <span class="w3-bar-item" href="#">Usuario: <?php echo session('nombre');?></span>
          <a href="<?php echo base_url('/adm_pension') ?>"class="w3-bar-item w3-button w3-mobile">Pensiones</a>
          <a href="<?php echo base_url('/adm_inclusion') ?>" class="w3-bar-item w3-button w3-mobile">Inclusiones</a>
          <a href="<?php echo base_url('/adm_exclusion') ?>" class="w3-bar-item w3-button w3-mobile">Exclusiones</a>
          <a href="<?php echo base_url('/adm_licencia') ?>" class="w3-bar-item w3-button w3-mobile">Permisos y Licencias</a>
          <a href="<?php echo base_url('/adm_renuncia') ?>" class="w3-bar-item w3-button w3-mobile">Abandono y Renuncia</a>
          <a href="<?php echo base_url('/adm_accion') ?>" class="w3-bar-item w3-button w3-mobile">Accion de Personal</a>
          <a href="<?php echo base_url('/salir') ?>" class="w3-bar-item w3-button w3-mobile">Salir</a>
     </div>