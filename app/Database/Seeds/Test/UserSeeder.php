<?php

namespace App\Database\Seeds\Test;

use CodeIgniter\I18n\Time;
use Faker\Factory as Faker;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $time = new Time(config('App')->appTimezone);
        $faker = Faker::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'username' => $faker->userName,
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'full_name' => $faker->name,
                'gender' => random_int(1, 2),
                'role_id' => 2,
                'birthday' => $faker->dateTime('-20 year')->format('Y-m-d'),
                'updated_at' => $time->now(),
                'created_at' => $time->now(),
                'deleted_at' => null,
            ];
        }
        foreach ($data as  $item) {
            $this->db->table('users')->insert($item);
        }
    }
}
