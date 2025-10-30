<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'established_since',
        'team_size',
        'about',
        'logo',
        'facebook',
        'twitter',
        'linkedin',
        'google_plus',
        'country',
        'city',
        'address',
    ];

    protected $casts = [
        'established_since' => 'date',
    ];

    /**
     * Get the company's logo URL
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('assets/images/resource/company-6.png');
    }

    /**
     * Get formatted team size
     */
    public function getFormattedTeamSizeAttribute()
    {
        return $this->team_size ?: 'Not specified';
    }

    /**
     * Get formatted established date
     */
    public function getFormattedEstablishedAttribute()
    {
        return $this->established_since ? $this->established_since->format('d.m.Y') : 'Not specified';
    }
}