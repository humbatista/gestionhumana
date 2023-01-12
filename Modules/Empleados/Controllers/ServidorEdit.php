<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Cargo_Model;
use Modules\Empleados\Models\Unidad_Model;
use Modules\Empleados\Models\Funciones_Model;
use PhpParser\Node\Stmt\TryCatch;

class ServidorEdit extends BaseController {
    public function index(){
        $request = service('request');
        $id = $request->getGet('id');
        $model = new Empleados_Model();
        //$empleado = $model->getEmpleadobyCodigo($id)->getResult();
        $empleado = $model->find($id);
        //$datos['empleados'] = $model->find($id);
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\servidor_edit_view', $empleado);
        echo view('Modules\Empleados\Views\header\footer');
    }

    /* public function index(){
        $request = service('request');
        $id = $request->getGet('id');
        $model = new Empleados_Model();
        $data['empleados'] = $model->getEmpleadobyCodigo($id)->getResult();
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\empleados_edit_view', $data);
        echo view('Modules\Empleados\Views\header\footer');
    } */

    public function get_cargos(){
        $model = new Cargo_Model();
        $record = $model->getCargo()->getResult();
        //$record = $model->findAll();
        if(count($record)>0)
        {
            $act_select_box ='';
            $act_select_box .= '<option value="">Select Cargo</option>';
            foreach($record as $row){
                $act_select_box .='<option value="'.$row->codigo.'">'.$row->descripcion.'</option>';
            }
            echo json_encode($act_select_box);
        }
    }

    public function get_unidad(){
        $model = new Unidad_Model();
        $record = $model->getUnidad()->getResult();
        //$record = $model->findAll();
        if(count($record)>0)
        {
            $act_select_box ='';
            $act_select_box .= '<option value="">Select Unidad</option>';
            foreach($record as $row){
                $act_select_box .='<option value="'.$row->codigo.'">'.$row->descripcion.'</option>';
            }
            echo json_encode($act_select_box);
        }
    }

    public function get_funcion(){
        $model = new Funciones_Model();
        $record = $model->getCargo()->getResult();
        //$record = $model->findAll();
        if(count($record)>0)
        {
            $act_select_box ='';
            $act_select_box .= '<option value="">Select Funcion</option>';
            foreach($record as $row){
                $act_select_box .='<option value="'.$row->id.'">'.$row->descripcion.'</option>';
            }
            echo json_encode($act_select_box);
        }
    }


    public function get_encargado(){
        try {
            $model = new Empleados_Model();
            $record = $model->getencargados()->getResult();
            if(count($record)>0)
            {
                $act_select_box ='';
                $act_select_box .= '<option value="">Select Encargado</option>';
                foreach($record as $row){
                    $act_select_box .='<option value="'.$row->codigo.'">'.$row->nombre. ' ' . $row->apellido.'</option>';
                }
                echo json_encode($act_select_box);
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo 'ups fallo en get_encargado';
        }
        
    }
}