<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class v_Empleados_Model extends Model{
    protected $table      = 'v_empleados';
    // Uncomment below if you want add primary key
    /*recordar que el campo vacaciones es un campo que esta en la vista  */
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['nombre','apellido','cedula','telefono','cargo','function', 'unidad', 'fecingreso','vacaciones','licencia'];

    public function get_servidor($id){
        $builder = $this->db->table("v_empleados");
        $builder->where(['codigo' => $id]);
        return $builder->get();
    }
}