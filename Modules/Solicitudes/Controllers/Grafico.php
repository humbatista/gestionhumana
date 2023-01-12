<?php 
namespace Modules\Solicitudes\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\Controller;
use App\Models\Estudiante_model;
class Grafico extends Controller{
    
    public function index(){
        $model = new Estudiante_model();
        $record = $model->etapa_dashboard()->getResult();
        foreach($record as $row) {
            $data['etapa'][] = $row->etapa;
            $data['cantidad'][]= (int) $row->cantidad;
        }
        $data['etapa_data'] = json_encode($data);
        $record = $model->area_dashboard()->getResult();
        foreach($record as $row){
            $data1['x'][] = $row->fecha;
            $data1['y'][] =$row->cantidad;
        }
        $data1['area_data'] = json_encode($data1);
        //$this->load->view('bar_chart', $data);
        echo view('/header/head');
        echo view('/header/header');
        echo view('/menu/sidebaradmin');
        echo view('/admin/dashboard');
        echo view('/grafico/area_chart',$data1);
        echo view('/grafico/etapa_chart', $data);
        echo view('/header/footer');
    }

    public function grafico_etapa(){
        $model = new Estudiante_model();
        $record = $model->etapa_dashboard()->getResult();
        foreach($record as $row) {
            $data['etapa'][] = $row->etapa;
            $data['cantidad'][]= (int) $row->cantidad;
        }
        $data['etapa_data'] = json_encode($data);
        echo view('/header/head');
        echo view('/header/header');
        echo view('/menu/sidebar');
        echo view('/grafico/etapa_chart', $data);
        echo view('/header/footer');
    }

}