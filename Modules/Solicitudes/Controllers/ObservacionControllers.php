<?php

/**
 * Se realizo este controller ya que todos los demas controladores usar las observaciones para
 * el mismo metodo para los demas controladores, se desidio realizar uno que todos los demas tengan accesos
 */

namespace Modules\Solicitudes\Controllers;


use Modules\Solicitudes\Models\Observacion_Model;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class ObservacionControllers extends Controller{
    public function buscar(){
        $id = $this->request->getPost('id');
        $tipo = $this->request->getPost('type');
        $model = new Observacion_Model();
        //$tipo = 'Pension';
        $record = $model->getObservacion($id, $tipo)->getResult();
        if(count($record)>0)
        {
            $data = '';
            $data .= '<table class="table table-hover" style="border-collapse: collapse;">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<td>Fecha</td>';
            $data .= '<td>Usuario</td>';
            $data .= '<td>Observación</td>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            foreach ($record as $row) {
                $data .= "<tr>";
                $data .= "<td>". $row->fecha. "</td>";
                $data .= "<td>". $row->usuario. "</td>";
                $data .= "<td>". $row->observacion. "</td>";
                $data .= "</tr>";
            }
            $data .= '</tbody></table>';
            echo json_encode($data);
        }
    }

    public function obssave(){
        $time = new Time('now');
        $model = new Observacion_Model();
        $data = [
            'idsolicitud' => $this->request->getPost('id'),
            'tipo'        => $this->request->getPost('tipo'),
            'fecha'       => $time,
            'observacion' => $this->request->getPost('observaciones'),
            'usuario'     =>   session('usuario'),
        ];
        $model->insert($data);
        $tipo = $this->request->getPost('tipo');
        switch ($tipo) {
            case 'AccionPers':
                return redirect()->to('solicitud/admin/admaccion');
                break;
            case 'Exclusion':
                return redirect()->to('solicitud/admin/admexclusion');
                break;
            case 'Inclusion':
                return redirect()->to('solicitud/admin/adminclusion');
                break;
            case 'Pension':
                return redirect()->to('solicitud/admin/admpension');
                break;
            case 'Licencia':
                return redirect()->to('solicitud/admin/admlicencia');
                break;
            case 'Renuncia':
                return redirect()->to('solicitud/admin/admrenuncia');
                break;
            case 'Vacaciones':
                return redirect()->to('solicitud/admin/admvacacion');
                break;
            default:
            return redirect()->to('solicitud/admin');
        }
    }

}