<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenController extends Controller
{
    public function login () {

        return view('client.authen.login');
    }

    public function postLogin(Request $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->has('remember');

        if(Auth::attempt($data, $remember)){
            Session::where('user_id', Auth::id())->delete();
            // Tạo phiên đăng nhập mới.
            session()->push('user_id', Auth::id());

            $user = User::find(Auth::id());
            if ($user->roles()->whereIn('roles.id', [1, 2, 3])->exists()) {
                return redirect()->route('admin.dashboard')->with([
                    'success' => 'Đăng nhập thành công'
                ]);
            } else {
                return redirect()->route('client.dashboard')->with([
                    'success' => 'Đăng nhập thành công'
                ]);
            }
        }else{
            return redirect()->back()->withInput()->with([
                'error' => 'email hoặc password không đúng'
            ]);
        }
    }
    public function register () {

        return view('client.authen.register');
    }

    public function postRegister(Request $request) {
        $check = User::where('email', $request->email)->exists();
        if($check) {
            return redirect()->back()->with([
                'message' => 'Email đã tồn tại'
            ]);
        }else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ];
            $newUser = User::create($data);

            $newUser->roles()->attach(4);
            return redirect()->route('auth.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
        }
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('auth.login')->with([
            'success' => 'đăng xuất thành công'
        ]);
    }


}
