<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolActivity extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title',
        'who',
        'what',
        'when',
        'where',
        'why',
        'organizer'
    ];

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getWhoAttribute($value)
    {
        return ucfirst($value);
    }

    public function getWhatAttribute($value)
    {
        return ucfirst($value);
    }

    public function getWhenAttribute($value)
    {
        return ucfirst($value);
    }

    public function getWhereAttribute($value)
    {
        return ucfirst($value);
    }

    public function getWhyAttribute($value)
    {
        return ucfirst($value);
    }
}
