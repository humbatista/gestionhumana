<?php 
namespace Modules\Solicitudes\Controllers;



use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Exclusion_Model;

class Exclusion extends Controller{

    public function index(){
        $model = new Exclusion_Model();
        $data['exclusion'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\exclusion_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function admin(){
        $model = new Exclusion_Model();
        $data['exclusion'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\exclusion_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function save()
    {
        $time = $myTime = new Time('now');
        $model = new exclusion_Model();
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'cedula' => $this->request->getPost('cedula'),
            'telefono' => $this-> request->getPost('telefono'),
            'nombre_dependiente' => $this-> request->getPost('nombre_dependiente'),
            'cedula_dependiente' => $this-> request->getPost('cedula_dependiente'),
            'relacion' => $this-> request->getPost('relacion'),
            'nombre_dependiente1' => $this-> request->getPost('nombre_dependiente1'),
            'cedula_dependiente1' => $this-> request->getPost('cedula_dependiente1'),
            'relacion1' => $this-> request->getPost('relacion1'),
            'observacion' => $this->request->getPost('observacion'),
            'usuario' => session('usuario'),
            'distrito' => session('distrito'),
            'fecha'        => $time,
            'activa' => 'SI',
        );
        $model->saveExclusion($data);

        if (session('type')=='A')
            return redirect()->to('solicitud/admin/exclusion');
        else return redirect()->to('solicitud/exclusion');
    }
 
    public function update()
    {
        $model = new Exclusion_Model();
        $id = $this->request->getPost('idexclusion');
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'cedula' => $this->request->getPost('cedula'),
            'telefono' => $this-> request->getPost('telefono'),
            'nombre_dependiente' => $this-> request->getPost('nombre_dependiente'),
            'cedula_dependiente' => $this-> request->getPost('cedula_dependiente'),
            'relacion' => $this-> request->getPost('relacion'),
            'nombre_dependiente1' => $this-> request->getPost('nombre_dependiente1'),
            'cedula_dependiente1' => $this-> request->getPost('cedula_dependiente1'),
            'relacion1' => $this-> request->getPost('relacion1'),
            'observacion' => $this->request->getPost('observacion'),
        );
        $model->updateExclusion($data, $id);
        return redirect()->to('solicitud/exclusion');
    }
 
    public function delete()
    {
        $model = new Exclusion_Model();
        $id = $this->request->getPost('idexclusion');
        $data = [
            'activa' => 'NO',
        ];
        $model->update($id, $data);
        return redirect()->to('solicitud/exclusion');
    }

   
    public function export(){
        $model = new Exclusion_Model();
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
        $section->addText(htmlspecialchars('Relación de reportes de Exclusion de Beneficiario'),$fuenteb,['align'=>'center']);
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
        $cell5->addText(htmlspecialchars("Nombre Dependiente"));
        $cell6 = $table->addCell();
        $cell6->addText(htmlspecialchars("Cedula Dependiente"));
        $cell7 = $table->addCell();
        $cell7->addText(htmlspecialchars("Telefono"));
        $cell8 = $table->addCell();
        $cell8->addText(htmlspecialchars("Observacion"));

        
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
                $cell5->addText(htmlspecialchars($row->nombre_dependiente. ' - ' .$row->nombre_dependiente1));
                $cell6 = $table->addCell();
                $cell6->addText(htmlspecialchars($row->cedula_dependiente. ' - ' .$row->cedula_dependiente1));
                $cell7 = $table->addCell();
                $cell7->addText(htmlspecialchars($row->telefono));
                $cell8 = $table->addCell();
                $cell8->addText(htmlspecialchars($row->observacion));
            }
        }
        $section->addTextBreak();
        //$section->addText(htmlspecialchars('Total de visitas durante el periodo: '. $total),$fuenteb);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        //$phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Relacion Solicitudes de Exclusión Beneficiarios.docx';
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