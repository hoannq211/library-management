<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /** @use HasFactory<\Database\Factories\LogFactory> */
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = [
        'user_id',
        'action',
        'target_type',
        'target_id',
        'description',
    ];
}
