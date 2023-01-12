<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Funciones_Model extends Model{
    protected $table      = 'app_funciones';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['descripcion', 'estado'];

    public function getCargo()
    {
        $builder = $this->db->table('app_funciones');
        return $builder->get();
    }

    public function saveCargo($data){
        $query = $this->db->table('app_funciones')->insert($data);
        return $query;
    }

}