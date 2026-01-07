<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteer';

    protected $fillable = [
        'title',
        'content',
        'date',
        'specification_1',
        'specification_2',
        'specification_3',
        'specification_4',
        'specification_5',
        'specification_6',
        'specification_7',
        'specification_8',
        'specification_9',
        'specification_10',
        'photo_1',
        'photo_2',
        'photo_3',
        'pic_1',
        'pic_2',
        'phonenumber_1',
        'phonenumber_2',
        'link',
        'status',
    ];

    /**
     * Relasi one-to-many ke VolunteerParticipant
     */
    public function participants()
    {
        return $this->hasMany(VolunteerParticipant::class, 'volunteer_id');
    }
}