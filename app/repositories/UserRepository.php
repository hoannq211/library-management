<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;
    public function __construct(User $user) {
        $this->model = $user;
    }
    public function all($perPage = 10)
    {
        return $this->model->with(['roles.permissions'])
        ->whereHas('roles', function ($query){
            $query->whereIn('roles.id', [1,2,3]);
        })
        ->paginate($perPage);
    }

    // Lấy người dùng theo ID
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Lấy người dùng theo email
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    // Tạo mới người dùng
    public function create($data)
    {
        return User::create($data);
    }

    // Cập nhật thông tin người dùng
    public function update($id, $data)
    {
        $user = User::find($id);
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
