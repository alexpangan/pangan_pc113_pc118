<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'full_name',
        'email',
        'phone',
        'password',
        'address',
        'profile',
    ];

    // protected $hidden = [
    //     'password',
    //     'confirm_password'
    // ];
}
