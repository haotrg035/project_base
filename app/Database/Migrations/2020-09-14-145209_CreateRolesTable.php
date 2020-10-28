<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increament' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'level' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('id');
        $this->forge->createTable('roles');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
