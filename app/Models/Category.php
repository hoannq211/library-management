<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use SoftDeletes;
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description'
    ];

    public function books () {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function uploadFiles () {
        return $this->morphMany(UploadFile::class, 'target');
    }
    public function getImageAttribute()
    {
        return $this->uploadFiles()->where('file_type', 'image')->first()?->file_path;
    }
}
