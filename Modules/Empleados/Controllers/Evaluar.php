<?php

namespace Modules\Empleados\Controllers;

use App\Controllers\BaseController;
use Config\Email;
use Modules\Empleados\Models\Empleados_Model;
use Modules\Empleados\Models\Evaluacion_Model;
use PhpOffice\PhpWord\Style\Language;
use CodeIgniter\I18n\Time;

class Evaluar extends BaseController
{
    public function index(){
        try {
            $id = $this->request->getGet('id');
            $empleado = new Empleados_Model();
            $data = $empleado->find($id);
            echo view('Modules\Empleados\Views\header\head');
            echo view('Modules\Empleados\Views\intranet\header');
            echo view('Modules\Empleados\Views\intranet\evaluar', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(){
        try {
            $time = new Time('now');
            $model = new Evaluacion_Model();
            $data = array(
                'empleado' => $this->request->getPost('empleado'),
                'fecha' => $time,
                'periodo' => $this->request->getPost('periodo'),
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'cedula' => $this->request->getPost('cedula'),
                'sexo' => $this->request->getPost('sexo'),
                'edad' => $this->request->getPost('edad'),
                'fec_ingreso' => $this->request->getPost('fecingreso'),
                'calidad' => $this->request->getPost('calidad'),
                'obs_calidad' => $this->request->getPost('obs_calidad'),
                'cantidad' => $this->request->getPost('cantidad'),
                'obs_cantidad' => $this->request->getPost('obs_cantidad'),
                'organizacion' => $this->request->getPost('organizacion'),
                'obs_organizacion' => $this->request->getPost('obs_organizacion'),
                'colaboracion' => $this->request->getPost('colaboracion'),
                'obs_colaboracion' => $this->request->getPost('obs_colaboracion'),
                'oportunidad' => $this->request->getPost('oportunidad'),
                'obs_oportunidad' => $this->request->getPost('obs_oportunidad'),
                'conocimiento' => $this->request->getPost('conocimiento'),
                'obs_conocimiento' => $this->request->getPost('obs_conocimiento'),
                'puntualidad' => $this->request->getPost('puntualidad'),
                'obs_puntualidad' => $this->request->getPost('obs_puntualidad'),
                'responsabilidad' => $this->request->getPost('responsabilidad'),
                'obs_responsabilidad' => $this->request->getPost('obs_responsabilidad'),
                'iniciativa' => $this->request->getPost('iniciativa'),
                'obs_iniciativa' => $this->request->getPost('obs_iniciativa'),
                'presion' => $this->request->getPost('capacidad'),
                'obs_presion' => $this->request->getPost('obs_capacidad'),
                'discrecion' => $this->request->getPost('discrecion'),
                'obs_discrecion' => $this->request->getPost('obs_discrecion'),
                'compromiso' => $this->request->getPost('compromiso'),
                'obs_compromiso' => $this->request->getPost('obs_compromiso'),
                'relaciones' => $this->request->getPost('relaciones'),
                'obs_relaciones' => $this->request->getPost('obs_relaciones'),
                'utilizacion' => $this->request->getPost('utilizacion'),
                'obs_utilizacion' => $this->request->getPost('obs_utilizacion'),
                'creado' => session('usuario'),
                'modificado' => session('usuario'),
                'fec_modificado' => $time,
            );
            $model->save($data);
            return redirect()->to("empleados/evaluacion");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
    return $ano_diferencia;
  }


  public function export(){
        try {
            // creamos el objeto model de la clase evaluacion_model
            $model = new Evaluacion_Model();
            // leemos la variables que pasamos por POST y la asignamos a $id
            $id = $this->request->getPost('id');
            // buscamos los datos de la evaluacion del id llamando al metodo getEvaluacion() y le pasamos
            // el parametro.
            $data = $model->getEvaluacion($id)->getResult();
            //creamos el objeto phpword y definimos sus propiedades
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $propiedades = $phpWord->getDocInfo();
            $propiedades -> setCreator("www.regional11.gob.do");
            $propiedades -> setCompany("Dirección Regional 11 de Educación");
            $propiedades -> setTitle("Reporte Evaluación Empleados");
            $propiedades -> setDescription("Reporte Evaluación Empleados de la Regional");
            $propiedades -> setCategory("Reportes Gestión Humana");
            $propiedades -> setKeywords("documento, php, word");
            /* declaramos la variables dato1[] el cual es un array que servira para cargar los valores de las puntuaciones
            y poder llevar los cuadros con las X que pide el documento*/
            for ($i = 1; $i <= 15; $i++) {
                for ($j =1; $j <= 10; $j++){
                $dato1[$i][$j]='';
                }
            }
            /* Primera seccion o encabezado de la pagina */
            $section = $phpWord->addSection();
            //formato de las fuentes a utilizar
            $titulo = ["name" => "Arial", "size" => 14, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
            $fuenteb = ["name" => "Arial", "size" => 12, "color" => "000000", "italic" => false, "bold" => true,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];

            $fuente = ["name" => "Arial", "size" => 10, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0, 'align' =>'center' ];
            $TfontStyle = ["name" => "Arial", "size" => 9, "color" => "000000", "italic" => false, "bold" => false,'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0 ];
            //add el logo de la regional
            
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

            //add titulo y sub titulo
            $section->addText(htmlspecialchars('DIRECCION REGIONAL 11 DE EDUCACION'),$titulo,['align'=>'center']);
            $section->addText(htmlspecialchars('Formulario técnico de evaluación de empleados técnicos '),$fuenteb,['align'=>'center']);


            // declatamos los parametros de la tabla en tableStyle y en firtRowStyle
            $tableStyle = array(
                'borderColor' => '006699',
                "alignment" => 'RIGHT',
                'borderSize'  => 6,
                'cellMargin'  => 0,
                'align'       => 'center',
                'Spacing'     => 0
            );
            //$firstRowStyle = array('bgColor' => '66BBFF');
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('valign' => 'center');
            $cellColSpan1 = array('gridSpan' => 1, 'valign' => 'center');
            $cellColSpan2 = array('gridSpan' => 5, 'valign' => 'center');
            $cellHCentered = array('align' => 'center', 'textDirection' =>'btLr' );
            $cellVCentered = array('valign' => 'center', 'align' => 'center');

            //realizamos el encabezado
            $phpWord->addTableStyle('myTable',$tableStyle);
            $table = $section->addTable('myTable');

            foreach ($data as $row){
            $table->addRow();
            $cell1 = $table->addCell(6000, $cellColSpan1);
            $cell1->addText(htmlspecialchars('Nombres: '.$row->nombres),$fuente);
            $cell2 = $table->addCell(4000, $cellColSpan2);
            $cell2->addText(htmlspecialchars('Apellidos: '.$row->apellidos));
            $cell3 = $table->addCell(2000, $cellColSpan1);
            $cell3->addText(htmlspecialchars('Fecha: '.$row->fecha));

            $table->addRow();
            $cell4 = $table->addCell(6000, $cellColSpan1);
            $cell4->addText(htmlspecialchars('Cedula: '.$row->cedula));
            $cell5 = $table->addCell(4000, $cellColSpan2);
            $cell5->addText(htmlspecialchars('Periodo: '.$row->periodo));
            $cell6 = $table->addCell(2000, $cellColSpan1);
            $cell6->addText(htmlspecialchars('Edad: '.$row->edad));

            $table->addRow();
            $cell7 = $table->addCell(6000, $cellColSpan1);
            $cell7->addText(htmlspecialchars('Cargo: '));
            $cell8 = $table->addCell(4000, $cellColSpan2);
            $cell8->addText(htmlspecialchars(''));
            $cell9 = $table->addCell(2000, $cellColSpan1);
            $cell9->addText(htmlspecialchars('Sexo: '.$row->sexo));

            $table->addRow();
            $cell10 = $table->addCell(6000, $cellColSpan1);
            $cell10->addText(htmlspecialchars('Fecha de Ingreso a la institución: '.$row->fec_ingreso),$fuente);
            $cell11 = $table->addCell(4000, $cellColSpan2);
            $cell11->addText(htmlspecialchars('CALIFICACION'),$fuente);
            $cell12 = $table->addCell(2000, $cellColSpan1);
            $cell12->addText(htmlspecialchars('OBSERVACIONES DEL EVALUADOR'),$fuente);


            $table->addRow();
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('Marque con una X la casilla que se corresponda con la ejecución de evaluación.'),$fuente);
            $table ->addCell(800, $cellHCentered)->addText(htmlspecialchars('Deficiente'), $TfontStyle,array('align' => 'left'));
            $table ->addCell(800, $cellHCentered)->addText(htmlspecialchars('Insatisfactorio'), $TfontStyle,array('align' => 'left'));
            $table ->addCell(800, $cellHCentered)->addText(htmlspecialchars('Bueno'),$TfontStyle,array('align' => 'left'));
            $table ->addCell(800, $cellHCentered)->addText(htmlspecialchars('Muy Bueno'),$TfontStyle,array('align' => 'left'));
            $table ->addCell(800, $cellHCentered)->addText(htmlspecialchars('Excelente'),$TfontStyle,array('align' => 'left'));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars(''));

            $table->addRow();
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars(''));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars('1'), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars('2'), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars('3'),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars('4'),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars('5'),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars(''));

            $table->addRow();
            $cell15 = $table->addCell(12000, $cellColSpan);
            $cell15->getStyle()->setGridSpan(7);
            $cell15->addText(htmlspecialchars('1. DESEMPEÑO DE LA FUNCION: (Valor 60 Puntos'),$fuente);
            
            // Calidad del Trabajo:
            $dato1[1][$row->calidad]='X';
            $table->addRow();
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.1 CALIDAD DEL TRABAJO: Cuidado, esmero, preocupación por la exactitud y forma de presentación de las labores asignadas: Califíquese la presencia o ausencia de errores y
            su frecuencia e incidencia.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[1][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[1][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[1][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[1][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[1][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_calidad),$fuente);


            // Cantidad de Trabajo:
            $dato1[2][$row->cantidad]='X';
            $table->addRow();
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.2 CANTIDAD DE TRABAJO: Volumen de trabajo ejecutado. Tomar en cuenta la rapidez en la ejecución de la labor, atención de servicios de modo eficiente y en tiempo oportuno.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[2][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[2][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[2][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[2][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[2][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_cantidad),$fuente);

            // Organizacion del Trabajo:
            $table->addRow();
            $dato1[3][$row->organizacion]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.3 ORGANIZACIÓN DEL TRABAJO: Capacidad para lograr eficiencia en su labor haciendo uso adecuado de los medios y del tiempo.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[3][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[3][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[3][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[3][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[3][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_organizacion),$fuente);

            // Colaboracion Trabajo:
            $table->addRow();
            $dato1[4][$row->colaboracion]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.4 COLABORACION: Actitud para alcanzar los objetivos a través del trabajo propio y en equipo.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[4][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[4][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[4][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[4][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[4][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_colaboracion),$fuente);

            // Oportunidad Trabajo:
            $table->addRow();
            $dato1[5][$row->oportunidad]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.5 OPORTUNIDAD:  Entrega los trabajos de acuerdo con la programación previamente establecida.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[5][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[5][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[5][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[5][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[5][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_oportunidad),$fuente);

            // Conocimiento del Trabajo:
            $table->addRow();
            $dato1[6][$row->conocimiento]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('1.6 CONOCIMIENTO DEL TRABAJO: Aplica las destrezas y los conocimientos necesario para el cumplimiento de las actividades y funciones'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[6][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[6][4]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[6][6]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[6][8]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[6][10]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_conocimiento),$fuente);


            $table->addRow();
            $cell15 = $table->addCell(12000, $cellColSpan);
            $cell15->getStyle()->setGridSpan(7);
            $cell15->addText(htmlspecialchars('2. CARACTERISTICAS INDIVIDUALES: (Valor 40 Puntos'),$fuente);

            // Puntualidad:
            $table->addRow();
            $dato1[7][$row->puntualidad]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.1 PUNTUALIDAD: Cumplimiento estricto con el horario establecido en el trabajo. Legar a la hora establecida.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[7][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[7][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[7][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[7][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[7][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_puntualidad),$fuente);

            // Responsabilidad:
            $table->addRow();
            $dato1[8][$row->responsabilidad]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.2 RESPONSABILIDAD: actitud para completar tareas y deberes asignados de acuerdo a metas y `plazos originalmente pactados.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[8][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[8][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[8][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[8][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[8][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_responsabilidad),$fuente);

            // Iniciativa:
            $table->addRow();
            $dato1[9][$row->iniciativa]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.3 INICIATIVA: Tendencia a contribuir, desarrollar y llevar a cabo nuevas ideas o métodos'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[9][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[9][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[9][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[9][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[9][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_iniciativa),$fuente);

            // Capacidad para soportar presion al entregar resultados:
            $table->addRow();
            $dato1[10][$row->presion]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.4 CAPACIDAD PARA SOPORTAR PRESION AL ENTREGAR RESULTADOS: Habilidad para apresurarse en el trabajo asignado. Cumplir sin tomarse ansioso, agresivo y/o voluble en su temperamento.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[10][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[10][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[10][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[10][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[10][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_presion),$fuente);

            // Discrecion y Tacto:
            $table->addRow();
            $dato1[11][$row->discrecion]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.5 DISCRECION Y TACTO: Actitud reservada para actuar o para guardar datos importantes para la organización sin repetir más que cuanto sea necesario.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[11][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[11][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[11][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[11][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[11][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_discrecion),$fuente);

            // Relaciones interpersonales:
            $table->addRow();
            $dato1[12][$row->relaciones]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.6   RELACIONES   INTERPERSONALES:    Comportamiento social adecuado en el trato con supervisores, compañeros de trabajo, usuarios y visitantes.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[12][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[12][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[12][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[12][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[12][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_relaciones),$fuente);

            // Compromisos Institucional:
            $table->addRow();
            $dato1[13][$row->compromiso]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.7 COMPROMISO INSTITUCIONAL: Asume y Transmite el conjunto de valores Organizacionales. En su comportamiento y actitudes demuestra sentido de pertenencia a la entidad.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[13][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[13][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[13][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[13][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[13][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_compromiso),$fuente);


            // Utilizacion de Recursos:
            $table->addRow();
            $dato1[14][$row->utilizacion]='X';
            $cell13 = $table->addCell(6000, $cellColSpan1);
            $cell13->addText(htmlspecialchars('2.8 UTILIZACION DE RECURSOS: Forma como emplea los equipos y elementos dispuestos para el empeño de sus funciones.'));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[14][1]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[14][2]), $TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[14][3]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0 ));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[14][4]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $table ->addCell(800, $cellVCentered)->addText(htmlspecialchars($dato1[14][5]),$TfontStyle,array('align' => 'center', 'spaceAfter' => 0));
            $cell14 = $table->addCell(2000, $cellColSpan1);
            $cell14->addText(htmlspecialchars($row->obs_utilizacion),$fuente);

            //puntaje total
            $table->addRow();
            $cell16 = $table->addCell(12000, $cellColSpan);
            $cell16->getStyle()->setGridSpan(7);
            $cell16->addText(htmlspecialchars('PUNTAJE TOTAL: '.$row->calificacion),$fuenteb);







            

                    


            


            
            //finalizamos el documentos y los generamos
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
        }
        } catch (\Throwable $th) {
            //throw $th;
        }
        



  }
}