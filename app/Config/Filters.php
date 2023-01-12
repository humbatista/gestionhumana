<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'SessionAdmin' => \App\Filters\SessionAdmin::class,
        'SessionUsers' => \App\Filters\SessionUsers::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        "SessionAdmin" => [
            "before" => [
                "/admin",
                "/solicitud/admin",
                "/empleados",
                "/solicitud/admin/adminclusion",
                "/solicitud/admin/admexclusion",
                "/solicitud/admin/admexclusion",
                "/solicitud/admin/admpension",
                "/solicitud/admin/admrenuncia",
                "/solicitud/admin/admaccion",
                "/solicitud/admin/usuario",
                "/solicitud/admin/centros",
                "/solicitud/reporte/pension",
                "/solicitud/reporte/renuncias",
                "/solicitud/reporte/licencias",
                "/solicitud/reporte/vacaciones",
                "/solicitud/inicio",
                "/solicitud/dashboard",
                "/solicitud/administrador",
                "/solicitud/admpension",
                "/solicitud/adminclusion",
                "/solicitud/admexclusion",
                "/solicitud/admaccion",
                "/solicitud/escuela",
                "/solicitud/usuario",
                "/solicitud/adm_pension",
                "/solicitud/adm_accionpersonal",
                "/solicitud/adm_exclusion",
                "/solicitud/adm_inclusion",
                "/solicitud/adm_licencia",
                "/solicitud/adm_pension",
                "/solicitud/adm_renuncia",
                "/empleados",
                "/empleados/servidor",
                "/empleados/servidor/create",
                "/empleados/evaluaciones",
                "/empleados/editar",
                "/empleados/dashboard",
                "/empleados/evaluacion",

            ]
            ],
        "SessionUsers" => [
            "before" => [
                "/solicitudes",
                "/solicitud/pension",
                "/admin",
                "/solicitud/admin",
                "/solicitud/admin/adminclusion",
                "/asolicitud/admin/admexclusion",
                "/solicitud/admin/admexclusion",
                "/solicitud/admin/admpension",
                "/solicitud/admin/admrenuncia",
                "/solicitud/admin/admaccion",
                "/solicitud/admin/usuario",
                "/solicitud/admin/centros",
                "/solicitud/reporte/pension",
                "/solicitud/reporte/renuncias",
                "/solicitud/reporte/licencias",
                "/solicitud/reporte/vacaciones",
                "/solicitud/inicio",
                "/solicitud/dashboard",
                "/solicitud/administrador",
                "/solicitud/admpension",
                "/solicitud/adminclusion",
                "/solicitud/admexclusion",
                "/solicitud/admaccion",
                "/solicitud/escuela",
                "/solicitud/usuario",
                "/solicitud/adm_pension",
                "/solicitud/adm_accionpersonal",
                "/solicitud/adm_exclusion",
                "/solicitud/adm_inclusion",
                "/solicitud/adm_licencia",
                "/solicitud/adm_pension",
                "/solicitud/adm_renuncia",
                "/solicitud/admin/admpension",
                "/solicitud/inicio",
                "/solicitud/pension",
                "/solicitud/accionpersonal",
                "/solicitud/exclusion",
                "/solicitud/grafico",
                "/solicitud/inclusion",
                "/solicitud/licencia",
                "/solicitud/pension",
                "/solicitud/renuncia",
            ]
        ]
    ];
}