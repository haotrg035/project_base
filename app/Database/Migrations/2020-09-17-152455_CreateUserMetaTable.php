<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserMetaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'bigint',
                'constrain' => 20,
                'unsigned' => true,
            ],
            'meta_key' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'meta_value' => [
                'type' => 'longtext',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('user_meta');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('user_meta');
    }
}