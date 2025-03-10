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
<li class="nav-item {{ array_intersect($module, ['order']) ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ array_intersect($module, ['order']) ? 'active' : '' }}">
    <i class="nav-icon fas fa-rupee-sign"></i>
    <p>
      Orders
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{route('order.index')}}" class="nav-link {{ ((request()->type == '' || request()->type == 'laundry') && array_intersect($module, ['order'])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tshirt"></i>
        <p>Laundry Orders</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('order.index')}}?type=food" class="nav-link {{ request()->type == 'food' ? 'active' : '' }}">
        <i class="nav-icon fas fa-pizza-slice"></i>
        <p>Food Orders</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('order.index')}}?type=cab" class="nav-link {{ request()->type == 'cab' ? 'active' : '' }}">
        <i class="nav-icon fas fa-taxi"></i>
        <p>CAB Orders</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item {{ array_intersect($module, ['laundry_category', 'laundry_master','food-menu','notice','location','cab','local-fare','outstation-fare']) ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ array_intersect($module, ['laundry_category', 'laundry_master','food_category','food_master','location','cab','local-fare','outstation-fare']) ? 'active' : '' }}">
    <i class="nav-icon fas fa-rupee-sign"></i>
    <p>
      Price Settings
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{route('notice.index')}}" class="nav-link {{ array_intersect($module, ['notice']) ? 'active_child' : '' }}">
        <i class="nav-icon fas fa-exclamation-circle"></i>
        <p>Notice Setting</p>
      </a>
    </li>
    <li class="nav-item {{ array_intersect($module, ['laundry_category', 'laundry_master',]) ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ array_intersect($module, ['laundry_category', 'laundry_master']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tshirt"></i>
        <p>
          Laundry Master
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('laundry_category.index')}}" class="nav-link {{ array_intersect($module, ['laundry_category']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Laundry Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('laundry_master.index')}}" class="nav-link {{ array_intersect($module, ['laundry_master']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i> 
              <p>Laundry Service</p>
            </a>
          </li>
      </ul>
    </li>
    <li class="nav-item {{ array_intersect($module, ['food-menu', 'food_master',]) ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ array_intersect($module, ['food-menu', 'food_master']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-pizza-slice"></i>
        <p>
          Food Master
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('food-menu.index')}}" class="nav-link {{ array_intersect($module, ['food-menu']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i> 
              <p>Food Menu</p>
            </a>
          </li>
          {{--
          <li class="nav-item">
            <a href="{{route('food_category.index')}}" class="nav-link {{ array_intersect($module, ['food_category']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Food Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('food_master.index')}}" class="nav-link {{ array_intersect($module, ['food_master']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i> 
              <p>Food Service</p>
            </a>
          </li>
          --}}
      </ul>
    </li>
    <li class="nav-item {{ array_intersect($module, ['location','cab','local-fare','outstation-fare']) ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ array_intersect($module, ['location','cab','local-fare','outstation-fare']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-taxi"></i>
        <p>
          CAB Master
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('cab.index')}}" class="nav-link {{ array_intersect($module, ['cab']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-truck"></i>
              <p>CAB Types</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('location.index')}}" class="nav-link {{ array_intersect($module, ['location']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>Locations</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('local-fare.index')}}" class="nav-link {{ array_intersect($module, ['local-fare']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>Local Fare</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('outstation-fare.index')}}" class="nav-link {{ array_intersect($module, ['outstation-fare']) ? 'active_child' : '' }}">
              <i class="nav-icon fas fa-route"></i>
              <p>Outstation Fare</p>
            </a>
          </li>
      </ul>
    </li>
  </ul>
</li>
<li class="nav-item mb-5">
    <a class="nav-link" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>
