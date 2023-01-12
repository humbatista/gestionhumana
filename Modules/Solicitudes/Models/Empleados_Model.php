<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;
/* esta modelo solo sirve para los que los usuarios corrigan los empleados
no se uso el modelo del mudulo empleado para mantener dichas instancia separados*/
class Empleados_Model extends Model{
    public function ObtenerEmpleados()
    {
        $builder = $this->db->table('app_empleados');
        return $builder->get();
    }
}