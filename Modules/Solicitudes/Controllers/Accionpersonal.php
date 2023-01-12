<?php 
namespace Modules\Solicitudes\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
//use Modules\Solicitudes\Models\Observacion_Model;
use Modules\Solicitudes\Models\Escuela_Model;
use Modules\Solicitudes\Models\AccionPersonal_Model;
use PhpOffice\PhpWord\Style\Language;

class Accionpersonal extends Controller{
    public function index(){
        $model = new AccionPersonal_Model();
        $centro = new Escuela_Model();
        $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
        $data['accion'] = $model->where('distrito', session('distrito'))
                                ->where('nivel !=', 'A1')
                                ->where('activa','SI')
                                  ->findAll();
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu-horizontal');
        echo view('Modules\Solicitudes\Views\form\accionpersonal_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }

    public function admin(){
        if(session('nivel')=='A1'){
            $model = new AccionPersonal_Model();
            $centro = new Escuela_Model();
            $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
            $data['accion'] = $model->where('distrito', session('distrito'))
                                    ->where('activa', 'SI')
                                    ->findAll();
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\form\accionpersonal_view', $data);
            echo view('Modules\Solicitudes\Views\header\footer');
        }else {
            $model = new AccionPersonal_Model();
            $centro = new Escuela_Model();
            $data['centro'] = $centro->getEscuelaDistrito(session('distrito'))->getResult();
            $data['accion'] = $model->where('distrito', session('distrito'))
                                    ->where('nivel !=','A1')
                                    ->where('activa', 'SI')
                                    ->findAll();
            echo view('Modules\Solicitudes\Views\header\head');
            echo view('Modules\Solicitudes\Views\header\header');
            echo view('Modules\Solicitudes\Views\menu\menu_admin');
            echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
            echo view('Modules\Solicitudes\Views\form\accionpersonal_view', $data);
            echo view('Modules\Solicitudes\Views\header\footer');
        }
    }


    public function save()
    {
        $time = new Time('now');
        $model = new AccionPersonal_Model();
        if (session('nivel')=='A1'){
            $data = array(
                'nombre_recomendado' => $this->request->getPost('nombre'),
                'cedula_recomendado' => $this->request->getPost('cedula'),
                'tipo_accion' => $this->request->getPost('tipo'),
                'centro_educativo' => $this->request->getPost('search'),
                'cargo_actual' => $this-> request->getPost('cargo_actual'),
                'cargo_propuesto' => $this-> request->getPost('cargo_propuesto'),
                'nombre_sustituido' => $this-> request->getPost('nombre_sustituido'),
                'cedula_sustituido' => $this-> request->getPost('cedula_sustituido'),
                'observacion' => $this->request->getPost('observaciones'),
                'nivel' => 'A1',
                'usuario' => session('usuario'),
                'distrito' => session('distrito'),
                'fecha'        => $time,
                'activa'      =>'SI',
            );
            $model->save($data);
            return redirect()->to('solicitud/admin/accion');
        }else {
            $data = array(
                'nombre_recomendado' => $this->request->getPost('nombre'),
                'cedula_recomendado' => $this->request->getPost('cedula'),
                'tipo_accion' => $this->request->getPost('tipo'),
                'centro_educativo' => $this->request->getPost('search'),
                'cargo_actual' => $this-> request->getPost('cargo_actual'),
                'cargo_propuesto' => $this-> request->getPost('cargo_propuesto'),
                'nombre_sustituido' => $this-> request->getPost('nombre_sustituido'),
                'cedula_sustituido' => $this-> request->getPost('cedula_sustituido'),
                'observacion' => $this->request->getPost('observaciones'),
                'usuario' => session('usuario'),
                'distrito' => session('distrito'),
                'fecha'        => $time,
                'activa'      =>'SI',
            );
            $model->save($data);

            if (session('type')=='A')
                return redirect()->to('solicitud/admin/accion');
            else return redirect()->to('solicitud/accionpersonal');
        }
    }
 
    public function update()
    {
        $model = new AccionPersonal_Model();
        $id = $this->request->getPost('id');
        $data = array(
            'nombre_recomendado' => $this->request->getPost('nombre'),
            'cedula_recomendado' => $this->request->getPost('cedula'),
            'tipo_accion' => $this->request->getPost('tipo'),
            'cargo_actual' => $this-> request->getPost('cargo_actual'),
            'cargo_propuesto' => $this-> request->getPost('cargo_propuesto'),
            'nombre_sustituido' => $this-> request->getPost('nombre_sustituido'),
            'cedula_sustituido' => $this-> request->getPost('cedula_sustituido'),
            'observacion' => $this->request->getPost('observacion'),
        );
        $model->update($id, $data);
        return redirect()->to('solicitud/accionpersonal');
    }
 
    public function delete()
    {
        $model = new AccionPersonal_Model();
        $id = $this->request->getPost('id');
        $data = [
            'activa' => 'NO',
        ];
        $model->update($id, $data);
        return redirect()->to('/accionpersonal');
    }

    
    public function export(){
        $model = new AccionPersonal_Model();
        if(session('nivel')=='A1'){
            $record = $model->getReporte_A1(session('distrito'))->getResult();    
        } else {
            $record = $model->getReporte(session('distrito'))->getResult();
        }
        //$record = $model->getReporte(session('distrito'))->getResult();
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
        $section->addText(htmlspecialchars('Reportes de Accion de Personal'),$fuenteb,['align'=>'center']);
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
        $cell4->addText(htmlspecialchars("Tipo"));
        $cell5 = $table->addCell();
        $cell5->addText(htmlspecialchars("Cargo Propuesto"));
        $cell6 = $table->addCell();
        $cell6->addText(htmlspecialchars("Nombre Sustituido"));
        $cell7 = $table->addCell();
        $cell7->addText(htmlspecialchars("Cedula Sustituido"));

        
        if(count($record)>0)
        {
            foreach ($record as $row) {
                $table->addRow();
                $cell1 = $table->addCell();
                $cell1->addText(htmlspecialchars($row->distrito));
                $cell2 = $table->addCell();
                $cell2->addText(htmlspecialchars($row->nombre_recomendado));
                $cell3 = $table->addCell();
                $cell3->addText(htmlspecialchars($row->cedula_recomendado));
                $cell4 = $table->addCell();
                $cell4->addText(htmlspecialchars($row->tipo_accion));
                $cell5 = $table->addCell();
                $cell5->addText(htmlspecialchars($row->cargo_propuesto));
                $cell6 = $table->addCell();
                $cell6->addText(htmlspecialchars($row->nombre_sustituido));
                $cell7 = $table->addCell();
                $cell7->addText(htmlspecialchars($row->cedula_sustituido));;
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