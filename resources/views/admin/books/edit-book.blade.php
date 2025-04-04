@extends('admin.layouts.main')

@section('title', 'edit book')

@section('content')
    
<div class="container-xxl">
     <div class="row">
         <div class="col-xl-12 col-lg-12">
               @if (session('success'))
                    <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
               @endif
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">Chỉnh Sửa Sách</h4>
                 </div>
                 <div class="card-body">
                    <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="book-title" class="form-label">Tên Sách</label>
                                    <input type="text" id="book-title" name="title" class="form-control" placeholder="Items title" value="{{ old('title', $book->title) }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="book-categories" class="form-label">Danh Mục</label>
                                <select class="form-control" id="book-categories" name="category_id" data-choices data-choices-groups data-placeholder="Select Categories">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="book-author" class="form-label">Tác giả</label>
                                    <input type="text" id="book-author" name="author" class="form-control" placeholder="Nhập tên tác giả" value="{{ old('author', $book->author) }}">
                                    @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="book-publisher" class="form-label">Nhà xuất bản</label>
                                    <input type="text" id="book-publisher" name="publisher" class="form-control" placeholder="Nhập tên nhà xuất bản" value="{{ old('publisher', $book->publisher) }}">
                                    @error('publisher')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="book-total-quantity" class="form-label">Tổng số lượng</label>
                                    <input type="text" id="book-total-quantity" name="total_quantity" class="form-control" placeholder="Nhập tổng số lượng" value="{{ old('total_quantity', $book->quantity_total) }}">
                                    @error('total_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="book-isbn" class="form-label">ISBN</label>
                                    <input type="text" id="book-isbn" name="isbn" class="form-control" placeholder="Nhập isbn" value="{{ old('isbn', $book->isbn) }}">
                                    @error('isbn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="book-image" class="form-label">Hình Ảnh</label>
                                    <input type="file" id="book-image" name="images[]" multiple class="form-control">
                                    @error('images.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                    
                                    <!-- Hiển thị và chọn xóa hình ảnh hiện tại -->
                                    @if ($book->uploadFiles && $book->uploadFiles->isNotEmpty())
                                        <div class="mt-2">
                                            <p class="form-label">Ảnh hiện tại:</p>
                                            @foreach ($book->uploadFiles as $file)
                                                <div class="d-inline-block position-relative" style="margin-right: 10px;">
                                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="Book Image" style="max-width: 100px;">
                                                    <div class="form-check mt-1">
                                                        <input type="checkbox" name="delete_images[]" value="{{ $file->id }}" class="form-check-input" id="delete_image_{{ $file->id }}">
                                                        <label class="form-check-label" for="delete_image_{{ $file->id }}">Xóa</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7" placeholder="Short description about the book">{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-3">
                                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary w-100">Quay lại danh sách</a>
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
 </div>

@endsection