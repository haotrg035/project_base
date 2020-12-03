<?php

namespace Admin\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $returnType = 'Admin\Entities\Role';
    protected $allowedFields = ['name', 'level',];
    protected $validationRules = [
        'id' => 'required',
        'name' => 'required|is_unique[roles.name]',
        'level' => 'required|is_natural_no_zero'
    ];

    public function getListRole(bool $attachPermissionIDs = false)
    {
        // TODO: check current user role to get lower level roles
        $tmpData = $this->findAll();

        if ($attachPermissionIDs) {
            foreach ($tmpData as $key => $role) {
                $tmpData[$key]->relatedPermissions = $role->getRelatedPermissions();
            }
        }

        return $tmpData;
    }

    public function getAllRoleName()
    {
        return array_map(function ($role) {
            return $role->name;
        }, $this->findAll());
    }
}
