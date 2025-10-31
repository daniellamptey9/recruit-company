<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\CandidateResume;

class CandidateController extends Controller
{
    /**
     * Create a new controller instance.
     * Apply auth middleware to all methods
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the candidate dashboard
     */
    public function dashboard()
    {
        // Get real analytics data for the candidate
        $appliedJobs = JobApplication::where('user_id', Auth::id())->count();
        
        // Placeholders for features not yet implemented
        $jobAlertsCount = 0;
        $messagesCount = 0;
        $shortlistCount = 0;

        // Get recent job applications
        $recentApplications = JobApplication::where('user_id', Auth::id())
            ->with('job')
            ->latest()
            ->limit(6)
            ->get();

        return view('candidate.dashboard', compact(
            'appliedJobs', 
            'jobAlertsCount', 
            'messagesCount', 
            'shortlistCount',
            'recentApplications'
        ));
    }

    /**
     * Show the change details page
     */
    public function changeDetails()
    {
        return view('candidate.change-details');
    }

    /**
     * Update user details
     */
    public function updateDetails(Request $request)
    {
        // Log candidate details update attempt
        Log::info('Candidate details update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'request_data' => $request->all()
        ]);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        try {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            Log::info('Candidate details updated successfully', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);

            return redirect()->back()->with('success', 'Your details have been updated successfully!');
        } catch (\Exception $e) {
            Log::error('Candidate details update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to update details. Please try again.');
        }
    }

    /**
     * Show the change password page
     */
    public function changePassword()
    {
        return view('candidate.change-password');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        // Log candidate password update attempt
        Log::info('Candidate password update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = Auth::user();

            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            Log::info('Candidate password updated successfully', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);

            return redirect()->back()->with('success', 'Your password has been updated successfully!');
        } catch (\Exception $e) {
            Log::error('Candidate password update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to update password. Please try again.');
        }
    }

    /**
     * Show the resume page
     */
    public function resume()
    {
        $user = Auth::user();
        $activeResume = $user->activeResume;
        
        return view('candidate.resume', compact('activeResume'));
    }

    /**
     * Update resume info using CandidateResume model
     */
    public function updateResume(Request $request)
    {
        $request->validate([
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'professional_summary' => 'nullable|string|max:2000',
            'education' => 'nullable|string|max:2000',
            'work_experience' => 'nullable|string|max:2000',
            'key_skills' => 'nullable|string|max:2000',
        ]);

        try {
            $user = Auth::user();
            
            // Deactivate current active resume
            CandidateResume::where('user_id', $user->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            // Create new resume record
            $resumeData = [
                'user_id' => $user->id,
                'professional_summary' => $request->professional_summary,
                'education' => $request->education,
                'work_experience' => $request->work_experience,
                'key_skills' => $request->key_skills,
                'is_active' => true,
            ];

            // Handle CV file upload
            if ($request->hasFile('cv_file')) {
                $cvPath = $request->file('cv_file')->store('resumes', 'public');
                $resumeData['cv_file'] = $cvPath;
            }

            // Handle Resume file upload (required)
            if ($request->hasFile('resume_file')) {
                $resumePath = $request->file('resume_file')->store('resumes', 'public');
                $resumeData['resume_file'] = $resumePath;
            }

            CandidateResume::create($resumeData);

            return back()->with('success', 'Resume updated successfully');
        } catch (\Exception $e) {
            \Log::error('Resume update failed', ['user_id' => Auth::id(), 'error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update resume');
        }
    }

    public function applyForm($id)
    {
        $job = Job::where('is_active', true)->findOrFail($id);
        return view('candidate.apply-job', compact('job'));
    }

    public function applySubmit(Request $request, $id)
    {
        $job = Job::where('is_active', true)->findOrFail($id);

        $request->validate([
            'cover_letter' => 'nullable|string',
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'additional_info' => 'nullable|string',
        ]);

        $exists = JobApplication::where('user_id', Auth::id())
            ->where('job_id', $job->id)
            ->exists();
        if ($exists) {
            return redirect()->route('job.detail', $job->id)
                ->with('error', 'You have already applied to this job.');
        }

        $resumePath = $request->file('resume_file')->store('applications', 'public');

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'status' => 'pending',
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'additional_info' => $request->additional_info,
        ]);

        return redirect()->route('job.detail', $job->id)
            ->with('success', 'Application submitted successfully.');
    }

    /**
     * Show the candidate profile page
     */
    public function profile()
    {
        return view('candidate.profile');
    }

    /**
     * Update candidate profile
     */
    public function updateProfile(Request $request)
    {
        // Log candidate profile update attempt
        Log::info('Candidate profile update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'request_data' => $request->all()
        ]);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'job_title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'current_salary' => 'nullable|string|max:50',
            'expected_salary' => 'nullable|string|max:50',
            'experience' => 'nullable|string|max:100',
            'age_range' => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        try {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->job_title = $request->job_title;
            $user->phone = $request->phone;
            $user->website = $request->website;
            $user->current_salary = $request->current_salary;
            $user->expected_salary = $request->expected_salary;
            $user->experience = $request->experience;
            $user->age_range = $request->age_range;
            $user->education = $request->education;
            $user->languages = $request->languages;
            $user->description = $request->description;
            $user->save();

            Log::info('Candidate profile updated successfully', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);

            return redirect()->back()->with('success', 'Your profile has been updated successfully!');
        } catch (\Exception $e) {
            Log::error('Candidate profile update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    /**
     * Update candidate social links
     */
    public function updateSocial(Request $request)
    {
        // Log candidate social update attempt
        Log::info('Candidate social links update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'request_data' => $request->all()
        ]);

        // Validate the request
        $request->validate([
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        try {
            $user = Auth::user();
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
            $user->save();

            Log::info('Candidate social links updated successfully', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);

            return redirect()->back()->with('success', 'Your social links have been updated successfully!');
        } catch (\Exception $e) {
            Log::error('Candidate social links update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to update social links. Please try again.');
        }
    }

    /**
     * Update candidate contact information
     */
    public function updateContact(Request $request)
    {
        // Log candidate contact update attempt
        Log::info('Candidate contact info update attempted', [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'request_data' => $request->all()
        ]);

        // Validate the request
        $request->validate([
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        try {
            $user = Auth::user();
            $user->country = $request->country;
            $user->city = $request->city;
            $user->address = $request->address;
            $user->save();

            Log::info('Candidate contact info updated successfully', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);

            return redirect()->back()->with('success', 'Your contact information has been updated successfully!');
        } catch (\Exception $e) {
            Log::error('Candidate contact info update failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to update contact information. Please try again.');
        }
    }
}
