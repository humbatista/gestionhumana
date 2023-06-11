<?php


$routes->get('sgs', '\Modules\Sgs\Controllers\Solicitud::index');

    $routes->group('sgs', function ($routes) {
        $routes->get('/', '\Modules\SGS\Controllers\Solicitudes::index');
        $routes->get('dashboard', '\Modules\SGS\Controllers\Dashboard::index');
    });
