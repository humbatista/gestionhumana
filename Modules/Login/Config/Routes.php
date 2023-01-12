<?php

/**
 * esta es la rutas del login
 */

$routes->get('/', '\Modules\Login\Controllers\Home::index');
$routes->get('/inicio', '\Modules\Login\Controllers\Home::inicio');
$routes->post('login', '\Modules\Login\Controllers\Home::login');
$routes->get('/salir', '\Modules\Login\Controllers\Home::salir');
$routes->get('/dashboard', '\Modules\Login\Controllers\Home::dashboard');
$routes->get('/administrador', '\Modules\Login\Controllers\Home::admin');
$routes->get('/empleados', '\Modules\Login\Controllers\Home::empleados');
$routes->get('/admin', '\Modules\Login\Controllers\Admin::index');



//$routes->get('adm_accion', '\Modules\Solicitudes\Controllers\Accionpersonal::admin');