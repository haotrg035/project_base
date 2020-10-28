<?php

namespace Admin\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;
use Config\Database;

class User extends Entity
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthday'];

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }

    public function getRole()
    {
        $db = Database::connect();
        $roleID = $db->table('role_user')->select('role_id')
            ->where('user_id=', $this->attributes['id'])->get()->getFirstRow();
        if (!empty($roleID)) {
            $role = (array) $db->table('roles')
                ->where('id', $roleID->role_id)->get()->getFirstRow();
            $db->close();
            return $role;
        }
        $db->close();
        return [];
    }

    public function getBirth()
    {
        $timeStamp = Time::createFromFormat('Y-m-d', $this->attributes['birthday']);
        return $timeStamp->format('d/m/Y');
    }

}