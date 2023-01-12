<?php

namespace Modules\Login\Controllers;

use App\Controllers\BaseController;
use Modules\Login\Models\Solicitudes_Model;

class Admin extends BaseController{
    public function index(){
        $model = new Solicitudes_Model();
        $datos['solicitudes'] = $model->getPendientes()->getResult();
        $datos['distritos'] = $model->getPendientes_Distritos()->getResult();
        $datos['faltantes'] = $model->getRegVacaciones('2022')->getResult();
        $datos['licencia'] = $model->pesonaldelicencia()->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        //echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Login\Views\menu_sidebar');
        echo view('Modules\Login\Views\admin', $datos);
    }

}