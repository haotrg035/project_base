<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseResourcePresenter;

class User extends BaseResourcePresenter
{
    protected $modelName = 'Admin\Models\UserModel';
    protected $helpers = ['Admin\Helpers\common'];

    public function index()
    {
        if ($this->request->isAJAX()) {
            $_result = $this->model->getFilteredListUser($this->request->getGet('page'));
            $_result['data'] = $this->renderUserList($_result['data']);
            return json_encode($_result);
        }
        $this->setMeta('Người dùng', 'Quản lý danh sách người dùng');
        $_result = $this->model->getFilteredListUser();
        $_result['data'] = $this->renderUserList($_result['data']);
        $this->data['data']['user'] = $_result;
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
