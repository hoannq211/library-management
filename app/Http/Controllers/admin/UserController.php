<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $users = $this->userService->getAllUsersByAdmin($perPage);

        return view('admin.users.list-users')->with([
            'users' => $users
        ]);
    }

    public function listMember(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $members = $this->userService->getAllUsersByMember($perPage);

        return view('admin.users.list-member')->with([
            'members' => $members
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create-user')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $this->userService->create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Tạo mới người dùng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.detail-user')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        $roles = Role::all();
        return view('admin.users.edit-user')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = $this->userService->updateUser($id, $validated);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userService->deleteUser($id);
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Xóa người dùng thành công');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', $e->getMessage());
        }
    }
}
