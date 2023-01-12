<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Inclusion_Model extends Model{
    protected $table      = 't_inclusion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idinclusion';
    protected $allowedFields = ['fecha', 'nombre','apellido','cedula',
    'telefono','nombre_dependiente','cedula_dependiente','relacion',
    'nombre_dependiente1', 'cedula_dependiente1','relacion1',
    'usuario','nacimiento', 'distrito', 'status','activa'];
    public function getInclusion()
    {
        $builder = $this->db->table('t_inclusion');
        return $builder->get();
    }

    public function getInclusionbyUser($user){
        $builder = $this->db->table('t_inclusion');
        return $builder->getWhere(['usuario' => $user]);
    }
    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_inclusion');
        $builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Aprobada');
        return $builder->get();
    }

    public function getInclusionActivas(){
        $builder = $this->db->table('t_inclusion');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
        
    }

    public function reporteInclusion($fechaini, $fechafin){
       if(($fechaini === "") or ($fechafin === "")) {
            $builder = $this->db->table('t_inclusion');
            //$builder->join('t_departamento', 't_departamento.id_depto = t_visitantes.depto', 'inner');
            $builder->orderBy('distrito', 'DESC');
            $query = $builder->get(20);
            return $query;
        } else  {
            $query = $this->db->query("SELECT idinclusion,fecha, nombre, apellido, cedula, telefono FROM t_inclusion 
            WHERE status = 'Aceptada' And fecha >= STR_TO_DATE(?,'%Y-%m-%d') 
            And fecha <= STR_TO_DATE(?,'%Y-%m-%d');", [$fechaini, $fechafin]);
            return $query;
        }
    }

    public function saveInclusion($data){
        $query = $this->db->table('t_inclusion')->insert($data);
        return $query;
    }
 
    public function updateInclusion($data, $id)
    {
        $query = $this->db->table('t_inclusion')->update($data, array('idinclusion' => $id));
        return $query;
    }
 
    public function deleteInclusion($id)
    {
        $query = $this->db->table('t_inclusion')->delete(array('idinclusion' => $id));
        return $query;
    } 

    public function aprobar($id){
        $builder = $this->db->table('t_inclusion');
        $builder->set('status', 'Aprobada');
        $builder->where('idinclusion', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_inclusion');
        $builder->set('status', 'Aceptada');
        $builder->where('idinclusion', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_inclusion');
        $builder->set('status', 'Devuelta');
        $builder->where('idinclusion', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_inclusion');
        $builder->set('status', 'Rechazada');
        $builder->where('idinclusion', $id);
        $builder->update();
    }

    public function getReporte($distrito){
        $builder = $this->db->table('t_inclusion');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }
}