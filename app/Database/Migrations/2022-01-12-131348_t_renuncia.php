<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class T_renuncia extends Migration{
    public function up(){

        // Uncomment below if want config
        $this->forge->addField([
         		'idrenuncia'          		=> [
         				'type'           => 'INT',
         				'unsigned'       => TRUE,
         				'auto_increment' => TRUE
         		],
         		'fecha'       		=> [
         				'type'           => 'DATE',
        // 				'constraint'     => '100',
         		],
                 'nombre'       		=> [
                    'type'           => 'VARCHAR',
    				'constraint'     => '30',
                ],
                'apellido'       		=> [
                    'type'           => 'VARCHAR',
    				'constraint'     => '30',
                ],
                'cedula'       		=> [
                    'type'           => 'VARCHAR',
    				'constraint'     => '13',
                ],
                'telefono'       		=> [
                    'type'           => 'VARCHAR',
    				'constraint'     => '15',
                ],
                'centro_educativo'       		=> [
                    'type'           => 'INT',
    				//'constraint'     => '30',
                 ],
                 'puesto'       		=> [
                    'type'           => 'VARCHAR',
    				'constraint'     => '30',
                 ],
                 'fecha_renuncia'       => [
                    'type'           => 'DATE',
    				//'constraint'     => '30',
                ],
            
         ]);
         $this->forge->addKey('idrenuncia', TRUE);
        $this->forge->createTable('t_renuncia');
    }

    public function down(){
        $this->forge->dropTable('t_renuncia');
    }
}