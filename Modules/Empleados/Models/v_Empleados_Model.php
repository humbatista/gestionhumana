<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class v_Empleados_Model extends Model{
    protected $table      = 'v_empleados1';
    // Uncomment below if you want add primary key
    /*recordar que el campo vacaciones es un campo que esta en la vista  */
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['nombre','apellido','cedula','telefono','cargo','function', 'unidad', 'fecingreso','vacaciones','licencia'];

    public function get_servidor($id){
        $builder = $this->db->table("v_empleados1");
        $builder->where(['codigo' => $id]);
        return $builder->get();
    }
}

/*select `e`.`codigo` AS `codigo`,`e`.`nombre` AS `nombre`,
`e`.`apellido` AS `apellido`,`e`.`cedula` AS `cedula`,
`e`.`telefono` AS `telefono`,`e`.`fecnacimiento` AS `fecnacimiento`,
`c`.`descripcion` AS `cargo`,`f`.`descripcion` AS `funcion`,
`u`.`descripcion` AS `unidad`,`e`.`fecingreso` AS `fecingreso`,
(select 'SI' AS `vacaciones` from `actadb`.`app_disfrute` 
where curdate() <= `actadb`.`app_disfrute`.`fecha_fin` 
and `actadb`.`app_disfrute`.`fecha_inicio` <= curdate() 
and `actadb`.`app_disfrute`.`empleado` = `e`.`codigo`) 
AS `vacaciones` from (((`actadb`.`app_empleados` `e` join `actadb`.`app_cargo` `c`) 
join `actadb`.`app_unidad` `u`) join `actadb`.`app_funciones` `f`)
 where `e`.`cargo` = `c`.`codigo` and `e`.`unidad` = `u`.`codigo` 
 and `e`.`funciones` = `f`.`id` and `e`.`estado` = 'A' order by 11 desc */