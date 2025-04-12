<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $books = Book::with(['uploadFiles', 'category', 'comments'])
                ->withCount('comments')
                ->withAvg('comments', 'rating')
                ->paginate(10);

            return BookResource::collection($books);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi Dữ Liệu',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'quantity_total' => $request->total_quantity,
                'quantity_available' => $request->total_quantity,
                'isbn' => $request->isbn,
                'description' => $request->description,
            ];

            $book = Book::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('upload/books', 'public');
                    $book->uploadFiles()->create([
                        'file_path' => $path,
                        'file_type' => 'image'
                    ]);
                }
            }

            return new BookResource($book);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi Dữ Liệu',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $book = Book::with(['uploadFiles', 'category', 'comments'])
                ->withCount('comments')
                ->withAvg('comments', 'rating')
                ->findOrFail($id);

            return new BookResource($book);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi Dữ Liệu',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {

        try {
            $book = Book::findOrFail($id);

            $data = [
                'title' => $request->title ?? $book->title,
                'category_id' => $request->category_id,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'quantity_total' => $request->total_quantity,
                'quantity_available' => $request->total_quantity,
                'isbn' => $request->isbn,
                'description' => $request->description,
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

            return new BookResource($book);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi Dữ Liệu',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::findOrFail($id);

            foreach ($book->uploadFiles as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            $book->delete();

            return response()->json([
                'message' => 'Xóa Thành Công Books'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi Dữ Liệu',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
