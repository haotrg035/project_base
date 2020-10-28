<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Role extends BaseConfig
{
    public $permissions = [
        'setting' => [
            'view',
            'update',
        ],
        'user' => [
            'view',
            'create',
            'update',
            'delete',
            'force_delete',
            'restore'
        ],
        'post' => [
            'view',
            'create',
            'update',
            'delete',
            'force_delete',
            'restore'
        ],
        'product' => [
            'view',
            'create',
            'update',
            'delete',
            'force_delete',
            'restore'
        ]
    ];
}
