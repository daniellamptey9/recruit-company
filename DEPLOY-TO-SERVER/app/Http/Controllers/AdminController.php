<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use App\Models\Job;
use App\Models\Category;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     * Apply admin middleware to all methods
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Additional security: Check if user is still valid
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            
            // Double-check user exists and has admin role
            if (!$user || !$user->isAdmin()) {
                Log::critical('Unauthorized admin access attempt', [
                    'user_id' => $user ? $user->id : 'unknown',
                    'user_email' => $user ? $user->email : 'unknown',
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->url()
                ]);
                
                Auth::logout();
                return redirect()->route('login')->with('error', 'Access denied. Please login again.');
            }
            
            return $next($request);
        });
    }

    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        // Log admin dashboard access
        Log::info('Admin dashboard accessed', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Basic analytics
        $postedJobs = Job::where('user_id', Auth::id())->count();
        $jobIds = Job::where('user_id', Auth::id())->pluck('id');
        $applicationsCount = \App\Models\JobApplication::whereIn('job_id', $jobIds)->count();
        $shortlistCount = \App\Models\JobApplication::whereIn('job_id', $jobIds)->where('status', 'shortlisted')->count();
        // Placeholder until messages feature exists
        $messagesCount = 0;
        
        // Recent applications (latest 6)
        $recentApplications = \App\Models\JobApplication::with(['user','job'])
            ->whereIn('job_id', $jobIds)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($application) {
                $user = $application->user;
                $job = $application->job;
                $skills = [];
                if (!empty($user?->languages)) {
                    $skills = array_filter(array_map('trim', explode(',', (string) $user->languages)));
                }
                return (object) [
                    'name' => $user?->name ?? 'Candidate',
                    'avatar_url' => $user?->logo_url ?? asset('assets/images/resource/candidate-1.png'),
                    'position' => $user?->job_title ?? 'Applicant',
                    'location' => $user?->city ?? null,
                    'expected_salary' => $user?->expected_salary ?? null,
                    'skills' => $skills,
                    'applied_at' => $application->created_at?->diffForHumans(),
                    'job_title' => $job?->title ?? 'Job',
                    'status' => $application->status,
                ];
            });

        return view('admin.layouts.layout', compact('postedJobs', 'applicationsCount', 'messagesCount', 'shortlistCount', 'recentApplications'));
    }

    /**
     * Show the company profile page
     */
    public function companyProfile()
    {
        // Log admin company profile access
        Log::info('Admin company profile accessed', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Get the company data (assuming only one company for now)
        $company = Company::first();

        return view('admin.layouts.company-profile', compact('company'));
    }

    /**
     * Update the company profile
     */
    public function updateCompanyProfile(Request $request)
    {
        // Log admin company profile update attempt
        Log::info('Admin company profile update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'request_data' => $request->all()
        ]);

        // Validate the request - make name and email optional for partial updates
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'established_since' => 'nullable|date',
            'team_size' => 'nullable|string|max:50',
            'about' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'google_plus' => 'nullable|url|max:255',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            // Get or create the company (assuming a single company record for now)
            $company = Company::first();
            if (!$company) {
                $company = Company::create([]);
            }

            // Prepare update data - only include fields that are provided
            $updateData = [];
            
            if ($request->has('name')) $updateData['name'] = $request->name;
            if ($request->has('email')) $updateData['email'] = $request->email;
            if ($request->has('phone')) $updateData['phone'] = $request->phone;
            if ($request->has('website')) $updateData['website'] = $request->website;
            if ($request->has('established_since')) $updateData['established_since'] = $request->established_since;
            if ($request->has('team_size')) $updateData['team_size'] = $request->team_size;
            if ($request->has('about')) $updateData['about'] = $request->about;
            if ($request->has('facebook')) $updateData['facebook'] = $request->facebook;
            if ($request->has('twitter')) $updateData['twitter'] = $request->twitter;
            if ($request->has('linkedin')) $updateData['linkedin'] = $request->linkedin;
            if ($request->has('google_plus')) $updateData['google_plus'] = $request->google_plus;
            if ($request->has('country')) $updateData['country'] = $request->country;
            if ($request->has('city')) $updateData['city'] = $request->city;
            if ($request->has('address')) $updateData['address'] = $request->address;

            // If a company logo was uploaded, move it into public/uploads/logos and store relative path
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $destination = public_path('uploads/logos');
                if (!is_dir($destination)) {
                    @mkdir($destination, 0755, true);
                }
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $filename = uniqid('logo_') . '.' . strtolower($extension);
                $file->move($destination, $filename);
                $updateData['logo'] = 'uploads/logos/' . $filename;
            }

            // Check if there's any data to update
            if (!empty($updateData)) {
                // Log what we're about to update
                Log::info('Updating company with data', [
                    'company_id' => $company->id,
                    'update_data' => $updateData
                ]);

                // Update the company data
                $company->update($updateData);
            }

            // Log successful update
            Log::info('Admin company profile updated successfully', [
                'user_id' => Auth::id(),
                'company_id' => $company->id,
                'updated_fields' => $request->except(['_token'])
            ]);

            return redirect()->back()->with('success', 'Company profile updated successfully!');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Admin company profile update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'request_data' => $request->except(['_token'])
            ]);

            return redirect()->back()->with('error', 'Failed to update company profile. Please try again.');
        }
    }

    /**
     * Show admin users management
     */
    public function users()
    {
        return response()->json([
            'message' => 'Admin Users Management - Coming Soon',
            'user' => Auth::user()->only(['id', 'name', 'email', 'role']),
            'timestamp' => now()
        ]);
    }

    /**
     * Show admin settings
     */
    public function settings()
    {
        return response()->json([
            'message' => 'Admin Settings - Coming Soon',
            'user' => Auth::user()->only(['id', 'name', 'email', 'role']),
            'timestamp' => now()
        ]);
    }

    /**
     * Show admin reports
     */
    public function reports()
    {
        return response()->json([
            'message' => 'Admin Reports - Coming Soon',
            'user' => Auth::user()->only(['id', 'name', 'email', 'role']),
            'timestamp' => now()
        ]);
    }

    /**
     * Show change password page
     */
    public function changePassword()
    {
        return view('admin.layouts.change-password');
    }

    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    /**
     * Show change details page
     */
    public function changeDetails()
    {
        return view('admin.layouts.change-details');
    }

    /**
     * Update admin details
     */
    public function updateDetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $update = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $destination = public_path('uploads/logos');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = uniqid('logo_') . '.' . strtolower($extension);
            $file->move($destination, $filename);
            $update['logo'] = 'uploads/logos/' . $filename;
        }

        $user->update($update);

        return redirect()->back()->with('success', 'Details updated successfully!');
    }

    /**
     * Show post job page
     */
    public function postJob()
    {
        return view('admin.layouts.post-a-new-job');
    }

    /**
     * Store new job post
     */
    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'key_responsibilities' => 'nullable|string',
            'skills_experience' => 'nullable|string',
            'company_email' => 'required|email|max:255',
            'contact_person' => 'required|string|max:255',
            'categories' => 'nullable|array',
            'job_type' => 'required|string|max:50',
            'salary_range' => 'required|string|max:100',
            'career_level' => 'required|string|max:50',
            'experience' => 'required|string|max:50',
            'gender_preference' => 'nullable|string|max:20',
            'industry' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:100',
            'deadline' => 'required|date|after:today',
            'work_location' => 'required|string|max:50',
            'office_location' => 'required|string|max:100',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        try {
            $job = Job::create([
                'title' => $request->title,
                'description' => $request->description,
                'key_responsibilities' => $request->key_responsibilities,
                'skills_experience' => $request->skills_experience,
                'company_email' => $request->company_email,
                'contact_person' => $request->contact_person,
                'categories' => $request->categories,
                'job_type' => $request->job_type,
                'salary_range' => $request->salary_range,
                'career_level' => $request->career_level,
                'experience' => $request->experience,
                'gender_preference' => $request->gender_preference,
                'industry' => $request->industry,
                'qualification' => $request->qualification,
                'deadline' => $request->deadline,
                'work_location' => $request->work_location,
                'office_location' => $request->office_location,
                'is_active' => $request->has('is_active') ? true : false,
                'is_featured' => $request->has('is_featured') ? true : false,
                'user_id' => Auth::id(),
            ]);

            Log::info('Job posted successfully', [
                'user_id' => Auth::id(),
                'job_id' => $job->id,
                'job_title' => $job->title
            ]);

            return redirect()->back()->with('success', 'Job posted successfully!');

        } catch (\Exception $e) {
            Log::error('Job posting failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'request_data' => $request->except(['_token'])
            ]);

            return redirect()->back()->with('error', 'Failed to post job. Please try again.');
        }
    }

    /**
     * Check admin access
     */
    public function checkAccess()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Admin access confirmed',
            'user' => Auth::user()->only(['id', 'name', 'email', 'role']),
            'permissions' => [
                'dashboard' => true,
                'users' => true,
                'settings' => true,
                'reports' => true
            ]
        ]);
    }

    /**
     * Display a listing of jobs
     */
    public function manageJobs()
    {
        // Access is already checked by middleware in constructor
        $jobs = Job::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.layouts.manage-jobs', compact('jobs'));
    }

    /**
     * Display the specified job
     */
    public function showJob($id)
    {
        // Access is already checked by middleware in constructor
        $job = Job::where('user_id', Auth::id())->findOrFail($id);
        
        return view('admin.layouts.view-job', compact('job'));
    }

    /**
     * Show applicants for a job
     */
    public function jobApplicants($id)
    {
        // Ensure job belongs to current admin
        $job = Job::where('user_id', Auth::id())->findOrFail($id);

        // Load applications with user relation
        $applications = \App\Models\JobApplication::with('user')
            ->where('job_id', $job->id)
            ->latest()
            ->get();

        // Map to view-friendly applicant objects expected by the blade
        $applicants = $applications->map(function ($application) {
            $user = $application->user;
            $skills = [];
            if (!empty($user?->languages)) {
                // languages stored as comma-separated or string; normalize to array
                $skills = array_filter(array_map('trim', explode(',', (string) $user->languages)));
            }
            return (object) [
                'name' => $user?->name ?? 'Candidate',
                'avatar_url' => $user?->logo_url ?? asset('assets/images/resource/candidate-1.png'),
                'position' => $user?->job_title ?? 'Applicant',
                'location' => $user?->city ?? null,
                'expected_salary' => $user?->expected_salary ?? null,
                'skills' => $skills,
                'cv_url' => $application->resume_path ? asset('storage/' . $application->resume_path) : null,
                'email' => $user?->email,
                'phone' => $user?->phone,
                'cover_letter' => $application->cover_letter,
                'applied_at' => $application->created_at?->diffForHumans(),
                'status' => $application->status,
                'application_id' => $application->id,
            ];
        });

        return view('admin.layouts.job-applicants', compact('job', 'applicants'));
    }

    /**
     * List all applicants across admin's jobs
     */
    public function allApplicants()
    {
        // Get all job IDs for this admin
        $jobIds = Job::where('user_id', Auth::id())->pluck('id');

        $applications = \App\Models\JobApplication::with(['user', 'job'])
            ->whereIn('job_id', $jobIds)
            ->latest()
            ->paginate(10);

        $applicants = $applications->getCollection()->map(function ($application) {
            $user = $application->user;
            $job = $application->job;
            return (object) [
                'name' => $user?->name ?? 'Candidate',
                'avatar_url' => $user?->logo_url ?? asset('assets/images/resource/candidate-1.png'),
                'position' => $user?->job_title ?? 'Applicant',
                'location' => $user?->city ?? null,
                'email' => $user?->email,
                'phone' => $user?->phone,
                'applied_at' => $application->created_at?->diffForHumans(),
                'status' => $application->status,
                'cv_url' => $application->resume_path ? asset('storage/' . $application->resume_path) : null,
                'job_title' => $job?->title ?? 'Job',
                'job_id' => $job?->id,
                'application_id' => $application->id,
            ];
        });

        // replace paginator collection with mapped data for the view
        $applications->setCollection($applicants);

        return view('admin.layouts.all-applicants', [
            'applications' => $applications
        ]);
    }

    /**
     * List shortlisted applicants across admin's jobs
     */
    public function shortlistedCandidates()
    {
        // Get all job IDs for this admin
        $jobIds = Job::where('user_id', Auth::id())->pluck('id');

        $applications = \App\Models\JobApplication::with(['user', 'job'])
            ->whereIn('job_id', $jobIds)
            ->where('status', 'shortlisted')
            ->latest()
            ->paginate(10);

        $mapped = $applications->getCollection()->map(function ($application) {
            $user = $application->user;
            $job = $application->job;
            $skills = [];
            if (!empty($user?->languages)) {
                $skills = array_filter(array_map('trim', explode(',', (string) $user->languages)));
            }
            return (object) [
                'name' => $user?->name ?? 'Candidate',
                'avatar_url' => $user?->logo_url ?? asset('assets/images/resource/candidate-1.png'),
                'position' => $user?->job_title ?? 'Applicant',
                'location' => $user?->city ?? null,
                'email' => $user?->email,
                'phone' => $user?->phone,
                'applied_at' => $application->created_at?->diffForHumans(),
                'status' => $application->status,
                'cv_url' => $application->resume_path ? asset('storage/' . $application->resume_path) : null,
                'job_title' => $job?->title ?? 'Job',
                'job_id' => $job?->id,
                'application_id' => $application->id,
                'skills' => $skills,
            ];
        });

        $applications->setCollection($mapped);

        return view('admin.layouts.shortlisted-candidates', [
            'applications' => $applications
        ]);
    }

    public function updateApplicationStatus(\Illuminate\Http\Request $request, $jobId, $applicationId)
    {
        $request->validate([
            'status' => 'required|in:pending,shortlisted,rejected',
        ]);

        // Ensure job belongs to current admin
        $job = Job::where('user_id', Auth::id())->findOrFail($jobId);

        $application = \App\Models\JobApplication::where('job_id', $job->id)
            ->findOrFail($applicationId);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated to ' . $request->status . '.');
    }

    /**
     * Show the form for editing the specified job
     */
    public function editJob($id)
    {
        // Access is already checked by middleware in constructor
        $job = Job::where('user_id', Auth::id())->findOrFail($id);
        
        return view('admin.layouts.edit-job', compact('job'));
    }

    /**
     * Update the specified job
     */
    public function updateJob(Request $request, $id)
    {
        // Access is already checked by middleware in constructor
        $job = Job::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'key_responsibilities' => 'nullable|string',
            'skills_experience' => 'nullable|string',
            'categories' => 'nullable|array',
            'job_type' => 'required|string|max:50',
            'salary_range' => 'required|string|max:100',
            'career_level' => 'required|string|max:50',
            'experience' => 'required|string|max:50',
            'gender_preference' => 'nullable|string|max:20',
            'industry' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:100',
            'deadline' => 'required|date|after_or_equal:today',
            'work_location' => 'required|string|max:50',
            'office_location' => 'required|string|max:100',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        try {
            $job->update([
                'title' => $request->title,
                'description' => $request->description,
                'key_responsibilities' => $request->key_responsibilities,
                'skills_experience' => $request->skills_experience,
                'categories' => $request->categories ?? [],
                'job_type' => $request->job_type,
                'salary_range' => $request->salary_range,
                'career_level' => $request->career_level,
                'experience' => $request->experience,
                'gender_preference' => $request->gender_preference,
                'industry' => $request->industry,
                'qualification' => $request->qualification,
                'deadline' => $request->deadline,
                'work_location' => $request->work_location,
                'office_location' => $request->office_location,
                'is_active' => $request->has('is_active') ? true : false,
                'is_featured' => $request->has('is_featured') ? true : false,
            ]);

            return redirect()->route('admin.manage-jobs')->with('success', 'Job updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update job. Please try again.');
        }
    }

    /**
     * Remove the specified job
     */
    public function destroyJob($id)
    {
        // Access is already checked by middleware in constructor
        
        try {
            $job = Job::where('user_id', Auth::id())->findOrFail($id);
            $jobTitle = $job->title;
            $job->delete();

            Log::info('Job deleted successfully', [
                'user_id' => Auth::id(),
                'job_id' => $id,
                'job_title' => $jobTitle
            ]);

            return redirect()->route('admin.manage-jobs')->with('success', 'Job deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Job deletion failed', [
                'user_id' => Auth::id(),
                'job_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to delete job. Please try again.');
        }
    }

    /**
     * Show categories management page
     */
    public function manageCategories()
    {
        $categories = Category::ordered()->paginate(5);
        return view('admin.layouts.manage-categories', compact('categories'));
    }

    /**
     * Show create category form
     */
    public function createCategory()
    {
        return view('admin.layouts.create-category');
    }


    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        try {
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $request->icon,
                'sort_order' => $request->sort_order ?? 0,
            ]);

            return redirect()->route('admin.manage-categories')->with('success', 'Category created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    /**
     * Show edit category form
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.layouts.edit-category', compact('category'));
    }

    /**
     * Update a category
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,' . $id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $request->icon,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()->route('admin.manage-categories')->with('success', 'Category updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category. Please try again.');
        }
    }

    /**
     * Delete a category
     */
    public function destroyCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $categoryName = $category->name;
            $category->delete();

            return redirect()->route('admin.manage-categories')->with('success', 'Category "' . $categoryName . '" deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete category. Please try again.');
        }
    }
}