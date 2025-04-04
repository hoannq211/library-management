<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'publisher',
        'description',
        'isbn',
        'quantity_total',
        'quantity_available'
    ];

    public function uploadFiles () {
        return $this->morphMany(UploadFile::class, 'target');
    }

    public function category () {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function comments () {
        return $this->hasMany(Comment::class, 'book_id');
    }
}
