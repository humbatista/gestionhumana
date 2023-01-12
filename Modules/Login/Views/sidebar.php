<link rel="stylesheet" id="theme-style" href="<?php echo base_url('/public/assets/css/app.css');?>">
<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                
                <div class="logo-nuevo">
        <img id="logo-endogeno" src="<?php echo base_url('/public/assets/img/logo.png');?>">
                </div> Administrador </div>
        </div>

        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li>
                    <a href="<?= base_url('admin')?>">
                        <i class="fa fa-home"></i> Inicio</a>
                </li>
                <!-- Sub-menu de producto -->
                <li>
                    <a href="">
                        <i class="fa fa-file-text"></i> Solicitudes
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="<?= base_url('solicitud/admin/adminclusion')?>"><i class="fa fa-ellipsis-h"></i>Inclusion</a></li>
                        <li><a href="<?= base_url('solicitud/admin/admexclusion')?>"><i class="fa fa-ellipsis-h"></i>Exclusion</a></li>
                        <li><a href="<?= base_url('solicitud/admin/admlicencia')?>"><i class="fa fa-ellipsis-h"></i>Licencia</a></li>
                        <li><a href="<?= base_url('solicitud/admin/admrenuncia')?>"><i class="fa fa-ellipsis-h"></i>Renuncia</a></li>
                        <li><a href="<?= base_url('solicitud/admin/admaccion')?>"><i class="fa fa-ellipsis-h"></i>Exclusion</a></li>
                        <li><a href="<?= base_url('solicitud/admin/usuario')?>"><i class="fa fa-ellipsis-h"></i>Licencia</a></li>
                        <li><a href="<?= base_url('solicitud/admin/centros')?>"><i class="fa fa-ellipsis-h"></i>Renuncia</a></li>
                    </ul>
                </li>
                <!--Fin de sub-menu de producto -->



                <!-- Sub-menu de proveedor -->    
                <li>
                    <a href="">
                        <i class="fa fa-book"></i>Empleados
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="<?= base_url('empleados/')?>"><i class="fa fa-ellipsis-h"></i>Listar proveedores</a></li>                            
                        <li><a href="#"><i class="fa fa-plus"></i>Agregar proveedor</a></li>
                    </ul>
                </li>
                <!-- Fin de sub-menu de proveedor -->
                                                


                <!-- Sub-menu de pedido -->
                <li>
                    <a href="">
                        <i class="fa fa-gift"></i>Actividades
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="#"><i class="fa fa-ellipsis-h"></i>Listar pedidos</a></li>
                        <li><a href="#"><i class="fa fa-plus"></i>Añadir pedido</a></li>
                    </ul>
                    </li>
                <!-- Fin de sub-menu de pedido -->


                <!-- Sub-menu de clientes-->
                <li>
                    <a href="">
                        <i class="fa fa-handshake-o"></i>Certificado Laboral
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="#s"><i class="fa fa-ellipsis-h"></i>Listar clientes</a></li>                            
                        <li><a href="#"><i class="fa fa-plus"></i>Agregar cliente</a></li>
                    </ul>
                </li>
                <!-- Fin de sub-menu de clientes -->

                <!-- Sub-menu de factura-->
                <li>
                    <a href="">
                        <i class="fa fa-ticket"></i>Factura
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="#"><i class="fa fa-ellipsis-h"></i>Listar facturas</a></li>
                        <li><a href="#"><i class="fa fa-money"></i>Emitir factura</a></li>
                    </ul>
                </li>
                <!-- Fin de sub-menu de factura -->
                
                
                <!-- Sub-menu de usuarios -->
                <li>
                    <a href="">
                        <i class="fa fa-users"></i> Usuarios
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Crear usuario</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Listar usuarios</a></li>                                 </ul>
                </li>
                <!--Fin de sub-menu de usuarios -->

                <!-- Sub-menu de opciones-->
                <li>
                    <a href="">
                        <i class="fa fa-cog"></i> Opciones
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li><a href="#"><i class="fa fa-file-o"></i>Importar base de datos</a></li>
                        <li><a href="#"><i class="fa fa-download"></i>Descargar base de datos</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i>Configuracion general</a></li>
                    </ul>
                </li>
                 <!--Fin de sub-menu de opciones -->


                <!-- Sub-menu de manual de usuario-->

                <li>
                    <a href="">
                        <i class="fa fa-book"></i> Manual de usuario
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">             
                    {% load static %}
                        <li><a href="#"><i class="fa fa-eye"></i>Ver manual de usuario</a></li>
                    </ul>
                </li>

                 <!--Fin de sub-menu de manual de usuario -->

                  <!-- -->
            </ul>
        </nav>
    </div>
</aside>