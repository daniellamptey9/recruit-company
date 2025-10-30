<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cv_file',
        'resume_file',
        'professional_summary',
        'education',
        'work_experience',
        'key_skills',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the resume.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get active resume for a user
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
