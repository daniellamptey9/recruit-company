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
        if (!$this->logo) {
            return asset('assets/images/resource/company-6.png');
        }
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }
        // If saved under public directory (e.g., uploads/...)
        if (file_exists(public_path($this->logo))) {
            return asset($this->logo);
        }
        // Fallback to storage symlink pattern
        return asset('storage/' . $this->logo);
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