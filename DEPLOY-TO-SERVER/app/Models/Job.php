<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'key_responsibilities',
        'skills_experience',
        'company_email',
        'contact_person',
        'categories',
        'job_type',
        'salary_range',
        'career_level',
        'experience',
        'gender_preference',
        'industry',
        'qualification',
        'deadline',
        'work_location',
        'office_location',
        'is_active',
        'is_featured',
        'user_id',
    ];

    protected $casts = [
        'categories' => 'array',
        'deadline' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user who posted this job
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories for this job
     */
    public function jobCategories()
    {
        return $this->belongsToMany(Category::class, 'job_category_pivot');
    }

    /**
     * Get formatted deadline
     */
    public function getFormattedDeadlineAttribute()
    {
        return $this->deadline ? $this->deadline->format('M d, Y') : 'Not set';
    }

    /**
     * Get formatted categories
     */
    public function getFormattedCategoriesAttribute()
    {
        return $this->categories ? implode(', ', $this->categories) : 'Not specified';
    }
}
