<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCarousel extends Model
{
    use HasFactory;

    protected $table = 'section_carousel';

    protected $fillable = [
        'title_1',
        'content_1',
        'photo_1',
        'title_2',
        'content_2',
        'photo_2',
        'title_3',
        'content_3',
        'photo_3',
    ];
}