<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Vacaciones_Model extends Model{
    protected $table      = 't_vacaciones';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['empleado','cedula','periodo','fecha_inicio','distrito', 'fecha_fin','dias','estado','tipo','centro_educativo','observacion','status'];

    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_vacaciones');
        #$builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        #$builder->Where('estado !=', 'Aprobada');

        return $builder->get();
    }

    public function reporteVacaciones($fechaini, $fechafin){
        if(($fechaini === "") or ($fechafin === "")) {
            $query = $this->db->query("SELECT t.id,t.empleado,t.cedula, t.distrito, 
            t.periodo, t.fecha_inicio,fecha_fin, t.dias, c.nombre_escuela centro_educativo, t.activa, t.status
            FROM t_vacaciones t, t_centro_educativo c
            WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' LIMIT 20;");
            return $query;
         } else  {
             $query = $this->db->query("SELECT t.id,t.empleado,t.cedula, t.distrito, 
             t.periodo, t.fecha_inicio,fecha_fin, t.dias, c.nombre_escuela centro_educativo, t.activa, t.status
             FROM t_vacaciones t, t_centro_educativo c WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' 
             And fecha >= STR_TO_DATE(?,'%Y-%m-%d') And fecha <= STR_TO_DATE(?,'%Y-%m-%d');", [$fechaini, $fechafin]);
             return $query;
        }
    }
    
}