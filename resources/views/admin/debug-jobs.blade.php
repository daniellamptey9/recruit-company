<!DOCTYPE html>
<html>
<head>
    <title>Job Update Debug</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .success { color: green; }
        .error { color: red; }
        .test-form { margin: 20px 0; padding: 20px; border: 2px solid #ddd; }
    </style>
</head>
<body>
    <h1>Job Update Debug Information</h1>
    
    <h2>All Jobs in Database</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User ID</th>
                <th>Deadline</th>
                <th>Active</th>
                <th>Featured</th>
                <th>Edit Link</th>
                <th>Test Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->user_id }}</td>
                <td>{{ $job->deadline->format('Y-m-d') }}</td>
                <td>{{ $job->is_active ? 'Yes' : 'No' }}</td>
                <td>{{ $job->is_featured ? 'Yes' : 'No' }}</td>
                <td><a href="{{ route('admin.job.edit', $job->id) }}" target="_blank">Edit</a></td>
                <td>
                    <form method="POST" action="{{ route('admin.job.update', $job->id) }}" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $job->title }} - UPDATED">
                        <input type="hidden" name="description" value="{{ $job->description }}">
                        <input type="hidden" name="job_type" value="{{ $job->job_type }}">
                        <input type="hidden" name="salary_range" value="{{ $job->salary_range }}">
                        <input type="hidden" name="career_level" value="{{ $job->career_level }}">
                        <input type="hidden" name="experience" value="{{ $job->experience }}">
                        <input type="hidden" name="industry" value="{{ $job->industry }}">
                        <input type="hidden" name="deadline" value="{{ $job->deadline->format('Y-m-d') }}">
                        <input type="hidden" name="work_location" value="{{ $job->work_location }}">
                        <input type="hidden" name="office_location" value="{{ $job->office_location }}">
                        <input type="hidden" name="company_email" value="{{ $job->company_email }}">
                        <input type="hidden" name="contact_person" value="{{ $job->contact_person }}">
                        <button type="submit">Quick Test</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h2>Current User</h2>
    <p>User ID: {{ Auth::id() }}</p>
    <p>User Email: {{ Auth::user()->email }}</p>
    <p>User Role: {{ Auth::user()->role }}</p>
    
    <h2>Route Information</h2>
    <p>Update Route Pattern: /admin/job/{id}</p>
    <p>Method: PUT</p>
    
    <a href="{{ route('admin.manage-jobs') }}">Back to Manage Jobs</a>
</body>
</html>

