<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;

class Admin extends Controller{
    public function index(){
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\admin\admin');
        echo view('Modules\Solicitudes\Views\header\footer');
    }
}