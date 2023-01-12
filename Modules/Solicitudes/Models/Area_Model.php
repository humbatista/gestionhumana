<?php
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Area_Model extends Model{
    protected $table = 't_area';
    protected $primaryKey = 'id';
    protected $allowdField = ['descripcion','estado'];

    public function getAreabyId($id){
        $builder = $this->db->table('t_area');
        return $builder->getWhere(['id' => $id]);
    }

    public function getArea(){
        $builder = $this->db->table('t_area');
        return $builder->getWhere(['estado'=> 'A']);
    }


}