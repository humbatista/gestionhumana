<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Vacaciones_Model extends Model{
    protected $table      = 'app_vacaciones';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['empleado','periodo', 'diasvacaciones','pendiente','disfrutado'];

    public function getVacaciones($id){
        $builder = $this->db->table('app_vacaciones');
        $builder->Where(['empleado' => $id]);
        return $builder->get();
    }

    public function saveVacaciones($data){
        $query = $this->db->table('app_vacaciones')->insert($data);
        return $query;
    }
}