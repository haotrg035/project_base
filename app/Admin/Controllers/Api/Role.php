<?php

namespace Admin\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Role extends ResourceController
{
    protected $modelName = 'Admin\Models\RoleModel';
    protected $format = 'json';

    public function index()
    {
        $_result = $this->model->getListRole(true);

        return $this->respond($_result);
    }

    public function edit($id = null)
    {
    }
}
