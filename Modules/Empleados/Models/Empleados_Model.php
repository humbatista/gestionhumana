<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Empleados_Model extends Model{
    protected $table      = 'app_empleados';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['apellido', 'nombre','cedula','telefono', 'cargo', 'funciones','grupo', 'unidad','supervisor', 'encargado', 'fecingreso',
    'fecsalida','fecnacimiento','sexo','creado','feccreado','modificado', 'fecmodificado','estado','condicion'];

   public function getEmpleadobyCodigo($codigo){
        // $sql= ("SELECT e.codigo, e.apellido, e.nombre, e.cedula, c.descripcion cargo, f.descripcion funciones, e.fecingreso, e.fecnacimiento "
        // . "FROM app_empleados e "
        // . "inner join app_cargo c on e.cargo =  c.codigo "
        // . "left join app_funciones f on e.funciones = f.id "
        // . "Where e.codigo = ?; ", $codigo);
        $query = $this->db->query("SELECT e.codigo, e.apellido, e.nombre, e.cedula, c.descripcion cargo, f.descripcion funcion, e.funciones, e.supervisor, e.encargado,
        e.fecingreso, e.fecnacimiento, e.grupo, e.unidad, e.sexo
            FROM app_empleados e 
            inner join app_cargo c on e.cargo =  c.codigo 
            left join app_funciones f on e.funciones = f.id
            Where e.codigo = ?", [$codigo]);
        return $query;
    }

    public function getEmpleados(){
        $query = $this->db->query("SELECT e.codigo, e.nombre, e.apellido, e.cedula, e.telefono
            FROM app_empleados e
            WHERE estado ='A'");
        return $query;
    }

    public function get_servidor($id){
        $query = $this->db->query("call sp_getservidor(?)", $id);
        return $query;
    }

    public function updateServidor($data, $codigo)
		{
			$query = $this->db->table('app_empleados')->update($data, array('codigo' => $codigo));
			return $query;
		}

    public function getRegVacaciones($periodo){
        $query = $this->db->query("SELECT codigo, nombre, apellido, cargo 
            FROM app_empleados 
            WHERE codigo not in (Select empleado from app_vacaciones where periodo = ?)
            Order by apellido",[$periodo]);
        return $query;
    }

    public function getencargados(){
        // esta funcion devuelve los empleados que son encargados o que supervisan a otros 
        // esto con el fin de controlar la parte de las evaluaciones el campo
        // encargado puede tomar los valores 'S' cuando tiene empleados a su cargo y 'N' cuando no.

        $builder = $this->db->table('app_empleados');
        return $builder->getWhere(['encargado' => 'S']); 
    }

    public function getsupervisados($sup){
        /// esta funcion devuelve los empleados que son supervisados por x supervisor
        $builder = $this->db->table('app_empleados');
        return $builder->getWhere(['supervisor' => $sup ]);
    }

}