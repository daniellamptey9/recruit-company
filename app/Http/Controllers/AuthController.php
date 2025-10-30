<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function home()
    {
        // Get featured jobs for homepage - limit to maximum 6 jobs
        $featuredJobs = \App\Models\Job::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6) // Use take() instead of limit() for better clarity
            ->get();

        // Additional safety check to ensure we never exceed 6 jobs
        if ($featuredJobs->count() > 6) {
            $featuredJobs = $featuredJobs->take(6);
        }

        // Get company details for display
        $company = \App\Models\Company::first();

        // Get popular job categories (limit 9)
        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(9)
            ->get();

        return view('home.home', compact('featuredJobs', 'company', 'categories'));
    }

    /**
     * Show jobs listing page
     */
    public function jobs(Request $request)
    {
        $query = \App\Models\Job::where('is_active', true);

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        // Location filter
        if ($request->has('location') && $request->location) {
            $query->where('office_location', 'like', "%{$request->location}%");
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereJsonContains('categories', $request->category);
        }

        // Job type filter
        if ($request->has('job_type') && is_array($request->job_type)) {
            $query->whereIn('job_type', $request->job_type);
        }

        // Experience filter
        if ($request->has('experience') && $request->experience != 'all') {
            $query->where('experience', $request->experience);
        }

        // Work location filter
        if ($request->has('work_location') && $request->work_location != 'all') {
            $query->where('work_location', $request->work_location);
        }

        // Salary filter
        if ($request->has('salary') && $request->salary != 'all') {
            $query->where('salary_range', $request->salary);
        }

        // Date posted filter
        if ($request->has('date_posted') && $request->date_posted != 'all') {
            $dateFilter = null;
            switch ($request->date_posted) {
                case 'last_hour':
                    $dateFilter = now()->subHour();
                    break;
                case 'last_24':
                    $dateFilter = now()->subDay();
                    break;
                case 'last_7':
                    $dateFilter = now()->subWeek();
                    break;
                case 'last_14':
                    $dateFilter = now()->subDays(14);
                    break;
                case 'last_30':
                    $dateFilter = now()->subDays(30);
                    break;
            }
            if ($dateFilter) {
                $query->where('created_at', '>=', $dateFilter);
            }
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        if ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginate
        $jobs = $query->paginate(10);

        // Get company details
        $company = \App\Models\Company::first();

        return view('jobs', compact('jobs', 'company'));
    }

    /**
     * Show job detail page
     */
    public function jobDetail($id)
    {
        $job = \App\Models\Job::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        // Get company details
        $company = \App\Models\Company::first();

        // Get related jobs (same industry or category)
        $relatedJobs = \App\Models\Job::where('id', '!=', $id)
            ->where('is_active', true)
            ->where(function($query) use ($job) {
                $query->where('industry', $job->industry)
                      ->orWhereJsonContains('categories', $job->categories[0] ?? '');
            })
            ->limit(3)
            ->get();

        return view('job-detail', compact('job', 'relatedJobs', 'company'));
    }

    /**
     * Show About Us page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show Contact page
     */
    public function contact()
    {
        $company = \App\Models\Company::first();
        return view('contact', compact('company'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user && $user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('candidate.dashboard');
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'phone' => ['nullable','string','max:20'],
            'country' => ['nullable','string','max:100'],
            'city' => ['nullable','string','max:100'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'country' => $validated['country'] ?? null,
            'city' => $validated['city'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'candidate',
        ]);

        Auth::login($user);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('candidate.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}


