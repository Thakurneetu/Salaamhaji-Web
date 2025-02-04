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
    <a href="{{ route('customer.index') }}" class="nav-link {{Request::url() == route('customer.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Customer</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('vendor-users.index') }}" class="nav-link {{Request::url() == route('vendor-users.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Vendors</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('banner.index') }}" class="nav-link {{Request::url() == route('banner.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>Promotional Banners</p>
    </a>
</li>
<li class="nav-item {{ array_intersect($module, ['loundry_category', 'loundry_master',]) ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ array_intersect($module, ['loundry_category', 'loundry_master']) ? 'active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Loundry Master
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{route('loundry_category.index')}}" class="nav-link {{ array_intersect($module, ['loundry_category']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-friends"></i>
          <p>Category</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('loundry_master.index')}}" class="nav-link {{ array_intersect($module, ['loundry_master']) ? 'active' : '' }}">
          <i class="nav-icon fab fa-vimeo-v"></i> 
          <p>Service</p>
        </a>
      </li>
  </ul>
</li>
<li class="nav-item {{ array_intersect($module, ['food_category', 'food_master',]) ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ array_intersect($module, ['food_category', 'food_master']) ? 'active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Food Master
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{route('food_category.index')}}" class="nav-link {{ array_intersect($module, ['food_category']) ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-friends"></i>
          <p>Category</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('food_master.index')}}" class="nav-link {{ array_intersect($module, ['food_master']) ? 'active' : '' }}">
          <i class="nav-icon fab fa-vimeo-v"></i> 
          <p>Service</p>
        </a>
      </li>
  </ul>
</li>
<li class="nav-item mb-5">
    <a class="nav-link" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>
