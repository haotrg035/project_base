<?php
namespace App\Database\Seeds;

class TestSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call(Test\UserSeeder::class);
    }
}