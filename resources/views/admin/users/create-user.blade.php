@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Roles Information</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="users-name" class="form-label">Tên Người Dùng</label>
                                        <input type="text" id="users-name" name="name" class="form-control"
                                            placeholder="Tên Người Dùng">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Email Người Dùng">
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                             <label for="role-role" class="form-label">Role</label>
                                             <select class="form-control" name="roles[]"
                                                 id="choices-multiple-remove-button" data-choices data-choices-removeItem
                                                 multiple>
                                                  @foreach ($roles as $role)
                                                       <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                  @endforeach
                                             </select>
                                         </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Điện Thoại</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="Enter phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="role-permission" class="form-label">Permission</label>
                                        <select class="form-control" name="permissions[]"
                                            id="choices-multiple-remove-button" data-choices data-choices-removeItem
                                            multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="user-name" class="form-label">User Name</label>
                                        <input type="text" id="user-name" name="user_name" class="form-control"
                                            placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>User Status</p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="flexRadioDefault1" value="active" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="flexRadioDefault2" value="inactive">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                In Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer border-top">
                        <button type="submit" class="btn btn-primary">Create Roles</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
