<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\v_Empleados_Model;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Empleados extends BaseController
{
    public function index()
    {
        $request = service('request');
        $searchData= $request->getGet();

        $search="";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }

        // obtener datos

        $model = new v_Empleados_Model();
        
        if ($search =='') {
            $paginateData = $model->select('*')
                ->paginate(15);
        } else {
            $paginateData = $model->select('*')
                ->orlike('nombre', $search)
                ->orlike('apellido', $search)
                ->orlike('cedula', $search)
                ->paginate(15);
        } 
        
        
        $data = [
            'empleados' => $paginateData,
            'pager'     => $model->pager,
            'search'    => $search
        ];
        echo view('Modules\Empleados\Views\header\head');
        echo view('Modules\Empleados\Views\header\header');
        echo view('Modules\Empleados\Views\form\empleados_view', $data);
        echo view('Modules\Empleados\Views\header\footer');
    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }


    function check_in_range($fecha_inicio, $fecha_fin, $fecha){

        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);
   
        if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
   
            return true;
   
        } else {
   
            return false;
   
        }
    }

    /* imprime el listado de los empleados */
    public function export(){

        $model = new Empleados_Model();
        $data = $model->getEmpleados()->getResultArray();


        $file_name = 'Listado_Colaboradores.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B2', 'Dirección Regional 11 de Educación');
        $sheet->getStyle('B2')->getFont()->setBold(true)->setSize(16);
        $sheet->setCellValue('B3', 'Listado de Colaboradores');
        $sheet->getStyle('B3')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A5', 'Numero');

		$sheet->setCellValue('B5', 'Nombre');

		$sheet->setCellValue('C5', 'Apellido');

		$sheet->setCellValue('D5', 'Cedula');

		$sheet->setCellValue('E5', 'Telefono');
        
        $count = 6;
        $num=1;
		foreach($data as $row)
		{
            $sheet->setCellValue('A' . $count, $num);
			$sheet->setCellValue('B' . $count, $row['nombre']);

			$sheet->setCellValue('C' . $count, $row['apellido']);

			$sheet->setCellValue('D' . $count, $row['cedula']);

			$sheet->setCellValue('E' . $count, $row['telefono']);

			$count++;
            $num++;
		} 

        $writer = new Xlsx($spreadsheet);

		$writer->save($file_name);

		header("Content-Type: application/vnd.ms-excel");

		header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

		header('Expires: 0');

		header('Cache-Control: must-revalidate');

		header('Pragma: public');

		header('Content-Length:' . filesize($file_name));

		flush();
		readfile($file_name);
		exit;
    }

    
}
