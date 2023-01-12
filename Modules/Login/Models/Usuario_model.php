<?php namespace Modules\Login\Models;
	use \CodeIgniter\Model;

	class Usuario_model extends Model {
		public function obtenerUsuario($data)
		{
			$Usuario = $this->db->table('t_usuario');
			$Usuario->where($data);
			return $Usuario->get()->getResultArray();
		}
		public function getUsuario(){
			$query = $this->db->table('t_usuario');
			return $query->get();
		}
		public function saveUsuario($data){
			$query = $this->db->table('t_usuario')->insert($data);
			return $query;
		}
		public function updateUsuario($data, $id)
		{
			$query = $this->db->table('t_usuario')->update($data, array('id' => $id));
			return $query;
		}
	 
		public function deleteUsuario($id)
		{
			$query = $this->db->table('t_usuario')->delete(array('id' => $id));
			return $query;
		} 
	}
	