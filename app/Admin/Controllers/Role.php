<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseResourcePresenter;
use Admin\Models\RoleModel;

class Role extends BaseResourcePresenter
{
    protected $modelName = 'Admin\Models\RoleModel';
    protected $helpers = ['Admin\Helpers\common'];

    public function index()
    {

        $this->setMeta('Phân Quyền', 'Quản lý quyền hạn các loại tài khoản');
        return view('Admin\Views\Pages\Role\index', $this->data);
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
