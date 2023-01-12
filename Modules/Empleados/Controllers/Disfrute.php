<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Disfrute_Model;


class Disfrute extends BaseController {
    public function save(){
        $model = new Disfrute_Model();
        $id = $this->request->getPost('id');
        $data = array(
            'empleado' =>  $this->request->getPost('id'),
            'vacaciones' => $this->request->getPost('vacaciones'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_fin'  => $this->request->getPost('fecha_fin'),
            'estado' => 'Activa',
            'dias'   => $this->request->getPost('dias'),
            'tipo' => $this->request->getPost('tipo'),
            'razon' => $this->request->getPost('razon'),
            'observacion' => $this->request->getPost('observacion'),
        );
        //$model->save($data);
        $model->saveDisfrute($data);
        return redirect()->to("empleados/servidor?codigo=$id");
    }
}