<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'quantity_total' => $this->quantity_total,
            'quantity_available' => $this->quantity_available,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'images' => $this->uploadFiles->map(function($file) {
                return [
                    'id' => $file->id,
                    'url' => asset('storage/' . $file->file_path),
                ];
            }),
            'rating' => [
                'average' => $this->comments_avg_rating ?? 0,
                'total_reviews' => $this->comments_count ?? 0,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 