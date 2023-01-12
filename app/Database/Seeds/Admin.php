<?php 
namespace App\Database\Seeds;

class Admin extends \CodeIgniter\Database\Seeder{
    public function run(){
            $username = "admin" ;
            $password = password_hash("123", PASSWORD_DEFAULT);
            $name = "Administrador";
            $type = 'A';
                $data = [
                        'username' => $username,
                        'password'    => $password,
                        'name' => $name,
                        'type' => $type
                ];

        $this->db->table('t_usuario')->insert($data);
    }
}