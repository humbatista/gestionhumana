<?php 
namespace Modules\Solicitudes\Controllers;

use Modules\Solicitudes\Models\Distrito_Model;
use Modules\Solicitudes\Models\Usuario_model;
use Modules\Solicitudes\Models\Empleados_Model;
class Usuario extends \CodeIgniter\Controller{
    public function index() {
        $model = new Usuario_model();
        $distrito = new Distrito_Model();
        $empleado =  new Empleados_Model();
        $data['usuarios'] = $model->getUsuario()->getResult();
        $data['distritos'] = $distrito->ObtenerDistrito()->getResult();
        $data['empleados'] = $empleado->ObtenerEmpleados()->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\admin\usuario_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
        //return view('/menu/header').view('/menu/student_view', $data);
        //return view("\Modules\Student\Views\student_index", $data);
    }
public function save()
    {
        $model = new Usuario_model();
        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $name = $this->request->getPost('name');
        $type = $this->request->getPost('type');
        $distrito_id = $this->request->getPost('distrito_id');
        $empleado = $this->request->getPost('empleado');
        $data = [
            'username' => $username,
            'name' => $name,
            'password'    => $password,
            'type' => $type,
            'distrito_id' => $distrito_id,
            'empleado' => $empleado
            ];
        $model->saveUsuario($data);
        return redirect()->to('solicitud/admin/usuario');
    }
 
    public function update()
    {
        $model = new Usuario_model();
        // $username = $this->request->getPost('username');
        // $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        // $name = $this->request->getPost('name');
        // $type = $this->request->getPost('type');
        // $distrito_id = $this->request->getPost('distrito_id');
        $id = $this->request->getPost('usuario_id');
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'type' => $this->request->getPost('type'),
            'distrito_id' => $this->request->getPost('distrito_id'),
            'empleado' => $this->request->getPost('empleado'),
        ];
        $model->update($id, $data);
        return redirect()->to('solicitud/admin/usuario');
    }
}