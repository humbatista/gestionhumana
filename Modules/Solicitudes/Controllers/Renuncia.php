<?php 
namespace Modules\Solicitudes\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Escuela_Model;
use Modules\Solicitudes\Models\Renuncia_Model;
use Modules\Solicitudes\Models\Area_Model;
use PhpOffice\PhpWord\Style\Language;

class Renuncia extends Controller{
    public function index(){
        $model = new Renuncia_Model();
        $centro = new Escuela_Model();
        $area = new Area_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['area'] = $area->getArea()->getResult();
        $data['renuncia'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\renuncia_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function admin(){
        $model = new Renuncia_Model();
        $centro = new Escuela_Model();
        $area = new Area_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['area'] = $area->getArea()->getResult();
        $data['renuncia'] = $model->getbyDistrito(session('distrito'))->getResult();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\renuncia_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function save()
    {
        $time = new Time('now');
        $model = new Renuncia_Model();
        $data = array(
            'tipo'      => $this->request->getPost('tipo'),
            'fecha'        => $time,
            'fecha_renuncia' => $this->request->getPost('fecha_renuncia'),
            'nombre' => $this->request->getPost('nombre'),
            'cedula' => $this->request->getPost('cedula'),
            'telefono' => $this->request->getPost('telefono'),
            'lugar' => $this-> request->getPost('lugar'),
            'centro_educativo' => $this-> request->getPost('search'),
            'puesto' => $this-> request->getPost('puesto'),
            'area' => $this-> request->getPost('area'),
            'usuario' => session('usuario'),
            'distrito' => session('distrito'),
            'activa' =>'SI',
        );
        //$model->save($data);
        $model->saveRenuncia($data);

        if (session('type')=='A')
            return redirect()->to('solicitud/admin/renuncia');
        else return redirect()->to('solicitud/renuncia');
    }
 
    public function update()
    {
        $model = new Renuncia_Model();
        $id = $this->request->getPost('idrenuncia');
        $data = array(
            'fecha_renuncia' => $this->request->getPost('fecha_renuncia'),
            'nombre' => $this->request->getPost('nombre'),
            'cedula' => $this->request->getPost('cedula'),
            'telefono' => $this->request->getPost('telefono'),
            'lugar' => $this-> request->getPost('lugar'),
            'centro_educativo' => $this-> request->getPost('centro'),
            'puesto' => $this-> request->getPost('puesto'),
            'area' => $this-> request->getPost('area'),
        );
        //$model->update($id, $data);
        $model->updateRenuncia($data, $id);
        return redirect()->to('solicitud/renuncia');
    }
 
    public function delete()
    {
        $model = new Renuncia_Model();
        $id = $this->request->getPost('idrenuncia');
        $data = [
            'activa' => 'NO',
        ];
        $model->update($id, $data);
        return redirect()->to('solicitud/renuncia');
    }

    

    public function export(){
        $model = new Renuncia_Model();
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
        $section->addText(htmlspecialchars('Relación de Renuncias y Abandonos Reportados'),$fuenteb,['align'=>'center']);
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
        $cell4->addText(htmlspecialchars("Telefono"));
        $cell5 = $table->addCell();
        $cell5->addText(htmlspecialchars("Fecha"));
        $cell6 = $table->addCell();
        $cell6->addText(htmlspecialchars("Tipo"));

        
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $table->addRow();
                $cell1 = $table->addCell();
                $cell1->addText(htmlspecialchars($row->distrito));
                $cell2 = $table->addCell();
                $cell2->addText(htmlspecialchars($row->nombre));
                $cell3 = $table->addCell();
                $cell3->addText(htmlspecialchars($row->cedula));
                $cell4 = $table->addCell();
                $cell4->addText(htmlspecialchars($row->telefono));
                $cell5 = $table->addCell();
                $cell5->addText(htmlspecialchars($row->fecha_renuncia));
                $cell6 = $table->addCell();
                $cell6->addText(htmlspecialchars($row->tipo));
            }
        }
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Preparado por: '. session('nombre')),$fuente,['align'=>'right']);
        $section->addTextBreak();
        $section->addText(htmlspecialchars('Recibido por:____________________________'),$fuente,['align'=>'right']);
        $phpWord -> getCompatibility() -> setOoxmlVersion(12);
        $phpWord -> getSettings() -> setThemeFontLang(new Language("ES_ES"));

        $file = 'Relacion de renuncias y abandonos.docx';
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