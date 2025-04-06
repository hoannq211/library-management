@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Roles Information</h4>
                    </div>
                    <!-- resources/views/admin/users/create-user.blade.php -->
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="users-name" class="form-label">Tên Người Dùng</label>
                                        <input type="text" id="users-name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}" placeholder="Tên Người Dùng">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" placeholder="Email Người Dùng">
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
                                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mật khẩu (Để trống nếu không thay
                                            đổi)</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Nhập mật khẩu mới">
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
                                            value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" id="address" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ">
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
                                        @if ($user->getAvatarAttribute())
                                            <div class="mb-2 mt-2">
                                                <img src="{{ asset('storage/' . $user->getAvatarAttribute()) }}"
                                                    alt="Avatar" class="img-thumbnail" class="rounded-3" width="100">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-3">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-outline-secondary w-100">Quay
                                        lại danh sách</a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
