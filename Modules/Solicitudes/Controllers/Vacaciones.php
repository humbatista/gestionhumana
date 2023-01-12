<?php 
namespace Modules\Solicitudes\Controllers;

use CodeIgniter\Controller;
use Modules\Solicitudes\Models\Vacaciones_Model;

class Vacaciones extends Controller{

    public function index(){
        //echo('vacaciones');
        try {
            $model = new Vacaciones_Model();
            $data['vacaciones'] = $model->getbyDistrito(session('distrito'))->getResult();
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
            echo view('Modules\Solicitudes\Views\form\vacaciones_view', $data);
            echo view('Modules\Solicitudes\Views\header\footer');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function admin(){
       try {
        $model = new Vacaciones_Model();
        $data['vacaciones'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\vacaciones_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
       } catch (\Throwable $th) {
        throw $th;
       }
    }

    public function save()
    {
        try {
            $model = new Vacaciones_Model();
            $data = array(
                'empleado' => $this->request->getPost('empleado'),
                'cedula' => $this->request->getPost('cedula'),
                'distrito' => session('distrito'),
                'periodo' => $this-> request->getPost('periodo'),
                'fecha_inicio' => $this-> request->getPost('fecha_inicio'),
                'fecha_fin' => $this-> request->getPost('fecha_fin'),
                'centro_educativo' => $this-> request->getPost('search'),
                'status' => 'Enviada',
                'activa' => 'SI',
            );
            $model->save($data);
            if (session('type')=='A')
                return redirect()->to('solicitud/admin/vacaciones');
            else return redirect()->to('solicitud/vacaciones');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}