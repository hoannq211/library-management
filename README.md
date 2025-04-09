# 📚 Tổng hợp kiến thức học được từ Xưởng

## 1. Kiến thức về Laravel
- Biết cách sử dụng **artisan** để tạo model, migration, controller nhanh chóng.
- Hiểu rõ vòng đời của một request trong Laravel.
- Biết cách sử dụng **Route – Controller – View** để xử lý luồng dữ liệu.

## 2. Migration, Seeder, Factory
- Tạo bảng bằng migration, dễ dàng cập nhật lại cấu trúc DB.
- Seeder giúp tạo dữ liệu mẫu nhanh để test.
- Factory tạo dữ liệu giả, kết hợp tốt với Seeder.
```php
public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('publisher')->nullable(); // Thay vì bảng publishers
            $table->text('description')->nullable();
            $table->string('isbn')->nullable();
            $table->integer('quantity_total');
            $table->integer('quantity_available')->nullable();
            $table->timestamps();
        });
    }
```
```php
class BookFactory extends Factory
{
    protected $model = Book::class;
    public function definition(): array
    {
        $quantityTotal = $this->faker->numberBetween(1, 10);
        return [
            'title' => $this->faker->sentence(3), // VD: "Lập trình PHP cơ bản"
            'author' => $this->faker->name(),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'publisher' => $this->faker->company(), // VD: "NXB Kim Đồng"
            'description' => $this->faker->paragraph(),
            'isbn' => $this->faker->optional()->isbn13(), // Có thể null
            'quantity_total' => $quantityTotal,
            'quantity_available' => $this->faker->numberBetween(0, $quantityTotal),
        ];
    }
}
```
```php
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory()->count(20)->create();
    }
}

```

## 3. Eloquent & Quan hệ Model giữa các bảng
- Áp dụng thành thạo các quan hệ:
  - `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`
- Sử dụng Eloquent để lấy dữ liệu linh hoạt với `with()`, `load()`.

Sử dụng Eloquent lấy dữ liệu với with, sử dụng withCount,withAvg,...
```php
public function listBookArchive()
    {
        $bookArchive = Book::with(['uploadFiles', 'category', 'comments'])
        ->withCount('comments')
        ->withAvg('comments', 'rating')
        ->onlyTrashed()
        ->paginate(10);
        // dd($books);
        return view('admin.books.list-books-archive')->with([
            'bookArchive' => $bookArchive
        ]);
    }

```
Quan Hệ giữa bảng user với bảng roles, upload_files
```php
public function roles () {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }
    public function uploadFiles () {
        return $this->morphMany(UploadFile::class, 'target');
    }
```
## 4. Query Builder trong Laravel
- Sử dụng `DB::table()` để thao tác dữ liệu.
- Một số phương thức phổ biến:
  - `select()`, `where()`, `orWhere()`, `join()`, `orderBy()`, `groupBy()`, `having()`, `limit()`, `offset()`
  - Ví dụ:
    ```php
    DB::table('users')->where('age', '>', 20)->get();
    ```

## 5. Query Builder nâng cao
- Kết hợp điều kiện logic phức tạp:
  ```php
  DB::table('products')
    ->where('status', 'active')
    ->where(function($query) {
        $query->where('price', '>', 100000)
              ->orWhere('category_id', 5);
    })
    ->get();
  ```

## 6. Kết hợp Service – Repository – Controller
Repository: Truy vấn dữ liệu (Eloquent/Query Builder)
```php
public function all($perPage = 10)
    {
        return $this->model->with([
            'roles' => function($query) {
                $query->select('roles.id', 'roles.name')
                    -> whereNotIn('roles.id', [4]);
            },
            'roles.permissions' => function ($query){
                $query->select('permissions.id', 'permissions.name');
            }
        ])
        ->whereHas('roles', function ($query){
            $query->whereNotIn('roles.id', [4]);
        })
        ->paginate($perPage);
    }
```
Service: Xử lý logic nghiệp vụ, gọi repository
Controller: Điều phối, gọi service
## 7. Một số kỹ thuật tối ưu truy vấn & bảo mật trong Laravel

### 🔍 Tối ưu hóa truy vấn và cơ sở dữ liệu
- Khắc phục **vấn đề N+1** bằng `with()` và `load()` (Eager/Lazy Loading).
- Dùng **Pagination** thay cho `get()` hoặc `all()` để giảm tải dữ liệu.
- Áp dụng **Raw Query**, **Subquery**, hoặc `EXPLAIN` để phân tích truy vấn phức tạp.
- Sử dụng **Index**, `OPTIMIZE TABLE` để cải thiện tốc độ truy vấn.
- Dùng `remember()` hoặc `cache()` để **cache dữ liệu** truy vấn lặp lại.

### 🧱 Tối ưu bảng và chỉ số
- Tạo **index/unique** bằng migration:
  ```php
  $table->index('email');
  $table->unique('username');
  ```
- Hiểu và sử dụng các loại chỉ số: `PRIMARY`, `UNIQUE`, `INDEX`, `FULLTEXT`.
- Sử dụng `EXPLAIN` để phân tích hiệu suất truy vấn:
  ```php
  DB::select(DB::raw('EXPLAIN SELECT * FROM users WHERE email = ?'), [$email]);
  ```

### 🔐 Quản lý quyền và bảo mật
- Sử dụng **Gate** và **Policy** để kiểm soát quyền truy cập.
- Bảo vệ khỏi **SQL Injection** bằng Query Builder hoặc Eloquent.
- Sử dụng **Middleware** để phân quyền theo vai trò.
- Mã hóa mật khẩu bằng `bcrypt()` và ẩn dữ liệu nhạy cảm với `$hidden`.
- Tích hợp **Spatie Laravel Permission** để phân quyền nâng cao.

### ✅ Thực hành áp dụng
- Tối ưu truy vấn thực tế trong dự án.
- Phân quyền CRUD theo vai trò `Admin` và `User`.
