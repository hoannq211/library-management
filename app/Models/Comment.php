<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment'
    ];

    public function book() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
