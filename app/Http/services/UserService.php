<?php

namespace App\Http\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsersByAdmin($perPage)
    {
        return $this->userRepository->all($perPage);
    }
    public function getAllUsersByMember($perPage)
    {
        return $this->userRepository->allMember($perPage);
    }

    // Lấy người dùng theo ID
    public function getUserById($id)
    {
        if (!$id) {
            return redirect()->route('admin.users.index')->with('error', 'Không tìm thấy người dùng');
        }
        return $this->userRepository->find($id);
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);

        // Tạo user
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        // Gắn roles
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        // Xử lý upload avatar nếu có
        if (isset($data['avatar'])) {
            $filePath = $data['avatar']->store('upload/avatars', 'public');

            $user->uploadFiles()->create([
                'file_path' => $filePath,
                'file_type' => 'image',
                'uploaded_by' => Auth::id(),
            ]);
        }

        return $user;
    }

    // Đăng ký tài khoản mới


    // Cập nhật thông tin người dùng
    public function updateUser($id, $data)
    {
        $user = $this->getUserById($id);

        // Xử lý mật khẩu
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Không đổi thì không gửi đi
        }

        $user = $this->userRepository->update($id, [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? $user->password,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }
        if (!empty($data['avatar'])) {
            $oldAvatar = $user->uploadFiles()->where('file_type', 'image')->first();

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar->file_path);
                $oldAvatar->delete();
            }
            $filePath = $data['avatar']->store('upload/avatars', 'public');

            $user->uploadFiles()->create([
                'file_path' => $filePath,
                'file_type' => 'image',
                'uploaded_by' => Auth::id(),
            ]);
            
        }
        return $user;
    }


    // Xóa tài khoản người dùng
    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        $oldAvatar = $user->uploadFiles()->where('file_type', 'image')->first();

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar->file_path);
                $oldAvatar->delete();
            }
        if (Auth::id() === $id) {
            throw new \Exception('Bạn không thể xóa chính mình!');
        }

        return $this->userRepository->delete($id);
    }
}
