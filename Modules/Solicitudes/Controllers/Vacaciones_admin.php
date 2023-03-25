<?php
namespace Modules\Solicitudes\Controllers;

use CodeIgniter\Controller;
use Modules\Solicitudes\Models\Vacaciones_Model;

class Vacaciones_admin extends Controller{
    public function loadRecord(){
        try {
            //echo('hola');
            $request = service('request');
            $searchData= $request->getGet();

            $search="";
            if (isset($searchData) && isset($searchData['search'])) {
                $search = $searchData['search'];
            }

            //obtener los datos

            $users = new Vacaciones_Model();
    
            if ($search=='') {
                $paginateData = $users->where(['status !=' => 'Aprobada'])
                    ->paginate(5);
            } else {
                $paginateData = $users->select('*')
                    ->orlike('distrito', $search)
                    ->orlike('empleado', $search)
                    //->orlike('apellido', $search)
                    ->orlike('cedula', $search)
                    ->paginate(5);
            }

            $data = [
                'users' => $paginateData,
                'pager' => $users->pager,
                'search' => $search
            ];
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\admin\vacacion_admin', $data);
            echo view('Modules\Solicitudes\Views\header\footer');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //estas funciones sirven para cambiar el status de las vacaciones 
    // hay 4 funciones que son aprobar, aceptar, devolver y rechazar

    public function aprobar(){
        try {
            //code...
            $model = new Vacaciones_Model();
            $id = $this->request->getPost('valor');
            $model->aprobar($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function aceptar(){
        try {
            //code...
            $model = new Vacaciones_Model();
            $id = $this->request->getPost('id');
            $model->aceptar($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function devolver(){
        try {
            //code...
            $model = new Vacaciones_Model();
            $id = $this->request->getPost('id');
            $model->devolver($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function rechazar(){
        try {
            //code...
            $model = new Vacaciones_Model();
            $id = $this->request->getPost('id');
            $model->rechazar($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }


    public function export(){
        try {
            //code...
            $model = new Vacaciones_Model();
            $record = $model->getVacacionesActivas()->getResult();
            //$total = $model->countAll();
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $propiedades = $phpWord->getDocInfo();
            $propiedades -> setCreator("www.regional11.gob.do");
            $propiedades -> setCompany("Regional 11 de Educación");
            $propiedades -> setTitle("Reporte Gestión Humana");
            $propiedades -> setDescription("Solicitudes de Vacaciones");
            $propiedades -> setCategory("Reportes");
            $propiedades -> setSubject("asunto");
            $propiedades -> setKeywords("documento, php, word");

            $section = $phpWord->addSection();


            $titulo = ["name" => "Arial", "size" => 14, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
            $fuenteb = ["name" => "Arial", "size" => 12, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];

            $fuente = ["name" => "Arial", "size" => 10, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0, 'align' =>'center' ];
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
            $section->addText(htmlspecialchars('DIRECCION REGIONAL 11 DE EDUCACION'),$titulo,['align'=>'center']);
            $section->addText(htmlspecialchars('Remision de solicitudes de vacaciones'),$fuenteb,['align'=>'center']);
            $tableStyle = array(
                'borderColor' => '006699',
                'borderSize'  => 6,
                'cellMargin'  => 50,
                'align'       => 'center'
            );
            $firstRowStyle = array('bgColor' => '66BBFF');
            $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
            $table = $section->addTable('myTable');
            $table->addRow();
            $cell1 = $table->addCell();
            $cell1->addText(htmlspecialchars("Distrito"));
            $cell2 = $table->addCell();
            $cell2->addText(htmlspecialchars("Empleado"));
            $cell3 = $table->addCell();
            $cell3->addText(htmlspecialchars("Cedula"));
            $cell4 = $table->addCell();
            $cell4->addText(htmlspecialchars("Inicio"));
            $cell5 = $table->addCell();
            $cell5->addText(htmlspecialchars("Final"));

            
            if(count($record)>0)
            {
                foreach ($record as $row) {
                    $table->addRow();
                    $cell1 = $table->addCell();
                    $cell1->addText(htmlspecialchars($row->distrito));
                    $cell2 = $table->addCell();
                    $cell2->addText(htmlspecialchars($row->empleado));
                    $cell3 = $table->addCell();
                    $cell3->addText(htmlspecialchars($row->cedula));
                    $cell4 = $table->addCell();
                    $cell4->addText(htmlspecialchars($row->fecha_inicio));
                    $cell5 = $table->addCell();
                    $cell5->addText(htmlspecialchars($row->fecha_fin));
                }
            }
            $section->addTextBreak();
            $section->addText(htmlspecialchars('Preparado por: '. session('nombre')),$fuente,['align'=>'right']);
            $section->addTextBreak();
            $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
            $phpWord -> getCompatibility() -> setOoxmlVersion(12);
            //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

            $file = 'Relacion Vacaciones Solicitadas.docx';
            ob_clean(); //Emptying the cache
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename="' . $file . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $xmlWriter->save('php://output');
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
	}

}