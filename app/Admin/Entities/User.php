<?php

namespace Admin\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;
use Config\Database;

class User extends Entity
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthday'];
    protected $allowedFields = ['username', 'role_id', 'full_name', 'birthday', 'gender', 'avatar'];

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }

    public function getRole()
    {
        $db = Database::connect();
        if (!empty($roleID)) {
            $role = (array) $db->table('roles')
                ->where('id', $this->attributes['role_id'])->get()->getFirstRow();
            $db->close();
            return $role;
        }
        $db->close();
        return [];
    }

    public function getBirth()
    {
        $timeStamp = Time::createFromFormat(
            'Y-m-d',
            $this->attributes['birthday']
        );
        return $timeStamp->format('d-m-Y');
    }

    public function getPublicData()
    {
        $_result = [];
        foreach ($this->allowedFields as $field) {
            if ($field === 'birthday') {
                $_result[$field] = Time::createFromFormat(
                    'Y-m-d',
                    $this->attributes['birthday']
                )->format('d-m-Y');
                continue;
            }
            $_result[$field] = $this->attributes[$field];
        }
        return $_result;
    }
}
