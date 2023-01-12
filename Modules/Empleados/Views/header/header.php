<header>
     <div class="menu-header">
          <div class="container">
               <img  src="<?php echo base_url('/public/assets/img/logo.png');?>" class="img-responsive">
          </div>
     </div>
</header>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<a class="navbar-brand" href="#">Usuario: <?php echo session('usuario');?> Distrito: <?php echo session('distrito');?></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Realizar Evaluaciones <span class="sr-only">(current)</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="evaluaciones.php">Ver Evaluaciones</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('empleados/servidor');?>">Servidores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('empleados/servidor/create');?>">Nuevo Servidor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('empleados/evaluaciones');?>">Evaluaciones</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimientos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Unidades</a>
          <a class="dropdown-item" href="<?php echo base_url('empleados/cargo');?>">Cargos</a>
          <a class="dropdown-item" href="<?php echo base_url('empleados/funcion');?>">Funciones</a>
          <a class="dropdown-item" href="#">Grupo Ocupacional</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/');?>">Home</a>
      </li>
    </ul>
    
  </div>
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('/salir') ?>">Salir <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
</nav>
