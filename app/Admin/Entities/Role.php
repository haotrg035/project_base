<?php

namespace Admin\Entities;

use CodeIgniter\Entity;
use Config\Database;

class Role extends Entity
{
    public function getUsers()
    {
        $db = Database::connect();
        $tmpResult = [];
        $tmpResult = $db->table('users')->where('role_id', $this->attributes['id'])->get();
        $db->close();

        return $tmpResult->getResultArray();
    }

    public function getRelatedPermissions()
    {
        $db = Database::connect();
        $permissionModel = model('PermissionModel');
        $_relatedPermissions = $db->table('permission_role')
            ->where('role_id', $this->attributes['id'])->get()->getResultArray();
        $_relatedPermissionIDList = array_map(function ($permission) {
            return $permission['permission_id'];
        }, $_relatedPermissions);

        $permission_group_list = $permissionModel->getGroupPermissions();
        foreach ($permission_group_list as $group => $permissions) {
            $status = '';
            $_groupIDList = array_map(function ($permission) {
                return $permission['id'];
            }, $permissions);
            $_matchComparedElements = array_intersect($_groupIDList, $_relatedPermissionIDList);
            if ($_matchComparedElements === $_groupIDList) {
                $status = 'all';
            } elseif (count($_matchComparedElements) > 0) {
                $status = 'indeterminate';
            } else {
                $status = 'empty';
            }

            $permission_group_list[$group] = [
                'status' => $status,
                'permissions' => $permission_group_list[$group],
                'available_permissions' => $_matchComparedElements
            ];
        }
        $db->close();
        return $permission_group_list;
    }
}
