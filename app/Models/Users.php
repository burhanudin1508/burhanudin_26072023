<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public $timestamps = false;
    public $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'role',
        'last_login',
        'created_at',
        'updated_at',
        'status'
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
