<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Cumple_Model;
use Modules\Empleados\Models\v_Empleados_Model;
use Modules\Login\Models\Solicitudes_Model;


class Dashboard extends BaseController {
    public function index(){
        $model = new Cumple_Model();
        $empleado = new v_Empleados_Model();
        $solicitudes = new Solicitudes_Model();
        $paginateData = $empleado->select('*')
                        ->paginate(15);
        $data['empleados'] = $paginateData;
        $data['pager'] = $empleado->pager;
        $data['traer_cumple'] = $model->mostrar_cumple_hoy()->getResult();
        $data['faltantes'] = $solicitudes->getRegVacaciones('2022')->getResult();
        $data['licencia'] = $solicitudes->pesonaldelicencia()->getResult();
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\intranet\header');
        echo view('Modules\Empleados\Views\intranet\dashboard', $data);
    }

    public function servidor() {
        $request = service('request');
        $codigo = $request->getGet('codigo');
        #$model = new Empleados_Model();
        $model = new v_Empleados_Model();
        $empleado = $model->find($codigo);
        #$empleado = $model->get_servidor($codigo)->getResultArray();
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\intranet\header');
        echo view('Modules\Empleados\Views\intranet\servidor_view', $empleado);
        echo view('Modules\Empleados\Views\header\footer');
    }
}