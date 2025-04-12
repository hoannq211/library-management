@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="assets/images/product/p-1.png" alt="" class="avatar-xxl">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Mới Danh Mục</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="categories-name" class="form-label">Tên Danh Mục</label>
                                        <input type="text" id="categories-name" name="name" class="form-control"
                                            placeholder="Tên Danh Mục" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="book-image_category" class="form-label">Hình Ảnh</label>
                                        <input type="file" id="book-image_category" name="image" multiple class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>
                                        <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7" placeholder="Short description about the book">{{ old('description') }}</textarea>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 bg-light mb-3 rounded">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-2">
                                        <a href="#!" class="btn btn-outline-secondary w-100">Quay lại</a>
                                    </div>
                                    <div class="col-lg-2">
                                        <button href="#!" class="btn btn-primary w-100">Tạo Mới</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
@endsection