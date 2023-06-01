<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Cargo_Model;
use Modules\Empleados\Models\Unidad_Model;
use Modules\Empleados\Models\Funciones_Model;

class Empleados_insert extends BaseController{
    public function index() {
        $cargo = new Cargo_Model();
        $unidad = new Unidad_Model();
        $funcion = new Funciones_Model();
        $encargado = new Empleados_Model();
        $data['cargo']  = $cargo->findAll();
        $data['unidad'] = $unidad->findAll();
        $data['funcion'] = $funcion->findAll();
        $data['encargados'] = $encargado->getencargados()->getResultArray();
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\empleados_insert_view', $data);
        echo view('Modules\Empleados\Views\header\footer');
    }

    public function save()
    {
        $time = new Time('now');
        $model = new Empleados_Model();
        $data = array(
            'nombre'       => $this->request->getPost('nombre'),
            'apellido'  => $this->request->getPost('apellido'),
            'cedula'        => $this->request->getPost('cedula'),
            'telefono'      => $this->request->getPost('telefono'),
            'fecnacimiento' => $this->request->getPost('fecnacimiento'),
            'sexo'   => $this->request->getPost('sexo'),
            'sueldo' => $this->request->getPost('sueldo'),
            'cargo'  => $this->request->getPost('cargo'),
            'funciones' => $this->request->getPost('funciones'),
            'grupo'  => $this->request->getPost('grupo'),
            'unidad'  => $this->request->getPost('unidad'),
            'supervisor' => $this->request->getPost('supervisor'),
            'encargado' => $this->request->getPost('encargado'),
            'fecingreso'  => $this->request->getPost('fecingreso'),
            'creado' => session('usuario'),
            'feccreado'  => $time,
            'estado' => 'A'
        );
        $model->save($data);
        return redirect()->to('empleados/');
    }

    public function update()
    {
        $time = new Time('now');
        $model = new Empleados_Model();
        $codigo = $this->request->getPost('codigo');
        $data = array(
            'nombre'       => $this->request->getPost('nombre'),
            'apellido'  => $this->request->getPost('apellido'),
            'cedula'        => $this->request->getPost('cedula'),
            'telefono'      => $this->request->getPost('telefono'),
            'fecnacimiento' => $this->request->getPost('fecnacimiento'),
            'sexo'   => $this->request->getPost('sexo'),
            'sueldo' => $this->request->getPost('sueldo'),
            'cargo'  => $this->request->getPost('cargo'),
            'funciones' => $this->request->getPost('funciones'),
            'grupo'  => $this->request->getPost('grupo'),
            'unidad'  => $this->request->getPost('unidad'),
            'supervisor' => $this->request->getPost('supervisor'),
            'encargado' => $this->request->getPost('encargado'),
            'fecingreso'  => $this->request->getPost('fecingreso'),
            'modificado' => session('usuario'),
            'fecmodificado'  => $time
        );
        $model->updateServidor($data, $codigo);
        return redirect()->to('empleados/servidor?codigo='.$codigo);
    }


}