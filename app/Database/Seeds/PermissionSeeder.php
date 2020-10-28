<?php

namespace App\Database\Seeds;

class PermissionSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $key = 1;
        foreach (config('Role')->permissions as $group => $permissions) {
            foreach ($permissions as $permissionName) {
                $permission = [
                    'id' => $key,
                    'name' => $permissionName,
                    'group' => $group
                ];
                $this->db->table('permissions')->insert($permission);
                $this->db->table('permission_role')->insert([
                    'permission_id' => $key++,
                    'role_id' => 1,
                ]);
            }
        }
    }
}
