<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $fillable = [
        'info_donation_id',
        'name',
        'donate',
        'address',
        'phonenumber',
        'photo',
    ];

    /**
     * Cast attributes to native types
     */
    protected $casts = [
        'donate' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi many-to-one ke InfoDonation
     */
    public function infoDonation()
    {
        return $this->belongsTo(InfoDonation::class, 'info_donation_id');
    }

    /**
     * Accessor untuk format mata uang
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->donate, 0, ',', '.');
    }
}