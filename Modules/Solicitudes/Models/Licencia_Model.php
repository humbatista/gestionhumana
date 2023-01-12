<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Licencia_Model extends Model{
    protected $table      = 't_licencia';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres','cedula', 'tipo_licencia', 'dias','tipo','fechaini','fechafin',
    'centro_educativo', 'nombre_suplente', 'cedula_suplente', 'fecha','usuario','modificado','fecmodificado', 'cargo','distrito', 'status','activa'];

    /* public function getLicencias()
    {
        $builder = $this->db->table('t_licencia');
        return $builder->get();
    } */

    public function getLicenciabyUser($user){
        $builder = $this->db->table('t_licencia');
        return $builder->getWhere(['usuario' => $user]);
    }
    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_licencia');
        $builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where(['status !=', 'Aprobada']);
        return $builder->get();
    }
    public function getLicenciaActivas(){
        $builder = $this->db->table('t_licencia');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }

    public function getLicenciamaternidad(){
        $builder = $this->db->table('t_licencia');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['tipo_licencia' => 2]);
        return $builder->get();
    }
    public function aprobar($id){
        $builder = $this->db->table('t_licencia');
        $builder->set('status', 'Aprobada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_licencia');
        $builder->set('status', 'Aceptada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_licencia');
        $builder->set('status', 'Devuelta');
        $builder->where('id', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_licencia');
        $builder->set('status', 'Rechazada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function getReporte($distrito){
        $builder = $this->db->table('t_licencia');
        $builder->join('t_tipo_permisos', 'idtipo = tipo_licencia', 'inner');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['tipo_licencia !=' => 2]);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }

    public function getReporteMaternidad($distrito){
        $builder = $this->db->table('t_licencia');
        $builder->join('t_tipo_permisos', 'idtipo = tipo_licencia', 'inner');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['tipo_licencia' => 2]);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }

    public function ajaxSearch()
    {
        helper(['form', 'url']);
 
        $data = [];
        $db      = \Config\Database::connect();
        $builder = $db->table('t_centro_educativo');   
        $query = $builder->like('nombre_escuela', $this->request->getVar('q'))
                    ->select('escuela_id as id, nombre_escuela as text')
                    ->limit(10)->get();
        $data = $query->getResult();
        echo json_encode($data);
    }

    public function reporteLicencias($fechaini, $fechafin){
        if(($fechaini === "") or ($fechafin === "")) {
            $query = $this->db->query("SELECT t.id,t.fecha,t.dias, t.nombres, 
            t.cedula, t.distrito, c.nombre_escuela centro_educativo, t.cargo 
            FROM t_licencia t, t_centro_educativo c
            WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' LIMIT 20;");
            return $query;
         } else  {
             $query = $this->db->query("SELECT t.id,t.fecha,t.dias, t.nombres, 
             t.cedula, t.distrito, c.nombre_escuela centro_educativo, t.cargo 
             FROM t_licencia t, t_centro_educativo c
             WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' And fecha >= STR_TO_DATE(?,'%Y-%m-%d') 
             And fecha <= STR_TO_DATE(?,'%Y-%m-%d');", [$fechaini, $fechafin]);
             return $query;
        }
    }
}