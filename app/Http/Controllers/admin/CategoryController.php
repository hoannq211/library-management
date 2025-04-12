<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $categories = Category::with(['books', 'uploadFiles'])
            ->withCount('books')
            ->paginate($perPage);
        return view('admin.categories.list-categories')->with([
            'categories' => $categories
        ]);
    }

    public function listCategoryArchive(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $categoryArchive = Category::with(['books', 'uploadFiles'])
            ->withCount('books')
            ->onlyTrashed()
            ->paginate($perPage);
        return view('admin.categories.list-categories-archive')->with([
            'categoryArchive' => $categoryArchive
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.categories.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên sách.',
            'name.string' => 'Tên sách phải là chuỗi ký tự.',
            'name.max' => 'Tên sách không được dài quá 100 ký tự.',
            'image.image' => 'File upload phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh chỉ hỗ trợ định dạng: jpeg, png, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);
        $data = [
            'name' => $validate['name'],
            'description' => $validate['description'] ?? null,
        ];

        $category = Category::create($data);
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('upload/categories', 'public');

            $category->uploadFiles()->create([
                'file_path' => $filePath,
                'file_type' => 'image',
                'uploaded_by' => Auth::id(),
            ]);
        }
        return redirect()->route('admin.categories.index')->with([
            'success' => 'Tạo mới thành công'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::with(['uploadFiles'])->findOrFail($id);
        return view('admin.categories.edit-category')->with([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' . $id,
        ]);

        try {
            $data = [
                'name' => $validate['name'],
                'description' => $validate['description'],
            ];

            if ($request->hasFile('image')) {
                $oldImage = $category->uploadFiles()->firstWhere('file_type', 'image');

                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage->file_path);
                    $oldImage->delete();
                }
                $file_path = $request->file('image')->store('upload/categories', 'public');

                $category->uploadFiles()->create([
                    'file_path' => $file_path,
                    'file_type' => 'image',
                    'uploaded_by' => Auth::id(),
                ]);
            }

            $category->update($data);

            return redirect()->route('admin.categories.edit', $category->id)
                ->with('success', 'Danh mục đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Đã có lỗi xảy ra khi cập nhật danh mục.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::with(['uploadFiles'])->findOrFail($id);

        $category->delete(); // Xóa mềm Danh mục

        return redirect()->route('admin.categories.index')->with('success', 'Sách đã được xóa thành công!');
    }
    public function restore(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index')->with('success', 'Đã khôi phục sách thành công.');
    }

    public function forceDelete(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        foreach ($category->uploadFiles as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $category->forceDelete();
        return redirect()->route('admin.categories.archive')->with('success', 'Đã xóa sách vĩnh viễn.');
    }
}
