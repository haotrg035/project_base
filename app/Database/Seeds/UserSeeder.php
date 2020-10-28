<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $time = new Time(config('App')->appTimezone);
        $data = [
            'username' => 'cp_administrator',
            'password' => password_hash('admin@123', PASSWORD_BCRYPT),
            'full_name' => 'CI Project Admin',
            'gender' => '1',
            'birthday' => '1998-01-08',
            'created_at' => $time->now(),
            'updated_at' => $time->now(),
        ];
        $this->db->table('users')->insert($data);
    }
}
