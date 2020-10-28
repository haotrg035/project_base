<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('role_id', 'roles', 'id');
        $this->forge->addPrimaryKey(['user_id', 'role_id']);
        $this->forge->createTable('role_user');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('role_user');
    }
}