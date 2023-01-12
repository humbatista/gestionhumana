<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Evaluacion_Model;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class Evaluacion extends BaseController
{
    public function index(){
        try {
            $model = new Evaluacion_Model();
            $codigo = session('empleado');
            $data['empleados'] = $model->getEmpleados($codigo)->getResult();
            echo view('Modules\Empleados\Views\header\head');
            echo view('Modules\Empleados\Views\intranet\header');
            echo view('Modules\Empleados\Views\intranet\evaluacion', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}