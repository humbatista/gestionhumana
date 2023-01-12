<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Cargo_Model;


class Cargo extends BaseController {
    public function index(){
        $cargo = new Cargo_Model();
        //$data['cargo']  = $cargo->findAll();
        $paginateData = $cargo->select('*')
                ->paginate(15);

        $data = [
            'cargo' => $paginateData,
            'pager'     => $cargo->pager
        ];
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\cargo_view', $data);
        echo view('Modules\Empleados\Views\header\footer');
    }

    public function save(){
        $model = new Cargo_Model();
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'estado'    => 'A',
        ];
        $model->save($data);
        //$model->saveCargo($data);
        return redirect()->to("empleados/cargo");
    }
}