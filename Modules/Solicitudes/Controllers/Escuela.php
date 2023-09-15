<?php 
namespace Modules\Solicitudes\Controllers;
use CodeIgniter\Controller;
use Modules\Solicitudes\Models\Escuela_Model;
class Escuela extends Controller{
    public function index()
    {
        $model = new Escuela_Model();
        $data['escuela']  = $model->obtenerEscuela()->getResult();
        $data['distrito'] = $model->obtenerDistrito()->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\escuela_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }
    
    /* public function admin()
    {
        $model = new Escuela_Model();
        $data['escuela']  = $model->obtenerEscuela()->getResult();
        $data['distrito'] = $model->obtenerDistrito()->getResult();
        echo view('/header/head');
        echo view('/header/header');
        echo view('/menu/sidebaradmin');
        echo view('/form/escuela_view', $data);
        echo view('/header/footer');
    } */


    public function action() {
        if($this->request->getVar('action')) {
            $action =$this->request->getVar('action');
            if($action == 'cargar') {
                $model = new Escuela_Model();

                $data = $model->where('distrito', $this->request->getVar('distrito_id'))->findAll();

                echo json_encode($data);
            }
        }
    }
    public function carga() {

        $model = new Escuela_Model();
        $id = $this->request->getpost('id');
        if($id){
            $escuela = $model->getEscuelaDistrito($id)->getResult();
            echo '<option value="">Escuelas</option>';
            foreach($escuela as $row) {
                echo '<option value="'. $row->escuela_id .'">' . $row-> nombre_escuela . '</option>';
            }
        } else {
            echo '<option value=""> Escuela </option>';
        }


    }

    public function save()
    {
        $model = new Escuela_Model();
        $data = array(
            'codigo_id'       => $this->request->getPost('codigo'),
            'dependencia'  => $this->request->getPost('dependencia'),
            'nombre_escuela'        => $this->request->getPost('nombre_escuela'),
            'distrito' => $this->request->getPost('distrito'),
            'nivel'   => $this->request->getPost('nivel'),
            'tanda'  => $this->request->getPost('tanda'),
        );
        $model->saveEscuela($data);
        return redirect()->to('solicitud/admin/centros');
    }
 
    public function update()
    {
        $model = new Escuela_Model();
        $id = $this->request->getPost('escuela_id');
        $data = array(
            'nombre_escuela'        => $this->request->getPost('nombre_escuela'),
            'codigo_id'       => $this->request->getPost('codigo_id'),
            'distrito' => $this->request->getPost('distrito'),
        );
        $model->updateEscuela($data, $id);
        return redirect()->to('solicitud/centro');
    }
 
    public function delete()
    {
        $model = new Escuela_Model();
        $id = $this->request->getPost('escuela_id');
        $model->deleteEscuela($id);
        return redirect()->to('solicitud/centro');
    }

}