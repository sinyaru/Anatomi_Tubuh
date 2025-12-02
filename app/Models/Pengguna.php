<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $table = 'penggunas';

    protected $fillable = [
        'nama',
        'email',
        'role',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}