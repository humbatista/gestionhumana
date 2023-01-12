<?php 
namespace Modules\Solicitudes\Controllers;



use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Licencia_Model;
use Modules\Solicitudes\Models\Escuela_Model;
use Modules\Solicitudes\Models\Tipo_Licencia_Model;
use PhpOffice\PhpWord\Style\Language;
class Licencia extends Controller{

    public function index(){
        $model = new Licencia_Model();
        $centro = new Escuela_Model();
        $tipo = new Tipo_Licencia_Model();
        $data['tipo'] = $tipo->findAll();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['licencia'] = $model->where('distrito', session('distrito'))
                                ->where('activa', 'SI')
                                ->Where('status !=', 'Aprobada')
                                ->findAll();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\licencia_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }
    public function admin(){
        $model = new Licencia_Model();
        $centro = new Escuela_Model();
        $tipo = new Tipo_Licencia_Model();
        $data['tipo'] = $tipo->findAll();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['licencia'] = $model->where('distrito', session('distrito'))
                                    ->where('activa','SI')
                                    ->Where('status !=', 'Aprobada')
                                  ->findAll();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\licencia_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function save()
    {
        $time = $myTime = new Time('now');
        $model = new Licencia_Model();
        $data = array(
            'nombres' => $this->request->getPost('nombres'),
            'cedula' => $this->request->getPost('cedula'),
            'tipo_licencia' => $this->request->getPost('tipo'),
            'dias' => $this-> request->getPost('dias'),
            'fechaini' => $this-> request->getPost('fechaini'),
            'fechafin' => $this-> request->getPost('fechafin'),
            'centro_educativo' => $this-> request->getPost('search'),
            'nombre_suplente' => $this->request->getPost('nombre_suplente'),
            'cedula_suplente' => $this->request->getPost('cedula_suplente'),
            'cargo' => $this->request->getPost('cargo'),
            'usuario' => session('usuario'),
            'distrito' => session('distrito'),
            'fecha'        => $time,
            'activa' => 'SI',
        );
        $model->save($data);
        
        
        if (session('type')=='A')
            return redirect()->to('solicitud/admin/licencia');
        else return redirect()->to('solicitud/licencia');
    }
 
    public function update()
    {
        $time = $myTime = new Time('now');
        $model = new Licencia_Model();
        $id = $this->request->getPost('id');
        $data = array(
            'nombres' => $this->request->getPost('nombres'),
            'cedula' => $this->request->getPost('cedula'),
            'tipo_de_licencia' => $this->request->getPost('tipo_licencia'),
            'dias' => $this-> request->getPost('dias'),
            'fechaini' => $this-> request->getPost('fechaini'),
            'fechafin' => $this-> request->getPost('fechafin'),
            'centro_educativo' => $this-> request->getPost('centro'),
            'nombre_suplente' => $this->request->getPost('nombre_suplente'),
            'cedula_suplente' => $this->request->getPost('cedula_suplente'),
            'modificado' => session('usuario'),
            'fecmodificado' => $time,
        );
        $model->update($id, $data);
        return redirect()->to('solicitud/licencia');
    }
 
    public function delete()
    {
        $model = new Licencia_Model();
        $id = $this->request->getPost('id');
        $data = [
            'activa' => 'NO',
        ];
        $model->update($id, $data);
        return redirect()->to('solicitud/licencia');
    }

    
    public function export(){
        $model = new Licencia_Model();
        $record = $model->getReporte(session('distrito'))->getResult();
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
                $cell4->addText(htmlspecialchars($row->descripcion));
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
        $record = $model->getReporteMaternidad(session('distrito'))->getResult();
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
                $cell4->addText(htmlspecialchars($row->descripcion));
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
}