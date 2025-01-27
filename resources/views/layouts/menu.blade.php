@php
$module=explode("/", url()->current());
@endphp
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{Request::url() == route('home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('vendor-users.index') }}" class="nav-link {{Request::url() == route('vendor-users.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Vendors</p>
    </a>
</li>
<li class="nav-item mb-5">
    <a class="nav-link" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>
