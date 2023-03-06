<?php


$routes->get('empleados', '\Modules\Empleados\Controllers\Empleados::index');

    $routes->group('empleados', function ($routes) {
        $routes->get('/', '\Modules\Empleados\Controllers\Empleados::index');
        $routes->get('export', '\Modules\Empleados\Controllers\Empleados::export');
        $routes->post('export', '\Modules\Empleados\Controllers\Empleados::export');
        $routes->get('certificado', '\Modules\Empleados\Controllers\Empleados::certificado');
        $routes->get('dashboard', '\Modules\Empleados\Controllers\Dashboard::index');
        $routes->get('servidor1', '\Modules\Empleados\Controllers\Dashboard::servidor');
        $routes->get('evaluacion', '\Modules\Empleados\Controllers\Evaluacion::index');
        $routes->get('evaluar', '\Modules\Empleados\Controllers\Evaluar::index');
        $routes->post('evaluar/save', '\Modules\Empleados\Controllers\Evaluar::save');
        $routes->get('evaluar/print', '\Modules\Empleados\Controllers\Evaluar::export'); //borrarlo
        $routes->post('evaluar/print', '\Modules\Empleados\Controllers\Evaluar::export');
        $routes->get('evaluaciones', '\Modules\Empleados\Controllers\Evaluaciones::index');
        $routes->post('evaluaciones', '\Modules\Empleados\Controllers\Evaluaciones::index');
        $routes->post('historico', '\Modules\Empleados\Controllers\Historico::buscar');
        $routes->get('servidor', '\Modules\Empleados\Controllers\Servidor::index');
        $routes->post('servidor/vacaciones', '\Modules\Empleados\Controllers\Servidor::vacaciones');
        $routes->post('servidor/disfrute', '\Modules\Empleados\Controllers\Servidor::disfrute');
        $routes->get('servidor/create', '\Modules\Empleados\Controllers\Empleados_insert::index');
        $routes->post('servidor/save', '\Modules\Empleados\Controllers\Empleados_insert::save');
        $routes->post('servidor/update', '\Modules\Empleados\Controllers\Empleados_insert::update');
        $routes->get('editar', '\Modules\Empleados\Controllers\ServidorEdit::index');
        $routes->post('editar/get_cargos', '\Modules\Empleados\Controllers\ServidorEdit::get_cargos');
        $routes->get('editar/get_cargos', '\Modules\Empleados\Controllers\ServidorEdit::get_cargos');
        $routes->post('editar/get_unidad', '\Modules\Empleados\Controllers\ServidorEdit::get_unidad');
        $routes->get('editar/get_unidad', '\Modules\Empleados\Controllers\ServidorEdit::get_unidad');
        $routes->post('editar/get_funcion', '\Modules\Empleados\Controllers\ServidorEdit::get_funcion');
        $routes->get('editar/get_funcion', '\Modules\Empleados\Controllers\ServidorEdit::get_funcion');
        $routes->post('editar/get_encargado', '\Modules\Empleados\Controllers\ServidorEdit::get_encargado');
        $routes->post('vacaciones/save', '\Modules\Empleados\Controllers\Vacaciones::save');
        $routes->get('vacaciones/save', '\Modules\Empleados\Controllers\Vacaciones::save');
        $routes->get('disfrute/save', '\Modules\Empleados\Controllers\Disfrute::save');
        $routes->post('disfrute/save', '\Modules\Empleados\Controllers\Disfrute::save');
        $routes->get('cargo', '\Modules\Empleados\Controllers\Cargo::index');
        $routes->post('cargo/save', '\Modules\Empleados\Controllers\Cargo::save');
        $routes->get('funcion', '\Modules\Empleados\Controllers\Funciones::index');
        $routes->post('funcion/save', '\Modules\Empleados\Controllers\Funciones::save');
    });

    $routes->group('empleados/admin', function ($routes) {
        $routes->get('/', '\Modules\Empleados\Controllers\Admin::index');
        // $routes->get('usuario', '\Modules\Solicitudes\Controllers\Usuario::index');
        // $routes->post('obssave', '\Modules\Solicitudes\Controllers\ObservacionControllers::obssave');
        // $routes->get('centros', '\Modules\Solicitudes\Controllers\Escuela::index');
        // $routes->post('centros/save', '\Modules\Solicitudes\Controllers\Escuela::save');
        // $routes->post('centros/update', '\Modules\Solicitudes\Controllers\Escuela::update');
    });