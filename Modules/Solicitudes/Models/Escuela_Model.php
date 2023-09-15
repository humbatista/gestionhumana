<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Escuela_Model extends Model{
    protected $table      = 't_centro_educativo';
    protected $primaryKey = 'escuela_id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['escuela_id','codigo_id', 'nombre_escuela', 'distrito'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function obtenerDistrito()
    {
        $builder = $this->db->table('t_distritos');
        return $builder->get();
    }
 
    public function obtenerEscuela()
    {
        $builder = $this->db->table('t_centro_educativo');
        $builder->select('*');
        $builder->join('t_distritos', 'id = distrito','left');
        return $builder->get();
    }

    public function getEscuela($id) {
        $builder = $this->db->table('t_centro_educativo');
        return $builder->getWhere(['escuela_id' => $id]);
    }
    
    public function getEscuelaDistrito($id) {
        $builder = $this->db->table('t_centro_educativo');
        $builder->join('t_distritos', 'id = distrito', 'inner');
        return $builder->getWhere(['distrito_id' => $id]);
    }



    public function saveEscuela($data){
        $query = $this->db->table('t_centro_educativo')->insert($data);
        return $query;
    }
 
    public function updateEscuela($data, $id)
    {
        $query = $this->db->table('t_centro_educativo')->update($data, array('escuela_id' => $id));
        return $query;
    }
 
    public function deleteEscuela($id)
    {
        $query = $this->db->table('t_centro_educativo')->delete(array('escuela_id' => $id));
        return $query;
    } 
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';

    public function search($var, $distrito){
        $builder = $this->db->table('t_centro_educativo');
        $builder->where('distrito', $distrito);
        $builder->like('nombre_escuela', $var);
        return $builder->limit(10)->get();
    }

    public function autocomplete($search_data) {
        $builder = $this->db->table('t_centro_educativo');
        $builder->like('nombre_escuela', $search_data);
        return $builder->limit(10)->get();
        }
}