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
    
    public function certificado(){
        setlocale(LC_ALL,"es_DO");
        $model = new Empleados_Model();
        $id = $this->request->getGet('id');
        //$id = 3;
        $record = $model->certificado($id)->getResult();
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $nombre = $row->nombre;
                $cedula = $row->cedula;
                $fechaini = $this->fechaEs($row->fecingreso);
                $puesto = $row->cargo;
                $sueldo = number_format($row->sueldo,2);
                $dia = date("d");
                $mes = $this->meses();
                $anio = date("Y");
                $oficina = $row->unidad;
                $sexo = $row->sexo;
            }
        }
        // valores de pruebas
        // $nombre = "Humberto Francisco Batista Santos";
        // $cedula = "037-0066654-2";
        // $fechaini = $this->fechaEs("01/02/2015");
        // $puesto = "Tecnico Docente Interino";
        // $sueldo = number_format('20000',2);
        // //$formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        // //$dia_letra = $formatterES->format(123.45);
        // $dia = date("d");
        // $mes = $this->meses();
        // $anio = date("Y");
        // $oficina = "Dirección Regional 11 de Educación";
        //fin de los valores de prueba
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord -> getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Certificación Laboral");
        $propiedades -> setDescription("Certificación laborales expedidos a empleados");
        $propiedades -> setCategory("Certificaciones");
        $propiedades -> setSubject("asunto");
        $propiedades -> setKeywords("documento, php, word");

        $section = $phpWord->addSection();


        $titulo = ["name" => "times new roman", "size" => 14, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
        $fuenteb = ["name" => "times new roman", "size" => 14, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
        $fuentec = ["name" => "times new roman", "size" => 14, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
        $fuenteu = ["name" => "times new roman", "size" => 14, "color" => "000000", "italic" => false, "bold" => true, 'underline' => 'single', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];

        $fuente = ["name" => "times new roman", "size" => 10, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0, 'align' =>'center' ];
        $section->addImage(
            base_url('public/assets/img/logo5.png'),
            [
                'width'         => 125,
                'height'        => 100,
                'marginTop'     => -1,
                'marginLeft'    => -1,
                'wrappingStyle' => 'behind',
                'align'         => 'center',
                'spacing'       => 0,
            ]
        );
        $section->addText(htmlspecialchars('Regional de Educación 11, Puerto Plata'),$titulo,['align'=>'center']);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('CERTIFICACIÓN LABORAL'),$titulo,['align'=>'center']);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('A QUIEN PUEDA INTERESAR'),$titulo,['align'=>'center']);
        $section->addTextBreak();
        
        
        $textRun = $section->addTextRun();
        $textRun->addText(('Por medio de la presente certificación hacemos constar que '),$fuenteb);
        $textRun->addText(($nombre),$fuentec);
        $textRun->addText((', '),$fuenteb);
        $textRun->addText(($this->sex_nacionalidad($sexo)),$fuenteb);
        $textRun->addText((', mayor de edad, '),$fuenteb);
        $textRun->addText(($this->sex_portador($sexo)),$fuenteb);
        $textRun->addText((' de la cédula de identificación y electoral No. '),$fuenteb);
        $textRun->addText(($cedula),$fuentec);
        $textRun->addText((', presta servicio en el Ministerio de Educación desde el '),$fuenteb);
        $textRun->addText(($fechaini.'.'),$fuentec);
        $section->addTextBreak();
        
        $textRun = $section->addTextRun();
        $textRun->addText(('Actualmente desempeña la función de '),$fuenteb);
        $textRun->addText($puesto, $fuentec);
        $textRun->addText((', en esta '),$fuenteb);
        $textRun->addText(($oficina),$fuentec);
        $textRun->addText((', dependencia del Ministerio de Educación, devengando un sueldo de RD$ '),$fuenteb);
        $textRun->addText(($sueldo.'.'),$fuentec);
        $section->addTextBreak();

        $textRun = $section->addTextRun();
        $textRun->addText('Se expide la presente certificación a solicitud de la parte interesada en Puerto Plata, República Dominicana, a los (', $fuenteb);
        $textRun->addText($dia, $fuentec);
        $textRun->addText(') días del mes de ', $fuenteb);
        $textRun->addText($mes,$fuentec);
        $textRun->addText(' del año ', $fuenteb);
        $textRun->addText($anio.'.',$fuentec);
        $section->addTextBreak();

        $section->addText(htmlspecialchars('Leonidas Payamps Cruz, M.A.'),$fuenteu,['align'=>'center']);
        $section->addText(htmlspecialchars('Directora Regional de Educación 11'),$fuenteb,['align'=>'center']);
        $section->addText(htmlspecialchars('Puerto Plata'),$fuenteb,['align'=>'center']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Certificación Laboral.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");

        exit;
	}
    // funcion mes
    /* function mes($num){
        switch($num){
            case 1:
                $nombre_mes = "enero";
                break;
            case 2:
                $nombre_mes = "febrero";
                break;
            case 3:
                $nombre_mes = "marzo";
                break;
            case 4:
                $nombre_mes = "abril";
                break;
            case 5:
                $nombre_mes = "mayo";
                break;
            case 6:
                $nombre_mes = "junio";
                break;
            case 7:
                $nombre_mes = "julio";
                break;
            case 8:
                $nombre_mes = "agosto";
                break;
            case 9:
                $nombre_mes = "septiembre";
                break;
            case 10:
                $nombre_mes = "octubre";
                break;
            case 11:
                $nombre_mes = "noviembre";
                break;
            case 12:
                $nombre_mes = "diciembre";
                break;
        }
        return $nombre_mes;
    } */
    function meses(){
        $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        return $meses[date('n')-1];
    }
    function fechaEs($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
        }
    function sex_nacionalidad($sexo){
        if ($sexo=='M'):
            $nacionalidad = 'dominicano';
        else: $nacionalidad = 'dominicana';
        endif;
        return $nacionalidad;
    }
    
    function sex_portador($sexo){
        if ($sexo=='M'):
            $portador = 'portador';
        else: $portador = 'portadora';
        endif;
        return $portador;
    }    
}
