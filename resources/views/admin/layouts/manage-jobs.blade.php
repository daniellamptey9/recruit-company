@extends('admin.layouts.layout')

@section('content')

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Manage Jobs</h3>
          <div class="text">Manage all your job postings</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>All Jobs</h4>
                  <div class="text-right">
                    <a href="{{ route('admin.post-job') }}" class="theme-btn btn-style-one">Post New Job</a>
                  </div>
                </div>

                <div class="widget-content">
                  @if($jobs->count() > 0)
                    <div class="table-outer">
                      <table class="default-table manage-job-table">
                        <thead>
                          <tr>
                            <th>Job Title</th>
                            <th>Job Type</th>
                            <th>Salary Range</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($jobs as $job)
                            <tr>
                              <td>
                                <h6>{{ $job->title }}</h6>
                                <span class="info">{{ $job->industry }} • {{ $job->office_location }}</span>
                              </td>
                              <td>{{ $job->job_type }}</td>
                              <td>{{ $job->salary_range }}</td>
                              <td>{{ $job->formatted_deadline }}</td>
                              <td>
                                <span class="job-status {{ $job->is_active ? 'active' : 'inactive' }}">
                                  {{ $job->is_active ? 'Active' : 'Inactive' }}
                                </span>
                              </td>
                              <td>
                                <span class="job-status {{ $job->is_featured ? 'active' : 'inactive' }}">
                                  {{ $job->is_featured ? 'Featured' : 'Regular' }}
                                </span>
                              </td>
                              <td>
                                <div class="option-box">
                                  <ul class="option-list">
                                    <li>
                                      <a href="{{ route('admin.job.show', $job->id) }}" data-text="View">
                                        <span class="la la-eye"></span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="{{ route('admin.job.edit', $job->id) }}" data-text="Edit">
                                        <span class="la la-pencil"></span>
                                      </a>
                                    </li>
                                    <li>
                                      <form method="POST" action="{{ route('admin.job.destroy', $job->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this job?')" data-text="Delete">
                                          <span class="la la-trash"></span>
                                        </button>
                                      </form>
                                    </li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <!-- Pagination -->
                    @if($jobs->hasPages())
                      <div class="ls-pagination">
                        <div class="pagination-info-wrapper">
                          <div class="pagination-info">
                            <span>Showing <strong>{{ $jobs->firstItem() }}</strong> to <strong>{{ $jobs->lastItem() }}</strong> of <strong>{{ $jobs->total() }}</strong> jobs</span>
                          </div>
                          <div class="pagination-links">
                            {{ $jobs->links('pagination::bootstrap-4') }}
                          </div>
                        </div>
                      </div>
                    @endif
                  @else
                    <div class="text-center" style="padding: 40px 0;">
                      <h4>No jobs posted yet</h4>
                      <p>Start by posting your first job!</p>
                      <a href="{{ route('admin.post-job') }}" class="theme-btn btn-style-one">Post New Job</a>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection