<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'status',
        'cover_letter',
        'resume_path',
        'additional_info',
    ];

    protected $casts = [
        'additional_info' => 'array',
    ];

    /**
     * Get the user that owns the job application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job that the application is for.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
