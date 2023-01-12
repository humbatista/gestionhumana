<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Evaluacion_Model extends Model{
    protected $table      = 'app_evaluacion2';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['empleado','fecha','periodo','nombres','apellidos','cedula','sexo','edad','fec_ingreso','calidad',
    'obs_calidad','cantidad','obs_cantidad','organizacion','obs_organizacion','colaboracion','obs_colaboracion',
    'oportunidad','obs_oportunidad','conocimiento','obs_conocimiento','puntualidad','obs_puntualidad','responsabilidad',
    'obs_responsabilidad','iniciativa','obs_iniciativa','presion','obs_presion','discrecion','obs_discrecion',
    'relaciones','obs_relaciones','compromiso','obs_compromiso','utilizacion','obs_utilizacion','creado','modificado','fec_modificado'];


    public function getHistorico($id){
        $builder = $this->db->table('app_evaluacion2');
        $builder->Where(['empleado' => $id]);
        return $builder->get();

    }

    public function getEmpleados($supervisor){
        $query = $this->db->query("Select * from app_empleados where supervisor = ? 
        and codigo not in (Select empleado from app_evaluacion2 
        where periodo = extract(YEAR_MONTH from curdate()))",[$supervisor]);
        return $query;
    }

    public function getEvaluaciones($periodo){
        $query = $this->db->query("Select id, empleado, fecha, periodo, nombres, apellidos,
        cedula, calificacion from app_evaluacion2 e where periodo = ?",[$periodo]);
        return $query;
    }

    public function getEvaluacion($id){
        // $query = $this->db->query("Select id, empleado, fecha, edad, sexo, periodo, nombres, apellidos,
        // fec_ingreso, cedula, calificacion from app_evaluacion2 e where id = ?",[$id]);
        $query = $this->db->query("Select * from app_evaluacion2 e where id = ?",[$id]);
        return $query;
    }

    
}


/* Select * from app_empleados where supervisor = 2
and codigo in (Select empleado from app_evaluacion2 where MONTH(fecha) = MONTH(curdate()) And YEAR(fecha) = YEAR(curdate())) */