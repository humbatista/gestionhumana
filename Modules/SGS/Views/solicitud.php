<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sistema de Solicitudes</title>

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">

<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" href="javascript/jquery-ui-1.7.1.custom/css/cupertino/jquery-ui-1.7.1.custom.css" rel="Stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="javascript/js/promtcss.css" rel="stylesheet" type="text/css" />
<link href="css/mlevelmenu.css" rel="stylesheet" type="text/css" />
<link href="css/jqueryslidemenu.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.gritter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/jquery-ui-1.7.1.custom/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="javascript/js/jquery.gritter.min.js"></script>
<script type="text/javascript" src="javascript/jquery-ui-1.7.1.custom/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="javascript/jquery-ui-1.7.1.custom/development-bundle/ui/ui.tabs.js"></script>
<script type="text/javascript" src="javascript/config_login.js"></script>
<script type="text/javascript" src="javascript/js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="javascript/js/script.js"></script>
<script src="javascript/jquery.timer2.js" type="text/javascript"></script>
<script src="javascript/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="javascript/jquery.dwdinanews.0.1.js" type="text/javascript"></script>
<link href="css/tipTip.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/poshy/jquery.tipTip.js"></script>

<link rel="stylesheet" id="theme-style" href="<?php echo base_url('/public/assets/css/sgs.css');?>">

</head>



<body>
<?php
/* 	include_once("inc/func.php");
    include_once("menu.php");
	require_once("class/solicitudes.class.php"); */
	$solicitudes = new solicitudes($conexion);
	$actividades = $solicitudes->get_Actividades_rec();

?>
	<div id="header">
            <div style="float:left;width: 80%"><h1>Bienvenido al sistema</h1></div>
            <div style="float:right;width: 20%">
                <h1>
                    <a href="http://10.12.0.13/sgs/sgs_video/sgs.html" target="_blank" style="color:red;background-color:white">
                        Cambios en S.G.S.&nbsp;<img src="images/video.png" alt="Video de Cambios en S.G.S." title="Video de Cambios en S.G.S." width="42">
                    </a>
                </h1>
            </div>
	</div>
	<div class="colmask blogstyle divfondos" style='height: 400px; '>
		<div class="colmid">
			<div class="colleft" >
				<div class="col1" >
					<!-- Column 1 start -->
					<div style="text-align:center;font-weight:bold;"><h3>Actividad reciente de sus solicitudes</h3><a href='#' style='position:absolute; margin: -10px 260px;' id='linkes' name='linkes'><img src='img/up.gif'></a></div>
	<div id="otrasnovedades" style='background: url(css/background3.png); height: 300px; border-color: white;'>
		<ul id='listas' name='listas'>
			<?php

			if(empty($actividades['CODIGO'])){
			echo "<li class='nov'><img src='img/nov.png' width='20'>
						<b> Notificaci&oacute;n </b><br>
						 No tiene actividad en sus solicitudes...<br>
						</li>";
			}else{
				$n=0;
				$blank2 = "_blank";
				foreach($actividades['CODIGO'] as $codigo){
				//Targe para abrir las pesta�as
						echo "<li class='nov'><img src='img/nov.png' width='20'>
						<b> Solicitud No.".$codigo." </b> Estado: ".$actividades['ESTADO'][$n]." Categoria: ".$actividades['CATEGORIA'][$n]."<br>
						Solicitante: ".$actividades['USUARIO'][$n]." ".$actividades['FECHA'][$n]." <br>
						".substr($actividades['JUSTIFICACION'][$n],0,58)."... <a href='vista.php?enc=y&&view=".$codigo."' style='font-size: 13px;' target='".$blank2."'>Leer Mas</a>
						</li>";
				$n++;
				}
			}

			?>
		</ul>
	</div>
	<div style="margin-left:auto;margin-right:auto;width:400px;">
	<a href='#' style='position:absolute; margin: 0px 460px;' id='linkes2' name='linkes2'><img src='img/down.gif'></a>
	</div>
	</div>

				<div class="col2" >
					<!-- Column 2 start -->
					<h2>Funcionalidades b&aacute;sicas</h2>

				<h3>Utilice el mouse como Asistente de ayuda.</h3>
				<ul>
   				<li><p>Al desplazar el mouse por encima de cualquier opci&oacute;n, <b>la aplicaci&oacute;n le brindara informaci&oacute;n</b> relacionada con la acci&oacute;n que realizar&aacute; la misma.</p></li>
                <li><p>Utilice la opci&oacute;n <b>Mis Solicitudes</b> para modificar las solicitudes guardadas o ver el estado de las que ya ha enviado.</p></li>
                </ul>

                <h3><img style="width: 300px; height: 100px;" src="img/help1.png"></h3>
					<!-- Column 2 end -->

			   </div>


				<div class="col3">
					<!-- Column 3 start -->
					<h2>Otras funcionalidades</h2>
					<h3>Ver las actividades m&aacute;s recientes ocurridas con sus solicitudes</h3>
	                <p>En la columna de la izquierda se muestran las solicitudes que han sido recientemente aprobadas, rechazadas, etc. as&iacute; como tambien otros eventos de inter&eacute;s. </p>

					<h3>Manual del sistema</h3>
	                <p>Puede recibir ayuda adicionar utilizando el <a href="Manual/MUS03-AppSolicitudesServicio - V2.pdf" style="color: blue; font-size: 15px;" class="tiphelp" title="(?) Manual de usuarios - Aqu&iacute; puede realizar las consultas relacionadas con las funcionalidades del modulo">Manual de Usuarios.</a></p>

				    <h3>Salir del sistema</h3>
	                <p>Puede salir del sistema haciendo click en la opci&oacute;n <b>Cerrar sesi&oacute;n</b> en la parte derecha del men&uacute; superior.</p>


						<!-- Column 3 end -->

				</div>

			</div>
		</div>
	</div>

	<div id="footer">
		<p>&copy;2015 AAA Dominicana - Departamento de Inform&#225;tica.</p>
	</div>

</body>
</html>