<?php

namespace Modules\Solicitudes\Controllers;


class Solicitudes extends \CodeIgniter\Controller
{
    public function index()
    {
        /**
         * inicia el menu del modulo solicitudes
         */
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\menu\inicio');
        echo view('Modules\Solicitudes\Views\header\footer');
    }
}
