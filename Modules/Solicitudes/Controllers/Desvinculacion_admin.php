<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use phpOffice\PhpWord\Style\Language;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\TryCath;
use Modules\Solicitudes\Models\Desvinculacion_Model;
use PhpParser\Node\Stmt\TryCatch;

class Desvinculacion_admin extends Controller{   
    /* public function index(){
        echo ('desvinculacion_admin');
    } */

    public function loadRecord(){
        try {
            //code...
            $request = service('request');
            $searchData= $request->getGet();

            $search="";
            if (isset($searchData) && isset($searchData['search'])) {
                $search = $searchData['search'];
            }

            //obtener los datos

            $users = new Desvinculacion_Model();
    
            if ($search=='') {
                $paginateData = $users->where(['status !=' => 'Entregada'])
                    ->paginate(5);
            } else {
                $paginateData = $users->select('*')
                    ->orlike('distrito', $search)
                    ->orlike('nombre', $search)
                    ->orlike('cedula', $search)
                    ->paginate(5);
            }

            $data = [
                'users' => $paginateData,
                'pager' => $users->pager,
                'search' => $search
            ];
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\admin\desvinculacion_admin_view', $data);
            echo view('Modules\Solicitudes\Views\header\footer');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function enviada(){
        $model = new Desvinculacion_Model();
        $id = $this->request->getPost('id');
        $model->enviada($id);
    }

    public function recibida(){
        $model = new Desvinculacion_Model();
        $id = $this->request->getPost('id');
        $model->recibida($id);
    }

    public function entregada(){
        $model = new Desvinculacion_Model();
        $id = $this->request->getPost('id');
        $model->entregada($id);
    }

    public function solicitada(){
        $model = new Desvinculacion_Model();
        $id = $this->request->getPost('id');
        $model->solicitada($id);
    }
}