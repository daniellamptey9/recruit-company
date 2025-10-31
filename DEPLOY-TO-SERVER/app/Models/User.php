<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'job_title',
        'phone',
        'website',
        'current_salary',
        'expected_salary',
        'experience',
        'age_range',
        'education',
        'languages',
        'categories',
        'allow_search',
        'description',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'country',
        'city',
        'address',
        'resume_path',
        'resume_summary',
        'resume_education',
        'resume_experience',
        'resume_skills',
        'logo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'categories' => 'array',
        'allow_search' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCandidate(): bool
    {
        return $this->role === 'candidate';
    }

    /**
     * Get the candidate's resumes.
     */
    public function candidateResumes()
    {
        return $this->hasMany(CandidateResume::class);
    }

    /**
     * Get the candidate's active resume.
     */
    public function activeResume()
    {
        return $this->hasOne(CandidateResume::class)->where('is_active', true);
    }

    public function getLogoUrlAttribute(): string
    {
        if (!$this->logo) {
            return asset('assets/images/logo-2.svg');
        }
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }
        if (file_exists(public_path($this->logo))) {
            return asset($this->logo);
        }
        return asset('storage/' . $this->logo);
    }
}
