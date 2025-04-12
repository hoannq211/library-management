@extends('client.layouts.main')

@section('content')
    
<main class="main-content">
    <!-- Banner Section -->
    <section class="banner-section mb-5">
        <div class="banner-content">
            <h1 class="banner-title">Chào mừng đến với Thư viện sách</h1>
            <p class="banner-subtitle">Khám phá thế giới tri thức với hàng ngàn đầu sách đa dạng</p>
            <div class="banner-search">
                <input type="text" class="form-control" placeholder="Tìm kiếm sách...">
                <button class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </section>

    <!-- Featured Books -->
    <section class="mb-5">
        <h3 class="section-title">Sách nổi bật</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card book-card modern-card">
                    <img src="images/book1.jpg" class="card-img-top" alt="Sách 1">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 1</h5>
                        <p class="card-text">Tác giả: Tác giả 1</p>
                        <p class="card-text">Nguồn: Tham khảo</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card modern-card">
                    <img src="images/book2.jpg" class="card-img-top" alt="Sách 2">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 2</h5>
                        <p class="card-text">Tác giả: Tác giả 2</p>
                        <p class="card-text">Nguồn: Tham khảo</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card modern-card">
                    <img src="images/book2.jpg" class="card-img-top" alt="Sách 2">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 2</h5>
                        <p class="card-text">Tác giả: Tác giả 2</p>
                        <p class="card-text">Nguồn: Tham khảo</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card modern-card">
                    <img src="images/book3.jpg" class="card-img-top" alt="Sách 3">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 3</h5>
                        <p class="card-text">Tác giả: Tác giả 3</p>
                        <p class="card-text">Nguồn: Tham khảo</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card modern-card">
                    <img src="images/book4.jpg" class="card-img-top" alt="Sách 4">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 4</h5>
                        <p class="card-text">Tác giả: Tác giả 4</p>
                        <p class="card-text">Nguồn: Tham khảo</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-5">
        <h3 class="section-title">Thể loại sách</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card category-card">
                    <div class="card-body text-center">
                        <i class="fas fa-book-open fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Tiểu thuyết</h5>
                        <p class="card-text">100+ sách</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card category-card">
                    <div class="card-body text-center">
                        <i class="fas fa-flask fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Khoa học</h5>
                        <p class="card-text">80+ sách</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card category-card">
                    <div class="card-body text-center">
                        <i class="fas fa-landmark fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Lịch sử</h5>
                        <p class="card-text">60+ sách</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card category-card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Kinh doanh</h5>
                        <p class="card-text">50+ sách</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Books -->
    <section>
        <h3 class="section-title">Sách mới cập nhật</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card book-card">
                    <img src="images/book5.jpg" class="card-img-top" alt="Sách 5">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 5</h5>
                        <p class="card-text">Tác giả: Tác giả 5</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card">
                    <img src="images/book6.jpg" class="card-img-top" alt="Sách 6">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 6</h5>
                        <p class="card-text">Tác giả: Tác giả 6</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card">
                    <img src="images/book7.jpg" class="card-img-top" alt="Sách 7">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 7</h5>
                        <p class="card-text">Tác giả: Tác giả 7</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card book-card">
                    <img src="images/book8.jpg" class="card-img-top" alt="Sách 8">
                    <div class="card-body">
                        <h5 class="card-title">Tên sách 8</h5>
                        <p class="card-text">Tác giả: Tác giả 8</p>
                        <a href="book-detail.html" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection