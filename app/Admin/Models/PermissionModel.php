<?php

namespace Admin\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'group'];

    public function getGroupPermissions()
    {
        $data = [];
        $groupList = array_keys(config('Role')->permissions);
        $tmpList = $this->findAll();

        foreach ($groupList as $group) {
            $data[$group] = array_filter($tmpList, function ($permission) use ($group) {
                return $permission['group'] === $group;
            });
        }
        return $data;
    }
}
