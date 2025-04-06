@extends('admin.layouts.main')

@section('title', 'Danh sách quyền')

@section('content')

    <div class="container-xxl">

        @if (session('success'))
            <span class="alert alert-success d-block mt-2">{{ session('success') }}</span>
        @endif
        <div class="card overflow-hiddenCoupons">

            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">Quản lý quyền</h4>

                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
                    Thêm mới quyền
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>Họ Tên</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                class="btn btn-soft-primary btn-sm">
                                                <iconify-icon icon="solar:pen-2-broken"
                                                    class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <form onsubmit="return confirm('Bạn có chắc muốn xóa hay không')"
                                                action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-soft-primary btn-sm">
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
                {{ $roles->links('pagination::bootstrap-5') }}
            </div>
        </div> <!-- end card -->

    </div>

@endsection
