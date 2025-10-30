<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Models\Category;
use App\Models\Job;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'home'])->name('home');
Route::get('/jobs', [AuthController::class, 'jobs'])->name('jobs');
Route::get('/find-jobs', [AuthController::class, 'jobs'])->name('find-jobs');
Route::get('/job/{id}', [AuthController::class, 'jobDetail'])->name('job.detail');
Route::get('/about', [AuthController::class, 'about'])->name('about');
Route::get('/contact', [AuthController::class, 'contact'])->name('contact');

// Public: Jobs by Category
Route::get('/categories/{slug}', function (string $slug) {
    $category = Category::where('slug', $slug)->orWhere('name', $slug)->firstOrFail();

    $jobs = Job::query()
        ->where('is_active', true)
        ->where(function ($q) use ($category) {
            $q->whereHas('jobCategories', function ($qq) use ($category) {
                $qq->where('job_categories.id', $category->id);
            })
            ->orWhereJsonContains('categories', $category->name)
            ->orWhere(function ($qq) use ($category) {
                if (!empty($category->slug)) {
                    $qq->whereJsonContains('categories', $category->slug);
                }
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('category-jobs', compact('category', 'jobs'));
})->name('category.jobs');

// Debug route to test form submission
Route::post('/debug-job-update', function(Request $request) {
    Log::info('Debug job update route hit', [
        'request_data' => $request->all(),
        'method' => $request->method(),
        'url' => $request->url()
    ]);
    return response()->json(['status' => 'success', 'data' => $request->all()]);
});

// Test route specifically for job 10
Route::get('/test-job-10', function() {
    $job = \App\Models\Job::find(10);
    if ($job) {
        return response()->json([
            'exists' => true,
            'id' => $job->id,
            'title' => $job->title,
            'user_id' => $job->user_id,
            'current_user' => auth()->id()
        ]);
    } else {
        return response()->json(['exists' => false]);
    }
});




// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes - Protected with authentication and admin role
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/company-profile', [AdminController::class, 'companyProfile'])->name('admin.company-profile');
Route::post('/admin/company-profile', [AdminController::class, 'updateCompanyProfile'])->name('admin.company-profile.update');
Route::get('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
Route::post('/admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.change-password.update');
Route::get('/admin/change-details', [AdminController::class, 'changeDetails'])->name('admin.change-details');
Route::post('/admin/change-details', [AdminController::class, 'updateDetails'])->name('admin.change-details.update');
Route::get('/admin/post-job', [AdminController::class, 'postJob'])->name('admin.post-job');
Route::post('/admin/post-job', [AdminController::class, 'storeJob'])->name('admin.post-job.store');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
    // Job management routes
    Route::get('/admin/manage-jobs', [AdminController::class, 'manageJobs'])->name('admin.manage-jobs');
    Route::get('/admin/applicants', [AdminController::class, 'allApplicants'])->name('admin.all-applicants');
    Route::get('/admin/debug-jobs', function() {
        $jobs = \App\Models\Job::all();
        return view('admin.debug-jobs', compact('jobs'));
    })->name('admin.debug-jobs');
    Route::get('/admin/job/{id}', [AdminController::class, 'showJob'])->name('admin.job.show');
    Route::get('/admin/job/{id}/edit', [AdminController::class, 'editJob'])->name('admin.job.edit');
    Route::get('/admin/job/{id}/applicants', [AdminController::class, 'jobApplicants'])->name('admin.job.applicants');
    Route::post('/admin/job/{job}/applications/{application}/status', [AdminController::class, 'updateApplicationStatus'])->name('admin.application.status');
    Route::put('/admin/job/{id}', [AdminController::class, 'updateJob'])->name('admin.job.update');
    Route::delete('/admin/job/{id}', [AdminController::class, 'destroyJob'])->name('admin.job.destroy');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/check-access', [AdminController::class, 'checkAccess'])->name('admin.check-access');
    
    // Category Management Routes
    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.manage-categories');
    Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.create-category');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.store-category');
    Route::get('/admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.edit-category');
    Route::put('/admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.update-category');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.destroy-category');
});

// Candidate Routes - Protected with authentication and candidate role
Route::middleware(['auth','role:candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');
    Route::get('/candidate/change-details', [CandidateController::class, 'changeDetails'])->name('candidate.change-details');
    Route::post('/candidate/change-details', [CandidateController::class, 'updateDetails'])->name('candidate.change-details.update');
    Route::get('/candidate/change-password', [CandidateController::class, 'changePassword'])->name('candidate.change-password');
    Route::post('/candidate/change-password', [CandidateController::class, 'updatePassword'])->name('candidate.change-password.update');
    
    // Additional candidate routes can be added here
    Route::get('/candidate/profile', [CandidateController::class, 'profile'])->name('candidate.profile');
    Route::post('/candidate/profile', [CandidateController::class, 'updateProfile'])->name('candidate.profile.update');
    Route::post('/candidate/profile/social', [CandidateController::class, 'updateSocial'])->name('candidate.profile.social');
    Route::post('/candidate/profile/contact', [CandidateController::class, 'updateContact'])->name('candidate.profile.contact');
    Route::get('/candidate/resume', [CandidateController::class, 'resume'])->name('candidate.resume');
    Route::post('/candidate/resume', [CandidateController::class, 'updateResume'])->name('candidate.resume.update');
    
    Route::get('/candidate/applications', function () {
        return 'My Applications - Coming Soon';
    })->name('candidate.applications');

    // Apply to a job (submit only - form is accessible to any authenticated user)
    Route::post('/jobs/{id}/apply', [CandidateController::class, 'applySubmit'])->name('candidate.apply.submit');
});

// Apply form accessible to any authenticated user (to avoid role redirects)
Route::get('/jobs/{id}/apply', [CandidateController::class, 'applyForm'])
    ->middleware('auth')
    ->name('candidate.apply');

// Security test routes (remove in production)
Route::get('/test-admin-access', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([
            'authenticated' => true,
            'user' => $user->only(['id', 'name', 'email', 'role']),
            'is_admin' => $user->isAdmin(),
            'can_access_admin' => $user->isAdmin(),
            'ip' => request()->ip()
        ]);
    }
    return response()->json(['authenticated' => false]);
});


