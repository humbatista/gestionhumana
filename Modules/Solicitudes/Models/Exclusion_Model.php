<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Exclusion_Model extends Model{
    protected $table      = 't_exclusion';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    public function getExclusion()
    {
        $builder = $this->db->table('t_exclusion');
        return $builder->get();
    }

    public function getExclusionbyUser($user){
        $builder = $this->db->table('t_exclusion');
        return $builder->getWhere(['usuario' => $user]);
    }
    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_exclusion');
        $builder->where('activa', 'SI');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Aprobada');

        return $builder->get();
    }

    public function getExclusionActivas(){
        $builder = $this->db->table('t_exclusion');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }

    public function saveExclusion($data){
        $query = $this->db->table('t_exclusion')->insert($data);
        return $query;
    }
 
    public function updateExclusion($data, $id)
    {
        $query = $this->db->table('t_exclusion')->update($data, array('idexclusion' => $id));
        return $query;
    }
 
    public function deleteExclusion($id)
    {
        $query = $this->db->table('t_exclusion')->delete(array('idexclusion' => $id));
        return $query;
    } 

    public function aprobar($id){
        $builder = $this->db->table('t_exclusion');
        $builder->set('status', 'Aprobada');
        $builder->where('idexclusion', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_exclusion');
        $builder->set('status', 'Aceptada');
        $builder->where('idexclusion', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_exclusion');
        $builder->set('status', 'Devuelta');
        $builder->where('idexclusion', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_exclusion');
        $builder->set('status', 'Rechazada');
        $builder->where('idexclusion', $id);
        $builder->update();
    }

    public function getReporte($distrito){
        $builder = $this->db->table('t_exclusion');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $distrito]);
        return $builder->get();
    }
}