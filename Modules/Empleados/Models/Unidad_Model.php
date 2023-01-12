<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Unidad_Model extends Model{
    protected $table      = 'app_unidad';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['*'];

    public function getUnidad()
    {
        $builder = $this->db->table('app_unidad');
        return $builder->get();
    }

    /* public function empleados(){
        $query = $this->db->query("
        select 
	        e.codigo AS codigo,
            e.nombre AS nombre,
            e.apellido AS apellido,
            e.cedula AS cedula,
            e.telefono As telefono,
            e.fecnacimiento as fecnacimiento,
            c.descripcion AS cargo,
            f.descripcion AS funcion,
            u.descripcion AS unidad,
            e.fecingreso AS fecingreso,
            (Select 'SI' vacaciones from app_disfrute Where curdate() <= fecha_fin And fecha_inicio <= curdate() and empleado = e.codigo) vacaciones
            from app_empleados e, app_cargo c, app_unidad u, app_funciones f
            where e.cargo = c.codigo and e.unidad = u.codigo and e.funciones = f.id order by 1;");
        return $query; */

    //}
}