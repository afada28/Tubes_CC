<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerParticipant extends Model
{
    use HasFactory;

    protected $table = 'volunteer_participant';

    protected $fillable = [
        'volunteer_id',
        'name',
        'adress',
        'phonenumber',
        'email',
        'reason',
        'experience',
        'last_education',
        'file_1',
        'file_2',
        'file_3',
        'status',
    ];

    /**
     * Relasi many-to-one ke Volunteer
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }
}