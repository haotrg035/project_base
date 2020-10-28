<?php

namespace App\Database\Seeds;

class RoleSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'administrator', 'level' => 1],
            ['name' => 'manager', 'level' => 2],
        ];

        foreach ($data as $key => $item) {
            $item['id'] = $key + 1;
            $this->db->table('roles')->insert($item);
        }

        $this->db->table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
