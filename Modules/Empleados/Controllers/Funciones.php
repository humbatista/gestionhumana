<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Funciones_Model;


class Funciones extends BaseController {
    public function index(){
        $model = new Funciones_Model();
        //$data['cargo']  = $cargo->findAll();
        $paginateData = $model->select('*')
                ->paginate(15);

        $data = [
            'funcion' => $paginateData,
            'pager'     => $model->pager
        ];
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\funcion_view', $data);
        echo view('Modules\Empleados\Views\header\footer');
    }

    public function save(){
        $model = new Funciones_Model();
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'estado'    => 'A',
        ];
        $model->save($data);
        //$model->saveCargo($data);
        return redirect()->to("empleados/funcion");
    }
}