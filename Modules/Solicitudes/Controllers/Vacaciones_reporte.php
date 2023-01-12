<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use phpOffice\PhpWord\Style\Language;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\TryCath;
use Modules\Solicitudes\Models\Vacaciones_Model;

class Vacaciones_reporte extends Controller{
    public function index(){
        
        $fechaini= $this->request->getGet('fechaini');
        $fechafin= $this->request->getGet('fechafin');
        $tiporeporte = $this->request->getGet('tipoReporte');
        if ($tiporeporte == 2){
            $this->export($fechaini, $fechafin);
        }
        else { 
            $model = new Vacaciones_Model();
            $datos['vacaciones'] = $model->reporteVacaciones($fechaini,$fechafin)->getResult();
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\reporte\vacaciones', $datos);
            echo view('Modules\Solicitudes\Views\header\footer');
        }
        
    }

    function export($fechaini, $fechafin){
        $model = new Vacaciones_Model();
        $data = $model->reporteVacaciones($fechaini, $fechafin)->getResultArray();

        $file_name = 'Reporte_Vacaciones.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B2', 'Dirección Regional 11 de Educación');
        $sheet->getStyle('B2')->getFont()->setBold(true)->setSize(16);
        $sheet->setCellValue('B3', 'Reporte de Vacaciones');
        $sheet->getStyle('B3')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A5', 'Numero');

		$sheet->setCellValue('B5', 'Fecha');

		$sheet->setCellValue('C5', 'Empleado');

		$sheet->setCellValue('D5', 'Cedula');

		$sheet->setCellValue('E5', 'Distrito');

        $sheet->setCellValue('F5', 'Centro Educativo');

        $sheet->setCellValue('G5', 'Fecha Inicio');

        $sheet->setCellValue('H5', 'Fecha Fin');

        $sheet->setCellValue('I5', 'Periodo');

        $sheet->setCellValue('J5', 'Estado');
        
        $count = 6;
        $num=1;
		foreach($data as $row)
		{
            $sheet->setCellValue('A' . $count, $num);
			$sheet->setCellValue('B' . $count, $row['fecha']);

			$sheet->setCellValue('C' . $count, $row['empleado']);

			$sheet->setCellValue('D' . $count, $row['cedula']);

			$sheet->setCellValue('E' . $count, $row['distrito']);

            $sheet->setCellValue('F' . $count, $row['centro_educativo']);

            $sheet->setCellValue('G' . $count, $row['fecha_inicio']);

            $sheet->setCellValue('H' . $count, $row['fecha_fin']);

            $sheet->setCellValue('I' . $count, $row['periodo']);

            $sheet->setCellValue('J' . $count, $row['status']);

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