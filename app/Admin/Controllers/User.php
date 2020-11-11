<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseResourcePresenter;
use Admin\Models\RoleModel;

class User extends BaseResourcePresenter
{
    protected $modelName = 'Admin\Models\UserModel';
    protected $helpers = ['Admin\Helpers\common'];

    public function index()
    {
        $roleModel = new RoleModel();

        $this->setMeta('Người Dùng', 'Quản lý danh sách người dùng');
        $this->data['role_list'] = $roleModel->getListRole(true);
        return view('Admin\Views\Pages\User\index', $this->data);
    }

    protected function renderUserList($rawData): array
    {
        return array_map(function ($item) {
            $_user = $item->toArray();
            $_user['birthday'] = $item->getBirth();
            $_user['role'] = $item->getRole();
            return $_user;
        }, $rawData);
    }
}
