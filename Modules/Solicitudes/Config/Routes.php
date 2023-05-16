<?php

//...  
$routes->get('solicitudes', '\Modules\Solicitudes\Controllers\Solicitudes::index');

    $routes->group('solicitud', function ($routes) {
        $routes->get("/", '\Modules\Solicitudes\Controllers\Solicitudes::index');
        $routes->get('pension', '\Modules\Solicitudes\Controllers\Pension::index');
        $routes->post('pension/save', '\Modules\Solicitudes\Controllers\Pension::save');
        $routes->post('pension/update', '\Modules\Solicitudes\Controllers\Pension::update');
        $routes->get('pension_export', '\Modules\Solicitudes\Controllers\Pension::export');
        $routes->get('pension_buscar', '\Modules\Solicitudes\Controllers\Pension::buscar');
        $routes->get('inclusion', '\Modules\Solicitudes\Controllers\Inclusion::index');
        $routes->post('inclusion/save', '\Modules\Solicitudes\Controllers\Inclusion::save');
        $routes->post('inclusion/update', '\Modules\Solicitudes\Controllers\Inclusion::update');
        $routes->get('inclusion_export', '\Modules\Solicitudes\Controllers\Inclusion::export');
        $routes->get('exclusion', '\Modules\Solicitudes\Controllers\Exclusion::index');
        $routes->post('exclusion/save', '\Modules\Solicitudes\Controllers\Exclusion::save');
        $routes->post('exclusion/update', '\Modules\Solicitudes\Controllers\Exclusion::update');
        $routes->get('exclusion_export', '\Modules\Solicitudes\Controllers\Exclusion::export');
        $routes->get('licencia', '\Modules\Solicitudes\Controllers\Licencia::index');
        $routes->post('licencia/save', '\Modules\Solicitudes\Controllers\Licencia::save');
        $routes->post('licencia/update', '\Modules\Solicitudes\Controllers\Licencia::update');
        $routes->get('licencia_export', '\Modules\Solicitudes\Controllers\Licencia::export');
        $routes->get('licencia_export_maternidad', '\Modules\Solicitudes\Controllers\Licencia::export');
        //$routes->get('licencia/historico', '\Modules\Solicitudes\Controllers\Licencia::historico');
        $routes->get('licencia/historico', '\Modules\Solicitudes\Controllers\Licencia_historico::loadRecord');
        $routes->get('renuncia', '\Modules\Solicitudes\Controllers\Renuncia::index');
        $routes->post('renuncia/save', '\Modules\Solicitudes\Controllers\Renuncia::save');
        $routes->post('renuncia/update', '\Modules\Solicitudes\Controllers\Renuncia::update');
        $routes->get('renuncia_export', '\Modules\Solicitudes\Controllers\Renuncia::export');
        $routes->get('accionpersonal', '\Modules\Solicitudes\Controllers\Accionpersonal::index');
        $routes->post('accionpersonal/save', '\Modules\Solicitudes\Controllers\Accionpersonal::save');
        $routes->post('accionpersonal/update', '\Modules\Solicitudes\Controllers\Accionpersonal::update');
        $routes->get('accionpersonal_export', '\Modules\Solicitudes\Controllers\Accionpersonal::export');
        $routes->get('vacaciones', '\Modules\Solicitudes\Controllers\Vacaciones::index');
        $routes->get('vacaciones_export', '\Modules\Solicitudes\Controllers\Vacaciones::export');
        $routes->post('vacaciones/save', '\Modules\Solicitudes\Controllers\Vacaciones::save');
        $routes->get('centro_ajaxsearch', '\Modules\Solicitudes\Controllers\AjaxSearchControllers::ajaxsearch');
        $routes->get('buscar', '\Modules\Solicitudes\Controllers\ObservacionControllers::buscar');
        $routes->post('buscar', '\Modules\Solicitudes\Controllers\ObservacionControllers::buscar');
        $routes->get('desvinculacion', '\Modules\Solicitudes\Controllers\Desvinculacion::index');
        $routes->get('desvinculacion/save', '\Modules\Solicitudes\Controllers\Desvinculacion::save');
        
        
    });

    $routes->group('solicitud/admin', function ($routes) {
        $routes->get('/', '\Modules\Solicitudes\Controllers\Admin::index');
        $routes->get('usuario', '\Modules\Solicitudes\Controllers\Usuario::index');
        $routes->post('usuario/update', '\Modules\Solicitudes\Controllers\Usuario::update');
        $routes->post('usuario/save', '\Modules\Solicitudes\Controllers\Usuario::save');
        $routes->post('obssave', '\Modules\Solicitudes\Controllers\ObservacionControllers::obssave');
        $routes->get('centros', '\Modules\Solicitudes\Controllers\Escuela::index');
        $routes->post('centros/save', '\Modules\Solicitudes\Controllers\Escuela::save');
        $routes->post('centros/update', '\Modules\Solicitudes\Controllers\Escuela::update');
        $routes->post('licencia/save', '\Modules\Solicitudes\Controllers\Licencia::save');
        $routes->get('admpension', '\Modules\Solicitudes\Controllers\Pension_admin::loadRecord');
        $routes->get('admpension/export','\Modules\Solicitudes\Controllers\Pension_admin::export');
        $routes->get('adminclusion', '\Modules\Solicitudes\Controllers\Inclusion_admin::loadRecord');
        $routes->get('adminclusion/export','\Modules\Solicitudes\Controllers\Inclusion_admin::export' );
        $routes->get('admpension', '\Modules\Solicitudes\Controllers\Pension_admin::loadRecord');
        $routes->get('admpension/export', '\Modules\Solicitudes\Controllers\Pension_admin::export');
        $routes->get('admexclusion', '\Modules\Solicitudes\Controllers\Exclusion_admin::loadRecord');
        $routes->get('admexclusion/export', '\Modules\Solicitudes\Controllers\Exclusion_admin::export');
        $routes->post('admexclusion/export', '\Modules\Solicitudes\Controllers\Exclusion_admin::export');
        $routes->get('admlicencia', '\Modules\Solicitudes\Controllers\Licencia_admin::loadRecord');
        $routes->get('licencia_export', '\Modules\Solicitudes\Controllers\Licencia_admin::export');
        $routes->get('admlicenciamat/export', '\Modules\Solicitudes\Controllers\Licencia_admin::export_maternidad');
        $routes->get('admrenuncia', '\Modules\Solicitudes\Controllers\Renuncia_admin::loadRecord');
        $routes->get('admrenuncia/export', '\Modules\Solicitudes\Controllers\Renuncia_admin::export');
        $routes->get('admaccion', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::loadRecord');
        $routes->get('admaccion/export', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::export');
        $routes->get('admvacacion', '\Modules\Solicitudes\Controllers\Vacaciones_admin::loadRecord');
        $routes->get('admvacacion/export', '\Modules\Solicitudes\Controllers\Vacaciones_admin::export');
        
        $routes->get('pension', '\Modules\Solicitudes\Controllers\Pension::admin');
        $routes->post('pension/save', '\Modules\Solicitudes\Controllers\Pension::save');
        $routes->get('inclusion', '\Modules\Solicitudes\Controllers\Inclusion::admin');
        $routes->post('inclusion/save', '\Modules\Solicitudes\Controllers\Inclusion::save');
        $routes->get('exclusion', '\Modules\Solicitudes\Controllers\Exclusion::admin');
        $routes->post('exclusion/save', '\Modules\Solicitudes\Controllers\Exclusion::save');
        $routes->get('licencia', '\Modules\Solicitudes\Controllers\Licencia::admin');
        $routes->get('renuncia', '\Modules\Solicitudes\Controllers\Renuncia::admin');
        $routes->get('desvinculacion', '\Modules\Solicitudes\Controllers\Desvinculacion::index');
        $routes->post('desvinculacion/save', '\Modules\Solicitudes\Controllers\Desvinculacion::save');
        $routes->post('desvinculacion/update', '\Modules\Solicitudes\Controllers\Desvinculacion::update');
        $routes->post('renuncia/save', '\Modules\Solicitudes\Controllers\Renuncia::save');
        $routes->get('accion', '\Modules\Solicitudes\Controllers\Accionpersonal::admin');
        $routes->post('accionpersonal/save', '\Modules\Solicitudes\Controllers\Accionpersonal::save');


        $routes->post('accionpersonal/aprobar', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::aprobar');
        $routes->post('accionpersonal/aceptar', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::aceptar');
        $routes->post('accionpersonal/devolver', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::devolver');
        $routes->post('accionpersonal/rechazar', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::rechazar');
        $routes->post('accionpersonal/enviar', '\Modules\Solicitudes\Controllers\Accionpersonal_admin::enviar');
        $routes->post('exclusion/aprobar', '\Modules\Solicitudes\Controllers\Exclusion_admin::aprobar');
        $routes->post('exclusion/aceptar', '\Modules\Solicitudes\Controllers\Exclusion_admin::aceptar');
        $routes->post('exclusion/devolver', '\Modules\Solicitudes\Controllers\Exclusion_admin::devolver');
        $routes->post('exclusion/rechazar', '\Modules\Solicitudes\Controllers\Exclusion_admin::rechazar');
        $routes->post('exclusion/enviar', '\Modules\Solicitudes\Controllers\Exclusion_admin::enviar');
        $routes->post('inclusion/aprobar', '\Modules\Solicitudes\Controllers\Inclusion_admin::aprobar');
        $routes->post('inclusion/aceptar', '\Modules\Solicitudes\Controllers\Inclusion_admin::aceptar');
        $routes->post('inclusion/devolver', '\Modules\Solicitudes\Controllers\Inclusion_admin::devolver');
        $routes->post('inclusion/rechazar', '\Modules\Solicitudes\Controllers\Inclusion_admin::rechazar');
        $routes->post('pension/enviar', '\Modules\Solicitudes\Controllers\Pension_admin::enviar');
        $routes->post('pension/aprobar', '\Modules\Solicitudes\Controllers\Pension_admin::aprobar');
        $routes->post('pension/aceptar', '\Modules\Solicitudes\Controllers\Pension_admin::aceptar');
        $routes->post('pension/devolver', '\Modules\Solicitudes\Controllers\Pension_admin::devolver');
        $routes->post('pension/rechazar', '\Modules\Solicitudes\Controllers\Pension_admin::rechazar');
        $routes->post('licencia/enviar', '\Modules\Solicitudes\Controllers\Licencia_admin::enviar');
        $routes->post('licencia/aprobar', '\Modules\Solicitudes\Controllers\Licencia_admin::aprobar');
        $routes->post('licencia/aceptar', '\Modules\Solicitudes\Controllers\Licencia_admin::aceptar');
        $routes->post('licencia/devolver', '\Modules\Solicitudes\Controllers\Licencia_admin::devolver');
        $routes->post('licencia/rechazar', '\Modules\Solicitudes\Controllers\Licencia_admin::rechazar');
        $routes->post('renuncia/enviar', '\Modules\Solicitudes\Controllers\Renuncia_admin::enviar');
        $routes->post('renuncia/aprobar', '\Modules\Solicitudes\Controllers\Renuncia_admin::aprobar');
        $routes->post('renuncia/aceptar', '\Modules\Solicitudes\Controllers\Renuncia_admin::aceptar');
        $routes->post('renuncia/devolver', '\Modules\Solicitudes\Controllers\Renuncia_admin::devolver');
        $routes->post('renuncia/rechazar', '\Modules\Solicitudes\Controllers\Renuncia_admin::rechazar');
        $routes->post('vacacion/aprobar', '\Modules\Solicitudes\Controllers\Vacaciones_admin::aprobar');
        $routes->post('vacacion/aceptar', '\Modules\Solicitudes\Controllers\Vacaciones_admin::aceptar');
        $routes->post('vacacion/devolver', '\Modules\Solicitudes\Controllers\Vacaciones_admin::devolver');
        $routes->post('vacacion/rechazar', '\Modules\Solicitudes\Controllers\Vacaciones_admin::rechazar');
    });

    $routes->group('solicitud/reporte', function ($routes) {;
        $routes->get('inclusion', '\Modules\Solicitudes\Controllers\Inclusion_reporte::index');
        $routes->get('pension', '\Modules\Solicitudes\Controllers\Pensiones_reporte::index');
        $routes->get('renuncias', '\Modules\Solicitudes\Controllers\Renuncia_reporte::index');
        $routes->get('licencias', '\Modules\Solicitudes\Controllers\Licencia_reporte::index');
        $routes->get('vacaciones', '\Modules\Solicitudes\Controllers\Vacaciones_reporte::index');
    });
