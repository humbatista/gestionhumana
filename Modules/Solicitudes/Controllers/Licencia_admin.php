<?php 
namespace Modules\Solicitudes\Controllers;

use App\Controllers\BaseController;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Licencia_Model;
use Modules\Solicitudes\Models\Observacion_Model;
use phpOffice\PhpWord\Style\Language;

class Licencia_admin extends Controller{

    public function loadRecord(){
        $request = service('request');
        $searchData= $request->getGet();

        $search="";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }

        $distrito="";
        if (isset($searchData) && isset($searchData['distrito'])) {
            $distrito = $searchData['distrito'];
        }

        //obtener los datos

        $users = new Licencia_Model();
 
        if ($search=='') {
            $paginateData = $users->where(['status !=' => 'Aprobada'])
                ->where(['distrito' => $distrito])
                ->paginate(10);
        } else {
            $paginateData = $users->select('*')
                ->orlike('distrito', $search)
                ->orlike('nombres', $search)
                ->orlike('cedula', $search)
                ->paginate(10);
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
        echo view('Modules\Solicitudes\Views\admin\licencia_admin_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function export(){
        $model = new Licencia_Model();
        $record = $model->getLicenciaActivas()->getResult();
        //$total = $model->countAll();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord -> getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Reporte Gestión Humana");
        $propiedades -> setDescription("Solicitudes de Exclusion de Beneficiario");
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
        $section->addText(htmlspecialchars('Remision de solicitudes y licencias'),$fuenteb,['align'=>'center']);
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
        $cell2->addText(htmlspecialchars("Nombre"));
        $cell3 = $table->addCell();
        $cell3->addText(htmlspecialchars("Cedula"));
        $cell4 = $table->addCell();
        $cell4->addText(htmlspecialchars("Tipo de Licencia"));
        $cell5 = $table->addCell();
        $cell5->addText(htmlspecialchars("Dias"));
        $cell6 = $table->addCell();
        $cell6->addText(htmlspecialchars("Fecha Inicio Licencia"));

        
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $table->addRow();
                $cell1 = $table->addCell();
                $cell1->addText(htmlspecialchars($row->distrito));
                $cell2 = $table->addCell();
                $cell2->addText(htmlspecialchars($row->nombres));
                $cell3 = $table->addCell();
                $cell3->addText(htmlspecialchars($row->cedula));
                $cell4 = $table->addCell();
                $cell4->addText(htmlspecialchars($row->tipo_licencia));
                $cell5 = $table->addCell();
                $cell5->addText(htmlspecialchars($row->dias));
                $cell7 = $table->addCell();
                $cell7->addText(htmlspecialchars($row->fechaini));
            }
        }
        $section->addTextBreak();
        //$section->addText(htmlspecialchars('Total de visitas durante el periodo: '. $total),$fuenteb);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Remision de licencias.docx';
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

    public function export_maternidad(){
        $model = new Licencia_Model();
        $record = $model->getLicenciamaternidad()->getResult();
        //$total = $model->countAll();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord -> getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Reporte Gestión Humana");
        $propiedades -> setDescription("Solicitudes de Exclusion de Beneficiario");
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
        $section->addText(htmlspecialchars('Remision de solicitudes y licencias'),$fuenteb,['align'=>'center']);
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
        $cell2->addText(htmlspecialchars("Nombre"));
        $cell3 = $table->addCell();
        $cell3->addText(htmlspecialchars("Cedula"));
        $cell4 = $table->addCell();
        $cell4->addText(htmlspecialchars("Tipo de Licencia"));
        $cell5 = $table->addCell();
        $cell5->addText(htmlspecialchars("Dias"));
        $cell6 = $table->addCell();
        $cell6->addText(htmlspecialchars("Fecha Inicio Licencia"));

        
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $table->addRow();
                $cell1 = $table->addCell();
                $cell1->addText(htmlspecialchars($row->distrito));
                $cell2 = $table->addCell();
                $cell2->addText(htmlspecialchars($row->nombres));
                $cell3 = $table->addCell();
                $cell3->addText(htmlspecialchars($row->cedula));
                $cell4 = $table->addCell();
                $cell4->addText(htmlspecialchars($row->tipo_licencia));
                $cell5 = $table->addCell();
                $cell5->addText(htmlspecialchars($row->dias));
                $cell7 = $table->addCell();
                $cell7->addText(htmlspecialchars($row->fechaini));
            }
        }
        $section->addTextBreak();
        //$section->addText(htmlspecialchars('Total de visitas durante el periodo: '. $total),$fuenteb);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Remision de licencias.docx';
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

    public function obssave(){
        $time = new Time('now');
        $model = new Observacion_Model();
        $data = [
            'idsolicitud' => $this->request->getPost('id'),
            'tipo'        => 'Licencia',
            'fecha'       => $time,
            'observacion' => $this->request->getPost('observaciones'),
            'usuario'     =>   session('usuario'),
        ];
        $model->insert($data);
        return redirect()->to('solicitu/admin/admlicencia');
    }

    public function aprobar(){
        $model = new Licencia_Model();
        $id = $this->request->getPost('valor');
        $model->aprobar($id);
    }

    public function aceptar(){
        $model = new Licencia_Model();
        $id = $this->request->getPost('id');
        $model->aceptar($id);
    }

    public function devolver(){
        $model = new Licencia_Model();
        $id = $this->request->getPost('id');
        $model->devolver($id);
    }

    public function rechazar(){
        $model = new Licencia_Model();
        $id = $this->request->getPost('id');
        $model->rechazar($id);
    }

}