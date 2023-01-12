<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Renuncia_Model extends Model{
    protected $table      = 't_renuncia';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idrenuncia';
    protected $allowedFields = ['tipo','fecha','fecha_renuncia', 'nombre','cedula',
    'telefono','lugar','centro_educativo', 'usuario', 'centro_educativo','puesto','area','distrito', 'status','activa'];

    public function getRenuncia()
    {
        $builder = $this->db->table('t_renuncia');
        return $builder->get();
    }

    public function getRenunciabyUser($user){
        $builder = $this->db->table('t_renuncia');
        return $builder->getWhere(['usuario' => $user]);
    }
    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_renuncia');
        $builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Aprobada');
        return $builder->get();
    }
    public function getRenunciaActivas(){
        $builder = $this->db->table('t_renuncia');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }
    public function saveRenuncia($data){
        $query = $this->db->table('t_renuncia')->insert($data);
        return $query;
    }
 
    public function updateRenuncia($data, $id)
    {
        $query = $this->db->table('t_renuncia')->update($data, array('idrenuncia' => $id));
        return $query;
    }
 
    public function deleteRenuncia($id)
    {
        $query = $this->db->table('t_renuncia')->delete(array('idrenuncia' => $id));
        return $query;
    } 

    public function aprobar($id){
        $builder = $this->db->table('t_renuncia');
        $builder->set('status', 'Aprobada');
        $builder->where('idrenuncia', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_renuncia');
        $builder->set('status', 'Aceptada');
        $builder->where('idrenuncia', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_renuncia');
        $builder->set('status', 'Devuelta');
        $builder->where('idrenuncia', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_renuncia');
        $builder->set('status', 'Rechazada');
        $builder->where('idrenuncia', $id);
        $builder->update();
    }

    public function getReporte($distrito){
        $builder = $this->db->table('t_renuncia');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }

    public function reporteRenuncias($fechaini, $fechafin){
        if(($fechaini === "") or ($fechafin === "")) {
            $query = $this->db->query("SELECT t.idrenuncia,t.fecha_renuncia, t.nombre, 
            t.cedula, t.telefono, t.distrito, c.nombre_escuela centro_educativo, t.puesto, t.area
            FROM t_renuncia t, t_centro_educativo c
            WHERE c.escuela_id = t.centro_educativo  And t.status = 'Aprobada' LIMIT 20;");
            return $query;
         } else  {
             $query = $this->db->query("SELECT t.idrenuncia,t.fecha_renuncia, t.nombre, 
             t.cedula, t.telefono, t.distrito, c.nombre_escuela centro_educativo, t.puesto, t.area
             FROM t_renuncia t, t_centro_educativo c
             WHERE c.escuela_id = t.centro_educativo And t.status = 'Aprobada' And fecha >= STR_TO_DATE(?,'%Y-%m-%d') 
             And fecha <= STR_TO_DATE(?,'%Y-%m-%d');", [$fechaini, $fechafin]);
             return $query;
        }
    }
}