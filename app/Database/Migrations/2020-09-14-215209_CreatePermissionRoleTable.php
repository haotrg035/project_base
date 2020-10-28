<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'permission_id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addForeignKey('permission_id', 'permissions', 'id');
        $this->forge->addForeignKey('role_id', 'roles', 'id');
        $this->forge->addPrimaryKey(['permission_id', 'role_id']);
        $this->forge->createTable('permission_role');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('permission_role');
    }
}