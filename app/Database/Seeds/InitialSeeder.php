<?php
namespace App\Database\Seeds;

class InitialSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('RoleSeeder');
        $this->call('PermissionSeeder');
    }
}