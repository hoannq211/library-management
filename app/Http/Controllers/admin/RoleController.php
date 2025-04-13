<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.list-roles')->with([
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('admin.roles.create-role');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ], [
            'name.required' => 'Vui lòng nhập tên quyền.',
            'name.string' => 'Tên quyền phải là chuỗi ký tự.',
            'name.max' => 'Tên quyền không được dài quá 255 ký tự.',
            'name.unique' => 'Tên quyền đã tồn tại.',
        ]);
        
        Role::create([
            'name' => $validate['name'],
            'can_access_admin' => $request->can_access_admin
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Tạo mới role thành công');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit-role', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validate = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $validate['name']
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Cập nhật quyền thành công');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Xóa quyền thành công');
    }
}
