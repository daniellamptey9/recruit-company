<div class="user-sidebar">
  <div class="sidebar-inner">
    <ul class="navigation">
      <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
      <li class="{{ request()->routeIs('admin.company-profile') ? 'active' : '' }}"><a href="{{ route('admin.company-profile') }}"><i class="la la-user-tie"></i>Company Profile</a></li>
      <li class="{{ request()->routeIs('admin.post-job') ? 'active' : '' }}"><a href="{{ route('admin.post-job') }}"><i class="la la-paper-plane"></i>Post a New Job</a></li>
      <li class="{{ request()->routeIs('admin.manage-jobs') ? 'active' : '' }}"><a href="{{ route('admin.manage-jobs') }}"><i class="la la-briefcase"></i> Manage Jobs </a></li>
      <li class="{{ request()->routeIs('admin.manage-categories') ? 'active' : '' }}"><a href="{{ route('admin.manage-categories') }}"><i class="la la-tags"></i> Manage Categories </a></li>
      <li><a href="#"><i class="la la-file-invoice"></i> All Applicants</a></li>
      <li><a href="#"><i class="la la-bookmark-o"></i>Shortlisted Resumes</a></li>
      <li><a href="#"><i class="la la-comment-o"></i>Messages</a></li>
      <li>
        <form method="post" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:8px 20px;">
            <i class="la la-sign-out"></i>Logout
          </button>
        </form>
      </li>
      <li><a href="#"><i class="la la-trash"></i>Delete Profile</a></li>
    </ul>
  </div>
</div>


