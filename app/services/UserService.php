<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers($perPage)
    {
        return $this->userRepository->all($perPage);
    }

    // Lấy người dùng theo ID
    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    // Lấy người dùng theo email
    public function getUserByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    // Đăng ký tài khoản mới
    public function registerUser($data)
    {
        // Mã hóa mật khẩu trước khi lưu vào database
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    // Cập nhật thông tin người dùng
    public function updateUser($id, $data)
    {
        // Kiểm tra xem có cập nhật mật khẩu không
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }

    // Xóa tài khoản người dùng
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    // Xác thực đăng nhập
    public function authenticate($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}
