<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'username'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '50',
                        ],
                        'name' => [
                                'type' => 'VARCHAR',
                                'constrain' => '50',
                        ],
                        'password' => [
                                'type' => 'VARCHAR',
                                'constrain' => '100',
                        ],
                        'type' => [
                                'type' => 'VARCHAR',
                                'constrain' => '1',
                        ],
                        'created' => [
                                'type' => 'timestamp',
                        ],
                ]);
                $this->forge->addKey('id', true);
                $this->forge->createTable('users');
        }

        public function down()
        {
                $this->forge->dropTable('users');
        }
}
