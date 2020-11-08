<?php

namespace Admin\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    protected $modelName = 'Admin\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        // if ($this->request->isAJAX()) {
            $_result = $this->model->getFilteredListUser(
                $this->request->getGet('current') ?? 1,
                json_decode($this->request->getGet('filters'), true),
                [
                    'field' => $this->request->getGet('sortField') ?? 'id',
                    'order' => $this->request->getGet('sortOrder') ?? 'asc',
                ],
                '',
                $this->request->getGet('pageSize') ?? 10,
            );

            $_result['data'] = $this->renderUserList($_result['data']);
            return $this->respond($_result);
        // }
        // return $this->response->redirect('/');
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
