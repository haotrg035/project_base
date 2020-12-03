<?php

namespace Admin\Models;

use CodeIgniter\Model;

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
    public function getFilteredListUser(
        int $page = 1,
        array $filters = [],
        array $sort = [],
        string $search = '',
        int $rowCount = 10
    ): array {
        $query = $this;

        if (!empty($filters)) {
            $query = $this->filterResult($filters, $query);
        }

        if (!empty($sort['field'])) {
            if (empty(trim($sort['order'])) || $sort['order'] === 'ascend') {
                $sort['order'] = 'ASC';
            } else {
                $sort['order'] = 'DESC';
            }
        } else {
            $sort = [
                'field' => 'id',
                'order' => 'desc'
            ];
        }
        $_resultCount = $query->countAllResults(false);
        $_result = $query->orderBy($sort['field'], $sort['order'])
            ->paginate($rowCount, 'default', $page);

        return [
            'total' => $_resultCount,
            'current' => $page,
            'data' => $_result
        ];
    }

    protected function filterResultByRole(array $roleFilterParams, UserModel $modelInstance): UserModel
    {
        $roleModel = model('Admin\RoleModel');
        $roleList = $roleModel->findAll();

        $_selectedRole = [];
        foreach ($roleFilterParams as $filterValue) {
            foreach ($roleList as $role) {
                if ($role->name === $filterValue) {
                    $_selectedRole[] = $role->id;
                }
            }
        }
        // debug($_selectedRole);
        return $modelInstance->whereIn('role_id', $_selectedRole);
    }

    protected function filterResult(array $filters, UserModel $modelInstance): UserModel
    {
        $_modelInstance = $modelInstance;
        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                switch ($key) {
                    case 'role':
                        $_modelInstance = $this->filterResultByRole($value, $modelInstance);
                        break;
                    case 'gender':
                        if ($value === 1 || $value === 'male') {
                            $_modelInstance = $modelInstance->where('gender', 1);
                        }
                        if ($value === 2 || $value === 'female') {
                            $_modelInstance = $modelInstance->where('gender', 2);
                        }
                        break;
                }
            }
        }
        return $_modelInstance;
    }
}
