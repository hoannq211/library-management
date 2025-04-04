<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadFile extends Model
{
    /** @use HasFactory<\Database\Factories\UploadFileFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $table = 'upload_files';
    protected $fillable = [
        'file_path',
        'file_type',
        'target_type',
        'target_id',
        'uploaded_by',
    ];

    public function target() {
        return $this->morphTo();
    }
}
