<?php

/**
 * Se realizo este controller ya que todos los demas controladores usar las observaciones para
 * el mismo metodo para los demas controladores, se desidio realizar uno que todos los demas tengan accesos
 */

namespace Modules\Empleados\Controllers;

use CodeIgniter\Controller;
use Modules\Empleados\Models\Evaluacion_Model;


class Historico extends Controller{
    public function buscar(){
        $id = $this->request->getPost('id');
        $model = new Evaluacion_Model();
        $record = $model->getHistorico($id)->getResult();
        if(count($record)>0)
        {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Fecha</td>';
            $data .= '<td>Periodo</td>';
            $data .= '<td>Calificacion</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            foreach ($record as $row) {
                $data .= "<tr>";
                $data .= "<td>". $row->fecha. "</td>";
                $data .= "<td>". $row->periodo. "</td>";
                $data .= "<td>". $row->calificacion. "</td>";
                $data .= "</tr>";
            }
            $data .= '</tbody></table>';
            echo json_encode($data);
        }
    }

    

}