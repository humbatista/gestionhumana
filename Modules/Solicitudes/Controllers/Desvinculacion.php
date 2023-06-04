<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use phpOffice\PhpWord\Style\Language;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\TryCath;
use Modules\Solicitudes\Models\Desvinculacion_Model;
use Modules\Solicitudes\Models\Escuela_Model;

class Desvinculacion extends Controller{   
    public function index(){
        $model = new Desvinculacion_Model();
        $centro = new Escuela_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['desvinculacion'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\desvinculacion_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function admin(){
        $model = new Desvinculacion_Model();
        $centro = new Escuela_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['desvinculacion'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\desvinculacion_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function save()
    {
        try {
             $time = new Time('now');
            $model = new Desvinculacion_Model();
            $data = array(
                'nombre' => $this->request->getPost('nombre'),
                'cedula' => $this->request->getPost('cedula'),
                'centro_educativo' => $this-> request->getPost('search'),
                'distrito' => session('distrito'),
                'lugar' => $this-> request->getPost('lugar'),
                'puesto' => $this-> request->getPost('puesto'),
                'status' => 'Solicitada',
                'telefono' => $this->request->getPost('telefono'),
                'fecha'        => $time,
                'fecha_entrega' => $this->request->getPost('fecha_entrega'),
                'fecha_entrada' => $this->request->getPost('fecha_entrada'),
                'fecha_salida' => $this->request->getPost('fecha_salida'),
                'usuario' => session('usuario'),
                'activa' =>'SI',
            );
            $model->save($data);

            if (session('type')=='A')
                return redirect()->to('solicitud/admin/desvinculacion');
            else return redirect()->to('solicitud/desvinculacion');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update()
    {
        try {
            //code...
            $time = new Time('now');
            $model = new Desvinculacion_Model();
            $id = $this->request->getPost('id');
            $data = array(
                'nombre' => $this->request->getPost('nombre'),
                'cedula' => $this->request->getPost('cedula'),
                'centro_educativo' => $this-> request->getPost('centro'),
                'distrito' => session('distrito'),
                'lugar' => $this-> request->getPost('lugar'),
                'puesto' => $this-> request->getPost('puesto'),
                'telefono' => $this->request->getPost('telefono'),
                'fecha'        => $time,
                'fecha_entrega' => $this->request->getPost('fecha_entrega'),
                'fecha_entrada' => $this->request->getPost('fecha_entrada'),
                'fecha_salida' => $this->request->getPost('fecha_salida'),
                'usuario' => session('usuario'),
                'activa' =>'SI',
            );
            $model->update($id, $data);
            return redirect()->to('solicitud/admin/desvinculacion');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}