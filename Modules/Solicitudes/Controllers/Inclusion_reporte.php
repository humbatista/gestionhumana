<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
//use CodeIgniter\I18n\Time;
//use phpOffice\PhpWord\Style\Language;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpParser\Node\Stmt\TryCath;
use Modules\Solicitudes\Models\Inclusion_Model;
//use Modules\Solicitudes\Models\Observacion_Model;

class Inclusion_reporte extends Controller{
    public function index(){
        
        $fechaini= $this->request->getGet('fechaini');
        $fechafin= $this->request->getGet('fechafin');
        $tiporeporte = $this->request->getGet('tipoReporte');
        if ($tiporeporte == 2){
            $this->export($fechaini, $fechafin);
            //$this->reporte($fechaini, $fechafin);
        }
        else { 
            $this->reporte($fechaini, $fechafin);
        }
        
    }

    function reporte($fechaini, $fechafin){
        $model = new Inclusion_Model();
        $datos['inclusion'] = $model->reporteInclusion($fechaini,$fechafin)->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\reporte\inclusion',$datos);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    function export($fechaini, $fechafin){
        $model = new Inclusion_Model();
        $data = $model->reporteInclusion($fechaini, $fechafin)->getResultArray();

        $file_name = 'Reporte_Inclusion.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B2', 'Dirección Regional 11 de Educación');
        $sheet->getStyle('B2')->getFont()->setBold(true)->setSize(16);
        $sheet->setCellValue('B3', 'Solicitudes de Inclusion a Seguro Salud');
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