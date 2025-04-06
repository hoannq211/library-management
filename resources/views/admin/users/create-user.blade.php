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
                    <!-- resources/views/admin/users/create-user.blade.php -->
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="users-name" class="form-label">Tên Người Dùng</label>
                                        <input type="text" id="users-name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Tên Người Dùng">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Email Người Dùng">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="role-role" class="form-label">Role</label>
                                        <select class="form-control @error('roles') is-invalid @enderror" name="roles[]"
                                            id="choices-multiple-remove-button" data-choices data-choices-removeItem
                                            multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Nhập mật khẩu">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Điện Thoại</label>
                                        <input type="text" id="phone" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" id="address" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address') }}" placeholder="Nhập địa chỉ">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Xác nhận mật khẩu">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Ảnh đại diện</label>
                                        <input type="file" id="avatar" name="avatar"
                                            class="form-control @error('avatar') is-invalid @enderror">
                                        @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Tạo Nhân Viên</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
