<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course',
        'year_level',
        'email',
        'password',
        'phone',
        'address',
        'profile_picture',
    ];
}
