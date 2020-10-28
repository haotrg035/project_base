<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionsTable extends Migration
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
                'type' => 'ENUM',
                'constraint' => ['view', 'create', 'update', 'delete', 'force_delete', 'restore'],
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('permissions');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('permissions');
    }
}
