<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
        {
            $username = "user";
            $password = password_hash("123", PASSWORD_DEFAULT);
            $name = "Usuario";
            $type = 'U';
                $data = [
                        'username' => $username,
                        'password'    => $password,
                        'name' => $name,
                        'type' => $type
                ];

            

                // Using Query Builder
                $this->db->table('t_usuario')->insert($data);
        }
}
