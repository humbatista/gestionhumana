<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Vacaciones_Model extends Model{
    protected $table      = 't_vacaciones';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['empleado','cedula','periodo','fecha_inicio','distrito', 'fecha_fin','dias','usuario','estado','tipo','centro_educativo','observacion','status','fecha'];

    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_vacaciones');
        $builder->where('activa', 'SI'); //solo muestras los activos
        $builder->Where(['distrito' => $distrito]);
        #$builder->Where('estado !=', 'Aprobada'); //esto es para ir borrando los aprobados se activara cuando Gestion Humana lo solicite

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


    //funciones para cambiar el status de los registros
    public function aprobar($id){
        $builder = $this->db->table('t_vacaciones');
        $builder->set('status', 'Aprobada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_vacaciones');
        $builder->set('status', 'Aceptada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_vacaciones');
        $builder->set('status', 'Devuelta');
        $builder->where('id', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_vacaciones');
        $builder->set('status', 'Rechazada');
        $builder->where('id', $id);
        $builder->update();
    }


    //imprimir los reportes
    public function getReporte($distrito){
        $builder = $this->db->table('t_vacaciones');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }

    public function getVacacionesActivas(){
        $builder = $this->db->table('t_vacaciones');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }
}