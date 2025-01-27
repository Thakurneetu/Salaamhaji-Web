@php
$module=explode("/", url()->current());
@endphp
<!-- Dashboard -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{Request::url() == route('home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

@can('Employee List')
<!-- Manage Employees -->
<li class="nav-item">
    <a href="{{ route('employee.index') }}" class="nav-link {{Request::url() == route('employee.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Employees</p>
    </a>
</li>
@endcan

@canany(['Leave Request List','Calendar'])
  <!-- Leave Requests -->
  <li class="nav-item {{ array_intersect($module, ['leave-request','leave-calendar']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ array_intersect($module, ['leave-request','leave-calendar']) ? 'active' : '' }}">
    <i class="nav-icon fas fa-cogs"></i>
      <p>
      Leave
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['Leave Request List', 'Leave Request List (Master)'])
      <li class="nav-item">
          <a href="{{ route('leave-request.index') }}" class="nav-link {{ array_intersect($module, ['leave-request']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Leave Request</p>
          </a>
      </li>
      @endcan
      @can(['Calendar'])
      <li class="nav-item">
        <a href="{{ route('leave-calendar.index') }}" class="nav-link {{ array_intersect($module, ['leave-calendar']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Calendar</p>
        </a>
      </li>
      @endcan
    </ul>
  </li>
@endcanany

@canany(['Role List', 'Permission List','Department List','Job Title List','Employment Type List','Employment Status List','Leave Type List','Manage Allowance Policy','Holiday List'])
  <!-- Settings -->
  <li class="nav-item {{ array_intersect($module, ['role','permissions','department','job-title','employment-type','employment-status','leave-type','allowance-policy-setting','approval-setting','holiday']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ array_intersect($module, ['role','permissions','department','job-title','employment-type','employment-status','leave-type','allowance-policy-setting','approval-setting','holiday']) ? 'active' : '' }}">
    
    <i class="nav-icon fas fa-cogs"></i>
      <p>
      Master Settings
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @can(['Role List'])
      <li class="nav-item">
        <a href="{{ route('role.index') }}" class="nav-link {{ array_intersect($module, ['role']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Roles</p>
        </a>
      </li>
      @endcan
      @can(['Permission List'])
      <li class="nav-item">
        <a href="{{ route('permissions') }}" class="nav-link {{ array_intersect($module, ['permissions']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Permissions</p>
        </a>
      </li>
      @endcan
      @can(['Department List'])
      <li class="nav-item">
        <a href="{{ route('department.index') }}" class="nav-link {{ array_intersect($module, ['department']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Department</p>
        </a>
      </li>
      @endcan
      @can(['Job Title List'])
      <li class="nav-item">
        <a href="{{ route('job-title.index') }}" class="nav-link {{ array_intersect($module, ['job-title']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Job Title/Position</p>
        </a>
      </li>
      @endcan
      @can(['Employment Type List'])
      <li class="nav-item">
        <a href="{{ route('employment-type.index') }}" class="nav-link {{ array_intersect($module, ['employment-type']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Employment Type </p>
        </a>
      </li>
      @endcan
      @can(['Employment Status List'])
      <li class="nav-item">
        <a href="{{ route('employment-status.index') }}" class="nav-link {{ array_intersect($module, ['employment-status']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Employment Status </p>
        </a>
      </li>
      @endcan
      @can(['Holiday List'])
      <li class="nav-item">
        <a href="{{ route('holiday.index') }}" class="nav-link {{ array_intersect($module, ['holiday']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>Holidays</p>
        </a>
      </li>
      @endcan
      @canany(['Leave Type List','Manage Allowance Policy'])
        <li class="nav-item {{ array_intersect($module, ['leave-type','allowance-policy-setting','approval-setting']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ array_intersect($module, ['leave-type','allowance-policy-setting','approval-setting']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-cogs"></i>
            <p>
            Leave Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can(['Leave Type List'])
            <li class="nav-item">
              <a href="{{ route('leave-type.index') }}" class="nav-link {{ array_intersect($module, ['leave-type']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Leave Type</p>
              </a>
            </li>
            @endcan
            @can(['Manage Allowance Policy'])
            <li class="nav-item">
              <a href="{{ route('allowance_policy') }}" class="nav-link {{ array_intersect($module, ['allowance-policy-setting']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Allowance Policy</p>
              </a>
            </li>
            @endcan
            @can(['Approval List'])
            <li class="nav-item">
              <a href="{{ route('approval_policy') }}" class="nav-link {{ array_intersect($module, ['approval-setting']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Approval</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany

<!-- Logout -->
<li class="nav-item mb-5">
    <a class="nav-link" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>
