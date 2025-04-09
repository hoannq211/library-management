<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:1',
            'isbn' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ];
    }

    public function messages(): array 
    {
        return [
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
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'errors' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
