<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_visited',
        'referrer',
        'visit_date',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];
}
