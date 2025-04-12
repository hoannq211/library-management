<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthLoginRequest;
use App\Http\Requests\API\AuthRegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenController extends Controller
{

    public function postLogin(AuthLoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->has('remember');

        try {
            if (Auth::attempt($data, $remember)) {
                $user = User::find(Auth::id());
                $user->tokens()->delete();
                if ($user->roles()->whereIn('roles.id', [1, 2, 3])->exists()) {
                    $token = $user->createToken($user->name, ['admin-access'])->plainTextToken; // Token với quyền admin
                } else {
                    $token = $user->createToken($user->name, ['user-access'])->plainTextToken; // Token với quyền user
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công',
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không đúng',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau',
            ], 500);
        }
    }

    public function register(AuthRegisterRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
            ];
            $newUser = DB::transaction(function () use ($data) {
                $user = User::create($data);
                $role = Role::where('name', Role::DEFAULT_ROLE)->firstOrFail();
                $user->roles()->attach($role->id);
                return $user;
            });
            $token = $newUser->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'token' => $token
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            request()->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false, 
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
