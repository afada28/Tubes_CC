<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = [
        'title',
        'subtitle',
        'gallery_title_1',
        'gallery_content_1',
        'gallery_photo_1',
        'gallery_title_2',
        'gallery_content_2',
        'gallery_photo_2',
    ];
}