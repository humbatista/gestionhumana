<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Cargo_Model extends Model{
    protected $table      = 'app_cargo';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['descripcion', 'estado'];

    public function getCargo()
    {
        $builder = $this->db->table('app_cargo');
        return $builder->get();
    }

    public function saveCargo($data){
        $query = $this->db->table('app_cargo')->insert($data);
        return $query;
    }

}