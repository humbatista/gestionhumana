<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/* $routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::inicio');
$routes->post('/login', 'Home::login');
$routes->get('/salir', 'Home::salir');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/administrador', 'Home::admin'); */
// $routes->get('/dashboard', 'Home::dashboard');
// $routes->get('/administrador', 'Home::admin');
// $routes->get('/pension', 'Pension::index');
// $routes->get('/observacion', 'Observaciones::index');
//$routes->get('usuario', '\Modules\Solicitudes\Controllers\Usuario::index');
// $routes->get('/admpension', 'Pension_admin::loadRecord');
// $routes->get('/adminclusion', 'Inclusion_admin::loadRecord');
// $routes->get('/admexclusion', 'Exclusion_admin::loadRecord');
// $routes->get('/admlicencia', 'Licencia_admin::loadRecord');
// $routes->get('/admrenuncia', 'Renuncia_admin::loadRecord');
// $routes->get('/admaccion', 'Accionpersonal_admin::loadRecord');
// $routes->get('/centros', 'Escuela::admin');
// $routes->get('/adm_pension', 'Pension::admin');
// $routes->get('/adm_inclusion', 'Inclusion::admin');
// $routes->get('/adm_exclusion', 'Exclusion::admin');
// $routes->get('/adm_licencia', 'Licencia::admin');
// $routes->get('/adm_renuncia', 'Renuncia::admin');
// $routes->get('/adm_accion', 'Accionpersonal::admin');

//$routes->resource('licencia');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

//...  

// Add this to Footer, Including all module routes

if (file_exists(ROOTPATH.'Modules')){
    $modulesPath = ROOTPATH.'Modules/';
    $modules = scandir($modulesPath);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') continue;
        if (is_dir($modulesPath).'/'.$module) {
            $routesPath = $modulesPath . $module . '/Config/Routes.php';
            if (file_exists($routesPath)){
                require($routesPath);
            }
            else {
                continue;
            }
        }
    }
}
//...
