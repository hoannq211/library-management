@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <div class="container-xxl">
        @if (session('success'))
            <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
        @endif
        <div class="card overflow-hiddenCoupons">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <div class="card-title flex-grow-1">
                    <div>
                        <label for="perPage">Hiển thị:</label>
                        <select id="perPage" class="form-select w-auto d-inline-block">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                        </select>
                    </div>
                </div>

                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                    Thêm Mới Quản Trị
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>Họ Tên</th>
                                <th>Role</th>
                                <th>quyền hạn</th>
                                <th>Điện Thoại</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div
                                                class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->getAvatarAttribute()) }}"
                                                        alt="Avatar" class="avatar-md rounded-3 main-image">
                                                @endif
                                            </div>
                                            <div>
                                                <a href="#!" class="text-dark fw-medium fs-15">{{ $user->name }}</a>
                                                <p class="text-muted mb-0 mt-1 fs-13">{{ $user->email }}</p>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="badge bg-light-subtle text-muted border py-1 px-2">{{ $role->name }}</span>
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach ($user->all_permissions as $permission)
                                            <span
                                                class="badge bg-light-subtle text-muted border py-1 px-2">{{ $permission->name }}</span>
                                        @endforeach

                                    </td>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked1" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#!" class="btn btn-light btn-sm"><iconify-icon
                                                    icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                                    class="align-middle fs-18"></iconify-icon></a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
            <div class="row g-0 align-items-center justify-content-between text-center text-sm-start p-3 border-top">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div> <!-- end card -->

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
