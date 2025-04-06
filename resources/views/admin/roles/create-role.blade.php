@extends('admin.layouts.main')

@section('title', 'Tạo mới Quyền')

@section('content')

<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Mới Quyền Truy Cập</h4>
                </div>
                @if (session('success'))
                    <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="roles-name" class="form-label">Tên Quyền</label>
                                    <input type="text" id="roles-name" name="name" class="form-control"
                                        placeholder="Tên Quyền Truy Cập" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Tạo Quyền Truy Cập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
