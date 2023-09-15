<?php namespace Modules\Empleados\Models;
	use \CodeIgniter\Model;

	class Solicitudes_Model extends Model {


		public function getPendientes(){
				 $query = $this->db->query("SELECT count(*) Cantidad, 'Exclusiones' Descripcion FROM `t_exclusion` WHERE status like ''
				 UNION
				 Select count(*) Cantidad, 'Inclusiones' Descripcion From t_inclusion Where status like ''
				 union 
				 Select count(*) Cantidad, 'Pensiones' Descripcion from t_pension where status like ''
				 Union 
				 Select count(*) Cantidad, 'Licencias' Descripcion from t_licencia where status like ''");
				 return $query;
		}

		public function getPendientes_Distritos(){
			$query = $this->db->query("Select sum(cantidad) Cantidad, Distrito From
			((Select count(*) Cantidad, Distrito from t_exclusion where status<> 'Aprobada'and activa='SI' GROUP by distrito)
			union
			(Select count(*) Cantidad, Distrito from t_inclusion where status <> 'Aprobada' and activa='SI' GROUP by distrito)
			union
			(Select count(*) Cantidad, Distrito from t_pension where status <> 'Aprobada' and activa='SI'  group by distrito)
			union
			(Select count(*) Cantidad, Distrito from t_licencia where status <> 'Aprobada' and activa='SI'  GROUP by distrito))e
			
			GROUP by Distrito");
			return $query;
		}

		public function getRegVacaciones($periodo){
			$query = $this->db->query("SELECT codigo, nombre, apellido, cargo 
				FROM app_empleados 
				WHERE codigo not in (Select empleado from app_vacaciones where periodo = ?)
				Order by apellido",[$periodo]);
			return $query;
		}

		public function pesonaldelicencia(){
			$query = $this->db->query("SELECT E.codigo, E.nombre, E.apellido, t.fechaini, t.fechafin
			FROM app_empleados E, t_licencia t
			WHERE E.cedula = t.cedula
			And t.fechaini <= curdate()
			And t.fechafin >= curdate();");
			return $query;
		}

		public function situaciondistritos(){
			$query = $this->db->query("SELECT * from t_situacion;");
			return $query;
		}
    }

