<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FounderJourney extends Model
{
    use HasFactory;

    protected $table = 'founder_journey';

    protected $fillable = [
        'title',
        'content',
        'date_start',
        'date_end',
        'location',
        'photo_1',
        'photo_2',
        'photo_3',
        'photo_4',
        'photo_5',
        'photo_6',
        'photo_7',
        'photo_8',
        'photo_9',
        'photo_10',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];
}