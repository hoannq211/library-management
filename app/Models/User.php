<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens;
    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles () {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }
    public function uploadFiles () {
        return $this->morphMany(UploadFile::class, 'target');
    }
    public function getAvatarAttribute()
    {
        return $this->uploadFiles()->where('file_type', 'image')->first()?->file_path;
    }
    public function getAllPermissionsAttribute () {
        return $this->roles->flatMap( function ($role) {
            return $role->permissions;
        })->unique('id');
    }
}
