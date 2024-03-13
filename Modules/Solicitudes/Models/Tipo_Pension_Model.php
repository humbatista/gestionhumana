<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Tipo_Pension_Model extends Model{
    protected $table      = 't_tipo_pension';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo'];

    public function getTipo(){
        $builder = $this->db->table('t_tipo_pension');
        return $builder->get();
    }
}