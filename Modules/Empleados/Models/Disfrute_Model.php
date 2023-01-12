<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Disfrute_Model extends Model{
    protected $table      = 'app_disfrute';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['empleado','vacaciones', 'dias','fecha_inicio','fecha_fin','estado','tipo','razon','observacion'];

    public function getDisfrute($id){
        $builder = $this->db->table('app_disfrute');
        return $builder->getWhere(['empleado' => $id]);
    }

    public function getVacaciones($id){
        $builder = $this->db->table('app_disfrute');
        $builder->Where(['empleado' => $id]);
        return $builder->get();
    }
    
    public function saveDisfrute($data){
        $query = $this->db->table('app_disfrute')->insert($data);
        return $query;
    }
}