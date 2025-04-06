<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['uploadFiles', 'category', 'comments'])
        ->withCount('comments')
        ->withAvg('comments', 'rating')
        ->paginate(10);
        // dd($books);
        return view('admin.books.list-books')->with([
            'books' => $books
        ]);
    }
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.books.create-book')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255', 
            'total_quantity' => 'required|integer|min:1',
            'isbn' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ], [
            'title.required' => 'Vui lòng nhập tên sách.',
            'title.string' => 'Tên sách phải là chuỗi ký tự.',
            'title.max' => 'Tên sách không được dài quá 255 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'author.required' => 'Vui lòng nhập tên tác giả.',
            'publisher.required' => 'Vui lòng nhập nhà xuất bản.',
            'total_quantity.required' => 'Vui lòng nhập tổng số lượng.',
            'total_quantity.integer' => 'Tổng số lượng phải là số nguyên.',
            'total_quantity.min' => 'Tổng số lượng phải lớn hơn hoặc bằng 1.',
            'isbn.unique' => 'ISBN này đã được sử dụng.',
            'isbn.max' => 'ISBN không được dài quá 20 ký tự.',
            'images.*.image' => 'File upload phải là hình ảnh.',
            'images.*.mimes' => 'Hình ảnh chỉ hỗ trợ định dạng: jpeg, png, gif.',
            'images.*.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        $data = [
            'title' => $validate['title'], 
            'category_id' => $validate['category_id'],
            'author' => $validate['author'],
            'publisher' => $validate['publisher'], // Nếu bảng dùng 'publisher_id', cần xử lý thêm
            'quantity_total' => $validate['total_quantity'],
            'quantity_available' => $validate['total_quantity'], // Mặc định bằng total
            'isbn' => $validate['isbn'] ?? null,
            'description' => $validate['description'] ?? null,
        ];

        $book = Book::create($data);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file) {
                $path = $file->store('upload/books', 'public');
                $book->uploadFiles()->create([
                    'file_path' => $path,
                    'file_type' => 'image'
                ]);
            }
        }
        return redirect()->route('admin.books.index')->with([
            'success' => 'Tạo mới thành công'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['uploadFiles', 'category', 'comments'])
        ->withCount('comments')
        ->withAvg('comments', 'rating')
        ->find($id);
        
        return view('admin.books.detail-book')->with([
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with(['uploadFiles', 'category'])->find($id);
        $categories = DB::table('categories')->get();

        return view('admin.books.edit-book')->with([
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255', 
            'total_quantity' => 'required|integer|min:1',
            'isbn' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ], [
            'title.required' => 'Vui lòng nhập tên sách.',
            'title.string' => 'Tên sách phải là chuỗi ký tự.',
            'title.max' => 'Tên sách không được dài quá 255 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'author.required' => 'Vui lòng nhập tên tác giả.',
            'publisher.required' => 'Vui lòng nhập nhà xuất bản.',
            'total_quantity.required' => 'Vui lòng nhập tổng số lượng.',
            'total_quantity.integer' => 'Tổng số lượng phải là số nguyên.',
            'total_quantity.min' => 'Tổng số lượng phải lớn hơn hoặc bằng 1.',
            'isbn.unique' => 'ISBN này đã được sử dụng.',
            'isbn.max' => 'ISBN không được dài quá 20 ký tự.',
            'images.*.image' => 'File upload phải là hình ảnh.',
            'images.*.mimes' => 'Hình ảnh chỉ hỗ trợ định dạng: jpeg, png, gif.',
            'images.*.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);
        
        $book = Book::with(['uploadFiles', 'category'])->find($id);
        
        $data = [
            'title' => $validate['title'],
            'category_id' => $validate['category_id'],
            'author' => $validate['author'],
            'publisher' => $validate['publisher'], // Nếu dùng publisher_id, cần xử lý thêm
            'quantity_total' => $validate['total_quantity'],
            'quantity_available' => $validate['total_quantity'], // Có thể cần logic khác
            'isbn' => $validate['isbn'],
            'description' => $validate['description'],
        ];

        $book->update($data);
        
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $fileId) {
                $file = $book->uploadFiles()->find($fileId);
                if ($file) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                }
            }
        }
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('upload/books', 'public');
                $book->uploadFiles()->create([
                    'file_path' => $path,
                    'file_type' => 'image'
                ]);
            }
        }

        return redirect()->route('admin.books.edit', $book->id)->with([
            'success' => 'update dữ liệu thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::with(['uploadFiles'])->findOrFail($id);
    
        $book->delete(); // Xóa mềm sách

        return redirect()->route('admin.books.index')->with('success', 'Sách đã được xóa thành công!');
    }

    public function restore(string $id)
    {
        $book = Book::withTrashed()->findOrFail($id);
        $book->restore(); 

        return redirect()->route('admin.books.index')->with('success', 'Đã khôi phục sách thành công.');
    }

    public function forceDelete(string $id)
    {
        $book = Book::withTrashed()->findOrFail($id);

        foreach ($book->uploadFiles as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $book->forceDelete();
        return redirect()->route('admin.books.archive')->with('success', 'Đã xóa sách vĩnh viễn.');
    }
}
