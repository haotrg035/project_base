<?php

namespace Admin\Models;

use CodeIgniter\Model;
use Config\Database;

class UserModel extends Model
{
    // protected $DBGroup = 'group_name';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'Admin\Entities\User';
    protected $allowedFields = ['username', 'full_name', 'birthday', 'gender', 'avatar'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $validationRules = [
        'username' => 'required|alpha_numeric_space|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'pass_confirm' => 'required_with[password]|matches[password]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
    ];
    protected $skipValidation = false;
    public $allowedFilterFields = [
        'role' => FILTER_SANITIZE_STRING,
        'gender' => FILTER_SANITIZE_STRING,
    ];
    public $allowedSortFields = ['id', 'username', 'birthday'];

    public function getAllowedFilterFields(): array
    {
        return $this->allowedFilterFields;
    }
    public function getAllowedSortFields(): array
    {
        return $this->allowedSortFields;
    }

    /**
     * Return a list of user filterd by some confitions, sorts,...
     *
     * @param integer $page the page num of paginated list
     * @param array $filters the filter confition of list
     * @param array $sort the sort rule
     * @param string $search search condition (user name and full name only)
     * @param integer $rowCount total of row returned.
     * @return void list of user entities
     */
    public function getFilteredListUser(int $page = 1, array $filters = [], array $sort = [], string $search = '', int $rowCount = 10): array
    {
        $tempResult = $this;
        if (!empty($search)) {
            $tempResult = $tempResult->like('username', $search)->orLike('full_name', $search);
        }
        if (!empty($filters)) {
            $db = Database::connect();
            foreach ($filters as $key => $value) {
                if (!empty($value)) {
                    switch ($key) {
                        case 'role':
                            if ($value !== 'all') {
                                if (in_array($value, config('Constant')->roleList)) {
                                    $roleModel = model('RoleModel');
                                    $selectedRole = $roleModel->where('name', strtolower($value))
                                        ->get()->getCustomResultObject('App\Entities\Role')[0];
                                    $listUserID = associative_to_flat($selectedRole->getUsers(), 'user_id');
                                    $tempResult = $tempResult->whereIn('id', $listUserID);
                                }
                            }
                            break;
                        case 'gender':
                            if ($value === 1 || $value === 'male') {
                                $tempResult = $tempResult->where('gender', 1);
                            }
                            if ($value === 2 || $value === 'female') {
                                $tempResult = $tempResult->where('gender', 2);
                            }
                            break;
                    }
                }
            }
            $db->close();
        }

        if (!empty($sort)) {
            if (empty($sort['order'])) {
                $sort['order'] = 'asc';
            }
            $tempResult = $tempResult->orderBy($sort['field'], $sort['order']);
        }  
        $result = [
            'total' => $tempResult->countAll(),
            'page' => $page,
            'data' => $tempResult->paginate($rowCount, 'default', $page)
        ];
        
        return $result;
    }
}
