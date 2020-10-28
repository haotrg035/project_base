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

    public function getListRole()
    {
        // TODO: check current user role to get lower level roles
        $tmpData = $this->findAll();
        return $tmpData;
    }
}
