@extends('admin.layouts.main')

@section('title', 'list book')

@push('styles')
<style>
    .main-image { cursor: pointer; } /* Con trỏ cho biết có thể nhấp */
    
</style>
@endpush
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                @if (session('success'))
                    <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
               @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Thư viện sách</h4>

                        <a href="{{ route('admin.books.create') }}" class="btn btn-sm btn-primary">
                            Thêm Mới sách
                        </a>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Tên, tác giả, nhà xuất bản</th>
                                        <th>Danh Mục</th>
                                        <th>Tổng số lượng</th>
                                        <th>số lượng khả dụng</th>
                                        <th>Rating</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <!-- Ảnh chính (chỉ hiển thị ảnh đầu tiên) -->
                                                        {{-- {{ asset('storage/' . $file->file_path) }} --}}
                                                        @if ($book->uploadFiles->where('file_type', 'image')->first())
                                                            <img src="{{ asset('storage/' . $book->uploadFiles->where('file_type', 'image')->first()->file_path) }}" 
                                                                 alt="{{ $book->title }}" 
                                                                 class="avatar-md rounded-3 main-image" 
                                                                 data-bs-toggle="modal" 
                                                                 data-bs-target="#imageModal{{ $book->id }}">
                                                        @endif
                                                    </div>
                                                    <!-- Modal chứa danh sách ảnh -->
                                                    <div class="modal fade" id="imageModal{{ $book->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $book->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel{{ $book->id }}">Ảnh của {{ $book->title }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex flex-wrap">
                                                                        @forelse ($book->uploadFiles->where('file_type', 'image') as $file)
                                                                            <img src="{{ asset('storage/' . $file->file_path) }}" 
                                                                                 alt="{{ $book->title }}" 
                                                                                 class="rounded-3" 
                                                                                 style="max-width: 150px; margin: 5px;">
                                                                        @empty
                                                                            <p>Không có ảnh nào</p>
                                                                        @endforelse
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="#!" class="text-dark fw-medium fs-15">{{ $book->title }}</a>
                                                        <p class="text-muted mb-0 mt-1 fs-13"><span>{{ $book->author }}</span> / {{ $book->publisher }}</p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>{{ $book->category->name }}</td>
                                            <td>
                                                <p class="mb-1 text-muted">{{ $book->quantity_total }}</p>
                                            </td>
                                            <td> {{ $book->quantity_available }}</td>
                                            <td> <span class="badge p-1 bg-light text-dark fs-12 me-1"><i
                                                        class="bx bxs-star align-text-top fs-14 text-warning me-1"></i>
                                                    {{ number_format($book->comments_avg_rating ?? 0,1) }}</span> {{ $book->comments_count}} đánh giá</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-light btn-sm"><iconify-icon
                                                            icon="solar:eye-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-soft-primary btn-sm"><iconify-icon
                                                            icon="solar:pen-2-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                    <form  action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                                            onsubmit="return confirm('Bạn có chắc muốn xóa hay không')" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-soft-danger btn-sm">
                                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                </button>
                                                    </form>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            {{ $books->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')

@endpush