<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    /** @use HasFactory<\Database\Factories\FineFactory> */
    use HasFactory;
    protected $table = 'fines';
    protected $fillable = [
        'borrow_id',
        'user_id',
        'amount',
        'reason',
        'paid_status'
    ];
}
