<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Cumple_Model extends Model{
    public function mostrar_cumple_hoy(){
        // $query = $this->db->query("SELECT CODIGO, NOMBRE FROM t_empleados "
        // ." WHERE extract(month from fecha) = extract(month from current_date) and "
        // . " extract(day from fecha) = extract (day from current_date) ");
        // $sql= "SELECT ID, NOMBRE FROM T_EMPLEADOS "
        //         . "WHERE EXTRACT(MONTH FROM FECHA_NACIMIENTO) = EXTRACT(MONTH FROM CURRENT_DATE) AND "
        //         . "ESTRACT(DAY FROM FECHA_NACIMIENTO) = EXTRACT(DAY FROM CURRENT_DATE) "
        //         . "AND ESTADO = 'A'";
        $sql= "SELECT CODIGO, CONCAT(NOMBRE,' ',APELLIDO) NOMBRE FROM app_empleados "
                . "WHERE EXTRACT(MONTH FROM FECNACIMIENTO) = EXTRACT(MONTH FROM CURRENT_DATE) AND "
                . "EXTRACT(DAY FROM FECNACIMIENTO) = EXTRACT(DAY FROM CURRENT_DATE)";
        $query = $this->db->query($sql);
        return $query;
        // if ($query->num_rows() > 0 ){
        //     return $query;
        // }
        // else {
        //     return 0;
        // }
    }
}