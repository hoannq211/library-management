<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.html">Thư viện sách</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="books.html">Tất cả sách</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.html">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.html">Tìm kiếm nâng cao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Liên hệ</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-primary me-2">Đăng nhập</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary">Đăng ký</a>
                @else
                    <div class="dropdown ">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '' }}"
                                alt="Avatar" class="rounded-circle" width="40" height="40">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Hồ sơ cá nhân</a></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</nav>
