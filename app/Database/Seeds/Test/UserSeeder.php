<?php

namespace App\Database\Seeds\Test;

use Faker\Factory as Faker;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'username' => $faker->userName,
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'full_name' => $faker->name,
                'gender' => random_int(1, 2),
                'birthday' => $faker->dateTime('-18 year')->format('Y-m-d'),
                'updated_at' => date('Y-m-d H:i:s', time()),
                'created_at' => date('Y-m-d H:i:s', time()),
                'deleted_at' => null,
            ];
        }

        // print_r($data);
        foreach ($data as $key => $value) {
            $this->db->table('users')->insert($value);
            $this->db->table('role_user')->insert([
                'user_id' => $key + 2,
                'role_id' => 2,
            ]);
        }
    }
}
