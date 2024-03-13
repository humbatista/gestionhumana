<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Pension_Model extends Model{
    protected $table      = 't_pension';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idpension';

    protected $allowedFields = ['fecha_solicitud', 'nombre','apellido','cedula',
    'telefono', 'usuario', 'centro_educativo','puesto','area','tipo_pension','distrito', 'status','activa'];

    public function getPension()
    {
        $builder = $this->db->table('t_pension');
        return $builder->get();
    }

    public function getPensionbyUser($user){
        $builder = $this->db->table('t_pension');
        return $builder->getWhere(['usuario' => $user]);
    }

    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_pension');
        $builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Aprobada');
        return $builder->get();
    }
    public function getPensionActivas(){
        $builder = $this->db->table('t_pension');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }

    public function getReporte($distrito){
        $builder = $this->db->table('t_pension');
        $builder->orderBy('fecha_solicitud', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }

    public function savePension($data){
        $query = $this->db->table('t_pension')->insert($data);
        return $query;
    }
 
    public function updatePension($data, $id)
    {
        $query = $this->db->table('t_pension')->update($data, array('idpension' => $id));
        return $query;
    }
 
    public function deletePension($id)
    {
        $query = $this->db->table('t_pension')->delete(array('idpension' => $id));
        return $query;
    } 

    public function aprobar($id){
        $builder = $this->db->table('t_pension');
        $builder->set('status', 'Aprobada');
        $builder->where('idpension', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_pension');
        $builder->set('status', 'Aceptada');
        $builder->where('idpension', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_pension');
        $builder->set('status', 'Devuelta');
        $builder->where('idpension', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_pension');
        $builder->set('status', 'Rechazada');
        $builder->where('idpension', $id);
        $builder->update();
    }

    public function reportePension($fechaini, $fechafin){
        if(($fechaini === "") or ($fechafin === "")) {
            $query = $this->db->query("SELECT t.idpension,t.fecha_solicitud, t.nombre, 
            t.apellido, t.cedula, t.telefono, t.distrito, c.nombre_escuela centro_educativo, t.area, t.puesto 
            FROM t_pension t, t_centro_educativo c
            WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' LIMIT 20;");
            return $query;
         } else  {
             $query = $this->db->query("SELECT t.idpension,t.fecha_solicitud, t.nombre, 
             t.apellido, t.cedula, t.telefono, t.distrito, c.nombre_escuela centro_educativo, t.area, t.puesto 
             FROM t_pension t, t_centro_educativo c
             WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' And fecha_solicitud >= STR_TO_DATE(?,'%Y-%m-%d') 
             And fecha_solicitud <= STR_TO_DATE(?,'%Y-%m-%d');", [$fechaini, $fechafin]);
             return $query;
        }
    }

    public function oficioPension($id){
             $query = $this->db->query("SELECT p.nombre, p.apellido, p.cedula, p.distrito, 
             p.anio_inicio,'25000' sueldo, p.tipo_pension, t.tipo 
             FROM t_pension p, t_tipo_pension t 
             WHERE p.tipo_pension = t.id
             And p.idpension= ?;", $id);
             return $query;
    }

    public function getPensionbyId($id){
        $this->select('*');
        $this->where('idpension', $id);
        $datos = $this->findAll();
        return $datos;
    }
}

//SELECT p.nombre, p.apellido, p.cedula, p.distrito, p.anio_inicio,'25000' sueldo, p.tipo_pension, t.tipo 
//FROM t_pension p, t_tipo_pension t 
//WHERE p.tipo_pension = t.id; 