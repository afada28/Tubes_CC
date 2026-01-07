<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';

    protected $fillable = [
        'title',
        'content',
        'location',
        'date',
        'time',
        'photo_1',
        'photo_2',
        'photo_3',
        'photo_4',
        'photo_5',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}