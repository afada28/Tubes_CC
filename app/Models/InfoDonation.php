<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoDonation extends Model
{
    use HasFactory;

    protected $table = 'info_donation';

    protected $fillable = [
        'title',
        'content',
        'target',
        'payment_method_1',
        'payment_method_2',
        'payment_method_3',
        'pic_payment_method_1',
        'pic_payment_method_2',
        'pic_payment_method_3',
        'contact_person_1',
        'contact_person_2',
        'contact_person_3',
        'photo_1',
        'photo_2',
        'photo_3',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'target' => 'decimal:2',
    ];

    /**
     * Relasi one-to-many ke Donation
     */
    public function donations()
    {
        return $this->hasMany(Donation::class, 'info_donation_id');
    }

    /**
     * Scope untuk donation yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now());
    }

    /**
     * Accessor untuk total donasi
     */
    public function getTotalDonationsAttribute()
    {
        return $this->donations()->sum('donate');
    }

    /**
     * Accessor untuk jumlah donatur
     */
    public function getDonorCountAttribute()
    {
        return $this->donations()->count();
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->target, 0, ',', '.');
    }
}
