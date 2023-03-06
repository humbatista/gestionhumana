<?php 
namespace Modules\Solicitudes\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Pension_Model;
use Modules\Solicitudes\Models\Escuela_Model;
use Modules\Solicitudes\Models\Area_Model;
use PhpOffice\PhpWord\Style\Language;

class Pension extends Controller{
    public function index(){
        $model = new Pension_Model();
        $centro = new Escuela_Model();
        $area = new Area_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['area']  = $area->getArea()->getResult();
        $data['pension'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\pension_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }
    public function admin(){
        $model = new Pension_Model();
        $centro = new Escuela_Model();
        $area = new Area_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['area']  = $area->getArea()->getResult();
        $data['pension'] = $model->getbyDistrito(session('distrito'))->getResult();
        //$data['pension'] = $model->getPension()->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\pension_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function save()
    {
        $time = new Time('now');
        $model = new Pension_Model();
        $data = array(
            'fecha_solicitud'        => $time,
            'nombre' => $this->request->getPost('nombre1'),
            'apellido' => $this->request->getPost('apellido1'),
            'cedula' => $this->request->getPost('cedula'),
            'anio_inicio' => $this->request->getPost('anio_inicio'),
            'telefono' => $this-> request->getPost('telefono'),
            'celular' => $this-> request->getPost('celular'),
            'centro_educativo' => $this-> request->getPost('search'),
            'puesto' => $this-> request->getPost('puesto'),
            'area' => $this-> request->getPost('area'),
            'usuario' => session('usuario'),
            'distrito' => session('distrito'),
            'activa' => 'SI',
        ); 
        $model->savePension($data);

        if (session('type')=='A')
            return redirect()->to('solicitud/admin/pension');
        else return redirect()->to('solicitud/pension');
    }
 
    public function update()
    {
        $model = new Pension_Model();
        $id = $this->request->getPost('idpension');
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'cedula' => $this->request->getPost('cedula'),
            'anio_inicio' => $this->request->getPost('anio_inicio'),
            'telefono' => $this-> request->getPost('telefono'),
            'celular' => $this-> request->getPost('celular'),
            'centro_educativo' => $this-> request->getPost('search'),
            'puesto' => $this-> request->getPost('puesto'),
            'area' => $this-> request->getPost('area'),
        );
        $model->updatePension($data, $id);
        return redirect()->to('solicitud/pension');
    }
 
    public function delete()
    {
        $model = new Pension_Model();
        $id = $this->request->getPost('idpension');
        $data = [
            'activa' => 'NO',
        ];
        $model->update($id, $data);
        return redirect()->to('/pension');
    }

   

    public function export(){
        $model = new Pension_Model();
        $record = $model->getReporte(session('distrito'))->getResult();
        //$total = $model->countAll();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $phpWord -> getDocInfo();
        $propiedades -> setCreator("www.regional11.gob.do");
        $propiedades -> setCompany("Regional 11 de Educación");
        $propiedades -> setTitle("Reporte Gestión Humana");
        $propiedades -> setDescription("Solicitudes de Pensiones y Jubilaciones");
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
        $section->addText(htmlspecialchars('Relación de Solicitudes de pensiones y jubilaciones'),$fuenteb,['align'=>'center']);
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
        $section->addText(htmlspecialchars('Preparado por: '. session('nombre')),$fuente,['align'=>'right']);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        $phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Relacion de solicitudes de pensiones y jubilaciones.docx';
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