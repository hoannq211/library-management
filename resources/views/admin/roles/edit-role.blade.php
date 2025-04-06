@extends('admin.layouts.main')

@section('title', 'Chỉnh sửa quyền')
    
@section('content')
    
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh Sửa Quyền Truy Cập</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="roles-name" class="form-label">Tên Quyền</label>
                                    <input type="text" id="roles-name" name="name" class="form-control"
                                        placeholder="Tên Quyền Truy Cập" value="{{ old('name', $role->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Cập Nhật Quyền Truy Cập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection