<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewiew extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'description',
        'rating',
        'user_id',
        'announcement_id'
    ];
}
