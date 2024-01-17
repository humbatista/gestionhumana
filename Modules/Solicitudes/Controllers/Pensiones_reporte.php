<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\TryCath;
use Modules\Solicitudes\Models\Inclusion_Model;
use Modules\Solicitudes\Models\Pension_Model;

class Pensiones_reporte extends Controller{
    public function index(){
        
        $fechaini= $this->request->getGet('fechaini');
        $fechafin= $this->request->getGet('fechafin');
        $tiporeporte = $this->request->getGet('tipoReporte');
        if ($tiporeporte == 2){
            $this->export($fechaini, $fechafin);
        }
        else { 
            $model = new Pension_Model();
            $datos['pensiones'] = $model->reportePension($fechaini,$fechafin)->getResult();
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\reporte\pension', $datos);
            echo view('Modules\Solicitudes\Views\header\footer');
        }
        
    }

    function export($fechaini, $fechafin){
        $model = new Pension_Model();
        $data = $model->reportePension($fechaini, $fechafin)->getResultArray();

        $file_name = 'Reporte_Pension.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B2', 'Dirección Regional 11 de Educación');
        $sheet->getStyle('B2')->getFont()->setBold(true)->setSize(16);
        $sheet->setCellValue('B3', 'Solicitudes de Pensiones');
        $sheet->getStyle('B3')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A5', 'Numero');

		$sheet->setCellValue('B5', 'Nombre');

		$sheet->setCellValue('C5', 'Apellido');

		$sheet->setCellValue('D5', 'Cedula');

		$sheet->setCellValue('E5', 'Telefono');

        $sheet->setCellValue('F5', 'Distrito');

        $sheet->setCellValue('G5', 'Centro Educativo');

        $sheet->setCellValue('H5', 'Area');

        $sheet->setCellValue('I5', 'Puesto');
        
        $count = 6;
        $num=1;
		foreach($data as $row)
		{
            $sheet->setCellValue('A' . $count, $num);
			$sheet->setCellValue('B' . $count, $row['nombre']);

			$sheet->setCellValue('C' . $count, $row['apellido']);

			$sheet->setCellValue('D' . $count, $row['cedula']);

			$sheet->setCellValue('E' . $count, $row['telefono']);

            $sheet->setCellValue('F' . $count, $row['distrito']);

            $sheet->setCellValue('G' . $count, $row['centro_educativo']);

            $sheet->setCellValue('H' . $count, $row['area']);

            $sheet->setCellValue('I' . $count, $row['puesto']);

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

    public function getDistrito($id){
        switch ($id) {
            case '11-01':
                return "11-01 de Sosua";
                break;
            case '11-02':
                return "11-02 de Puerto Plata";
                break;
            case '11-03':
                return "11-03 de Imbert";
                break;
            case '11-04':
                return "11-04 de Luperon";
                break;
            case '11-05':
                return "11-05 de Altamira";
                break;
            case '11-06':
                return "11-06 de Mamey - Guananico";
                break;
            case '11-07':
                return "11-07 de Villa Isabela";
                break;
        }
    }

    public function oficioPension($codigo){
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord -> getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Oficio Solicitud de Pension");
        $propiedades -> setDescription("Solicitudes de Pensiones y Jubilaciones");
        $propiedades -> setCategory("Reportes");
        $propiedades -> setSubject("asunto");
        $propiedades -> setKeywords("documento, php, word");

        $model = new Pension_Model();
        $datos = $model->where('idpension', $codigo)->first();
        $distrito = $this->getDistrito($datos['distrito']);

        $section = $phpWord->addSection();

        $phpWord->addParagraphStyle('pStylerRight', array('align' => 'right'));
        $phpWord->addParagraphStyle('pStylerLeft', array('align' => 'left'));
        $phpWord->addParagraphStyle('pStylerCenter', array('align' => 'center'));

        $titulo = ["name" => "TIMES NEW ROMAN", "size" => 14, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
        $fuenteb = ["name" => "TIMES NEW ROMAN", "size" => 12, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];

        $fuente = ["name" => "TIMES NEW ROMAN", "size" => 12, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0, 'align' =>'center' ];
        $section->addImage(
            base_url('public/assets/img/logo2.jpg'),
            [
                'width'         => 100,
                'height'        => 75,
                'marginTop'     => -1,
                'marginLeft'    => -1,
                'wrappingStyle' => 'behind',
                'align'         => 'center'
            ]
        );
        $section->addText(htmlspecialchars('Dirección Regional de Educación 11 de Puerto Plata'),$titulo,['align'=>'center']);
        $textrun =$section->addTextRun('pStylerRight');
        $textrun->addText(htmlspecialchars('San Felipe de Puerto Plata, Rep. Dom'),$fuenteb,['align'=>'right']);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('30 de Octubre de 2023'),$fuenteb,['align'=>'right']);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('Oficio No. 2023-304 RRHH'),$fuenteb,['align'=>'right']);

        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('Al                                                     :Lic. Willian Rodriguez Quiñones'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Director General de Recursos Humanos'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        MINERD, Santo Domingo, D.N.'),$fuente);



        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('Via                                                   :Lic. Welinton Rafael Mejía'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Departamento de Pensión y Jubilación'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        MINERD, Santo Domingo, D.N.'),$fuente);


        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('Asunto                                              :Remisión solicitud Jubilación por antiguedad de la'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Docente Rosa Lesbia Ossers Cabrera'),$fuente);


        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('Anexo                                                :Oficio del distrito educativo.'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Foto 2x2.'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Certificación de Cargos de Contraloria.'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Carta de solicitud de jubilación.'),$fuente);
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('                                                        Copia de cédula.'),$fuente);
        $textrun->addTextBreak();


        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('                                                     Muy respetuosamente, me dirijo a ese superior despacho, '),$fuente);
        $textrun->addText(htmlspecialchars('para remitirles la solicitud de Jubilación por antiguedad en el servicio del docente Licdo. '),$fuente);
        $textrun->addText(htmlspecialchars($datos['nombre'].' '. $datos['apellido'].'., cédula de identidad No.'.$datos['cedula'].' de la Dirección Distrital '),$fuente);
        $textrun->addText(htmlspecialchars($distrito.'.'),$fuente);

        $textrun =$section->addTextRun('pStylerLeft');
        $textrun->addText(htmlspecialchars('                                                     El servidor público cumple con 25 años en servicio y 55 años de edad, '),$fuente);
        $textrun->addText(htmlspecialchars('por lo que le solicita su jubilación conforme lo establecido por el Art. 11 de la Ley 451-08, que indica un 90% de su sueldo '),$fuente);
        $textrun->addText(htmlspecialchars('en la referida escala de salario.'),$fuente);
        $textrun->addTextBreak();

        $textrun =$section->addTextRun('pStylerCenter');
        $textrun->addText(htmlspecialchars('Atentamente'));
        $textrun->addTextBreak();

        $textrun =$section->addTextRun('pStylerCenter');
        $textrun->addText(htmlspecialchars('Leonidas Payamps Cruz, M.A.'));
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('Directora Regional de Educación 11'));
        $textrun->addTextBreak();
        $textrun->addText(htmlspecialchars('Puerto Plata'));

        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        $phpWord -> getSettings() -> setThemeFontLang(new Language(Language::ES_ES));

        $file = 'Relacion de solicitudes de pensiones y jubilaciones.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");

    }

    
}