<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use phpOffice\PhpWord\Style\Language;
use Modules\Solicitudes\Models\Inclusion_Model;
use Modules\Solicitudes\Models\Observacion_Model;

class Inclusion_admin extends Controller{
    public function loadRecord(){
        $request = service('request');
        $searchData= $request->getGet();

        $search="";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }

        //obtener los datos

        $users = new Inclusion_Model();
 
        if ($search=='') {
            $paginateData = $users->where(['status !=' => 'Aprobada'])
                ->paginate(5);
        } else {
            $paginateData = $users->select('*')
                ->orlike('distrito', $search)
                ->orlike('nombre', $search)
                ->orlike('apellido', $search)
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
        echo view('Modules\Solicitudes\Views\admin\inclusion_admin_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function export(){
        $model = new Inclusion_Model();
        $record = $model->getInclusionActivas()->getResult();
        //$total = $model->countAll();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord->getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Reporte Gestión Humana");
        $propiedades -> setDescription("Solicitudes de Inclusion de Beneficiario");
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
        $section->addText(htmlspecialchars('Remision de inclusiones del seguro'),$fuenteb,['align'=>'center']);
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
        $cell3->addText(htmlspecialchars("Apellido"));
        $cell4 = $table->addCell();
        $cell4->addText(htmlspecialchars("Cedula"));
        $cell5 = $table->addCell();
        $cell5->addText(htmlspecialchars("Telefono"));

        
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $table->addRow();
                $cell1 = $table->addCell();
                $cell1->addText(htmlspecialchars($row->distrito));
                $cell2 = $table->addCell();
                $cell2->addText(htmlspecialchars($row->nombre));
                $cell3 = $table->addCell();
                $cell3->addText(htmlspecialchars($row->apellido));
                $cell4 = $table->addCell();
                $cell4->addText(htmlspecialchars($row->cedula));
                $cell5 = $table->addCell();
                $cell5->addText(htmlspecialchars($row->telefono));
            }
        }
        $section->addTextBreak();
        //$section->addText(htmlspecialchars('Total de visitas durante el periodo: '. $total),$fuenteb);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Relacion Solicitudes de Inclusion Beneficiarios.docx';
        //$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        //$xmlWriter->save("php://output");
        ob_clean(); //Emptying the cache
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        //header("Content-Disposition: attachment; filename=ejemplo.docx");
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save('php://output');
        //$xmlWriter->save($file);
        //$xmlWriter->save( base_url() . 'php://output' );

        //return 0;
        exit;
	}

    
    public function obssave(){
        $time = new Time('now');
        $model = new Observacion_Model();
        $data = [
            'idsolicitud' => $this->request->getPost('idinclusion'),
            'tipo'        => 'Inclusion',
            'fecha'       => $time,
            'observacion' => $this->request->getPost('observaciones'),
            'usuario'     =>   session('usuario'),
        ];
        $model->insert($data);
        return redirect()->to('solicitud/admin/adminclusion');
    }

    public function aprobar(){
        $model = new Inclusion_Model();
        $id = $this->request->getPost('valor');
        $model->aprobar($id);
    }

    public function aceptar(){
        $model = new Inclusion_Model();
        $id = $this->request->getPost('id');
        $model->aceptar($id);
    }

    public function devolver(){
        $model = new Inclusion_Model();
        $id = $this->request->getPost('id');
        $model->devolver($id);
    }

    public function rechazar(){
        $model = new Inclusion_Model();
        $id = $this->request->getPost('id');
        $model->rechazar($id);
    }
}