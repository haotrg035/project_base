<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constrain' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'option_name' => [
                'type' => 'varchar',
                'constraint' => 191,
            ],
            'option_value' => [
                'type' => 'longtext',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('options');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('options');
    }
}