<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Vacaciones_Model;


class Vacaciones extends BaseController {
    public function index(){
        $request = service('request');
        $codigo = $request->getGet('codigo');
        $model = new Vacaciones_Model();
        $vacaciones = $model->find($codigo);
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\vacaciones_view');
        echo view('Modules\Empleados\Views\header\footer');
    }

    public function save(){
        $model = new Vacaciones_Model();
        $id = $this->request->getPost('id');
        $data = array(
            'empleado' =>  $this->request->getPost('id'),
            'periodo' => $this->request->getPost('periodo'),
            'diasvacaciones' => $this->request->getPost('dias'),
            'pendiente' => $this->request->getPost('pendiente'),
            'disfrutado' => $this->request->getPost('disfrutado'),
        );
        $model->saveVacaciones($data);
        return redirect()->to("empleados/servidor?codigo=$id");
    }
}