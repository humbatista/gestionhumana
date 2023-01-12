<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Vacaciones_Model;
use Modules\Empleados\Models\Disfrute_Model;
use Modules\Empleados\Models\v_Empleados_Model;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class Servidor extends BaseController {
    public function index() {
        $request = service('request');
        $codigo = $request->getGet('codigo');
        #$model = new Empleados_Model();
        $model = new v_Empleados_Model();
        $empleado = $model->find($codigo);
        #$empleado = $model->get_servidor($codigo)->getResultArray();
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\servidor_view', $empleado);
        echo view('Modules\Empleados\Views\header\footer');
    }

    public function vacaciones(){
        $id = $this->request->getPost('id');
        $model = new Vacaciones_Model();
        $record = $model->getVacaciones($id)->getResultArray();
        if(count($record)>0)
        {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Año</td>';
            $data .= '<td>Dias Vacaciones</td>';
            $data .= '<td>Dias Pendientes</td>';
            $data .= '<td>Dias Disfrutados</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            foreach ($record as $row) {
                $data .= "<tr>";
                $data .= "<td>". $row['periodo']. "</td>";
                $data .= "<td>". $row['diasvacaciones']. "</td>";
                $data .= "<td>". $row['pendiente']. "</td>";
                $data .= "<td>". $row['disfrutado']. "</td>";
                $data .= "</tr>";
            }
            $data .= '</tbody></table>';
            echo json_encode($data);
        } else {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Año</td>';
            $data .= '<td>Dias Vacaciones</td>';
            $data .= '<td>Dias Pendientes</td>';
            $data .= '<td>Dias Disfrutados</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '</table>';
            echo json_encode($data);
        }
    }

    public function disfrute(){
        $id = $this->request->getPost('id');
        $model = new Disfrute_Model();
        $record = $model->getVacaciones($id)->getResultArray();
        if(count($record)>0)
        {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Vacaciones</td>';
            $data .= '<td>Dias</td>';
            $data .= '<td>Inicio</td>';
            $data .= '<td>Fin</td>';
            $data .= '<td>Estado</td>';
            $data .= '<td>Tipo</td>';
            $data .= '<td>Razon</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            foreach ($record as $row) {
                $data .= "<tr>";
                $data .= "<td>". $row['vacaciones']. "</td>";
                $data .= "<td>". $row['dias']. "</td>";
                $data .= "<td>". $row['fecha_inicio']. "</td>";
                $data .= "<td>". $row['fecha_fin']. "</td>";
                $data .= "<td>". $row['estado']. "</td>";
                $data .= "<td>". $row['tipo']. "</td>";
                $data .= "<td>". $row['razon']. "</td>"; 
                $data .= "</tr>";
            }
            $data .= '</tbody></table>';
            echo json_encode($data);
        }else {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Vacaciones</td>';
            $data .= '<td>Dias</td>';
            $data .= '<td>Inicio</td>';
            $data .= '<td>Fin</td>';
            $data .= '<td>Estado</td>';
            $data .= '<td>Tipo</td>';
            $data .= '<td>Razon</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '</table>';
            echo json_encode($data);
        }
    }

    public function permiso(){
        $id = $this->request->getPost('id');
        $model = new Disfrute_Model();
        $record = $model->getVacaciones($id)->getResultArray();
        if(count($record)>0)
        {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Vacaciones</td>';
            $data .= '<td>Dias</td>';
            $data .= '<td>Inicio</td>';
            $data .= '<td>Fin</td>';
            $data .= '<td>Estado</td>';
            $data .= '<td>Tipo</td>';
            $data .= '<td>Razon</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            foreach ($record as $row) {
                $data .= "<tr>";
                $data .= "<td>". $row['vacaciones']. "</td>";
                $data .= "<td>". $row['dias']. "</td>";
                $data .= "<td>". $row['fecha_inicio']. "</td>";
                $data .= "<td>". $row['fecha_fin']. "</td>";
                $data .= "<td>". $row['estado']. "</td>";
                $data .= "<td>". $row['tipo']. "</td>";
                $data .= "<td>". $row['razon']. "</td>"; 
                $data .= "</tr>";
            }
            $data .= '</tbody></table>';
            echo json_encode($data);
        }else {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Vacaciones</td>';
            $data .= '<td>Dias</td>';
            $data .= '<td>Inicio</td>';
            $data .= '<td>Fin</td>';
            $data .= '<td>Estado</td>';
            $data .= '<td>Tipo</td>';
            $data .= '<td>Razon</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '</table>';
            echo json_encode($data);
        }
    }
    
}