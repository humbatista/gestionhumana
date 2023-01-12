<?php

/**
 * Se realizo este controller ya que todos los demas controladores usar AjaxSearch para
 * llenar el select de los centros educativos entonces necesariamente habria que usar
 * el mismo metodo para los demas controladores, se desidio realizar uno que todos los demas tengan accesos
 */

namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;

class AjaxSearchControllers extends Controller{
    public function ajaxSearch()
    {
        helper(['form', 'url']);

        $data = [];
        $db      = \Config\Database::connect();
        $builder = $db->table('t_centro_educativo');   
        $query = $builder->like('nombre_escuela', $this->request->getVar('q'))
                    ->select('escuela_id as id, nombre_escuela as text')
                    ->limit(10)->get();
        $data = $query->getResult();
        echo json_encode($data);
    }
}



