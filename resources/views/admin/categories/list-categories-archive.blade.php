@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="rounded bg-secondary-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-1.png') }}" alt=""
                                class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Fashion Categories</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="rounded bg-primary-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-6.png') }}" alt=""
                                class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Electronics Headphone</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="rounded bg-warning-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-7.png') }}" alt=""
                                class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Foot Wares</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="rounded bg-info-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-9.png') }}" alt=""
                                class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Eye Ware & Sunglass</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <div class="card-title flex-grow-1">
                            <label for="perPage">Danh Sách Danh Mục:</label>
                            <select id="perPage" class="form-select w-auto d-inline-block">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                            </select>
                        </div>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                            Thêm Danh Mục
                        </a>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Danh Mục</th>
                                        <th>Mô Tả</th>
                                        <th>ID</th>
                                        <th>Số lương sách</th>
                                        <th>Chức Năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryArchive as $category)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/' . $category->getImageAttribute()) }}"
                                                            alt="" class="avatar-md">
                                                    </div>
                                                    <p class="text-dark fw-medium fs-15 mb-0">{{ $category->name }}</p>
                                                </div>

                                            </td>
                                            <td>{{ $category->description }}</td>
                                            <td>{{ $category->id }}</td>
                                            <td class="text-center">{{ $category->books_count }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" class="btn btn-light btn-sm"><iconify-icon
                                                            icon="solar:eye-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                    <form action="{{ route('admin.categories.restore', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc muốn khôi phục không')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-soft-primary btn-sm">
                                                            <iconify-icon icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.categories.forceDelete', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc muốn xóa hay không')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon>
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
                            {{ $categoryArchive->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('perPage').addEventListener('change', function() {
            const perPage = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            window.location.href = url.href; // Chuyển hướng với tham số mới
        });
    </script>
@endpush
