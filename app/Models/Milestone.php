<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $table = 'milestone';

    protected $fillable = [
        'timeline_title_1',
        'timeline_content_1',
        'timeline_title_2',
        'timeline_content_2',
        'timeline_title_3',
        'timeline_content_3',
        'timeline_title_4',
        'timeline_content_4',
        'photo'
    ];
}