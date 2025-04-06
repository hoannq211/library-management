<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;
    public function __construct(User $user) {
        $this->model = $user;
    }
    public function all($perPage = 10)
    {
        return $this->model->with([
            'roles' => function($query) {
                $query->select('roles.id', 'roles.name')
                    -> whereNotIn('roles.id', [4]);
            },
            'roles.permissions' => function ($query){
                $query->select('permissions.id', 'permissions.name');
            }
        ])
        ->whereHas('roles', function ($query){
            $query->whereNotIn('roles.id', [4]);
        })
        ->paginate($perPage);
    }
    public function allMember($perPage = 10)
    {
        return $this->model->with([
            'roles' => function($query) {
                $query->select('roles.id', 'roles.name')
                    -> whereIn('roles.id', [4]);
            },
            'roles.permissions' => function ($query){
                $query->select('permissions.id', 'permissions.name');
            }
        ])
        ->whereHas('roles', function ($query){
            $query->whereIn('roles.id', [4]);
        })
        ->paginate($perPage);
    }

    // Lấy người dùng theo ID
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
    // Tạo mới người dùng
    public function create($data)
    {
        return User::create($data);
    }

    // Cập nhật thông tin người dùng
    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    // Xóa người dùng
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
