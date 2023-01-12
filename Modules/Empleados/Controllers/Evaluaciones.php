<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Evaluacion_Model;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class Evaluaciones extends BaseController
{
    public function index(){
        try {
            $periodo = $this->request->getPost('periodo');
            if (isset($periodo)== false):
                $periodo='202208';
            endif;
            //echo $periodo;
            $model = new Evaluacion_Model();
            $data['evaluaciones'] = $model->getEvaluaciones($periodo)->getResult();
            echo view('Modules\Empleados\Views\header\head');
            echo view('Modules\Empleados\Views\header\header');
            echo view('Modules\Empleados\Views\form\evaluaciones', $data);
            echo view('Modules\Empleados\Views\header\footer');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}