@can('is-admin', App\Models\User::class)
<li class="nav-item">
  <a href="{{route('dashboard')}}" class="nav-link  {{ Request::is('dashboard*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{route('department.index')}}" class="nav-link {{ Request::is('department*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Department
    </p>
  </a>
</li>
@endcan

@can('view_content', App\Models\User::class)
  <li class="nav-item">
    <a href="{{route('content.index')}}" class="nav-link  {{ Request::is('content*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Content
      </p>
    </a>
  </li>
@endcan
@can('view_user', App\Models\User::class)
  <li class="nav-item">
    <a href="{{route('user.index')}}" class="nav-link  {{ Request::is('user*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Users
      </p>
    </a>
  </li>
@endcan
@can('is-admin', App\Models\User::class)
  <li class="nav-item">
    <a href="{{route('role.index')}}" class="nav-link  {{ Request::is('role*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Role
      </p>
    </a>
  </li>
@endcan
@can('is-admin', App\Models\User::class)
  <li class="nav-item">
    <a href="{{route('permission.index')}}" class="nav-link  {{ Request::is('permission*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Permission
      </p>
    </a>
  </li>
@endcan


