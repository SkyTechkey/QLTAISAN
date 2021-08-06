@can('is-admin', App\Models\User::class)
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link  {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('department.index') }}" class="nav-link {{ Request::is('department*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-building"></i>
            <p>
                Department
            </p>
        </a>
    </li>
@endcan

@can('view_content', App\Models\User::class)
    <li class="nav-item menu-open">
      <a href="{{route('content.index')}}" class="nav-link  {{ Request::is('content*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>
          Files
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
        <ul class="nav nav-treeview">
        @foreach (Session::get('types') as $type)
            <li class="nav-item">
                <a href="{{ route('content.show', ['content' => $type->id]) }}"
                    class="nav-link  {{ Request::is('content/' . $type->id) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-{{ $type->name }}"></i>
                    <p>
                        {{ $type->name }}
                    </p>
                </a>
            </li>
        @endforeach
      </ul>
    </li>
@endcan

@can('is-admin', App\Models\User::class)
    <li class="nav-item">
        <a href="{{ route('user.index') }}" class="nav-link  {{ Request::is('user*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Users
            </p>
        </a>
    </li>
@endcan

@can('is-admin', App\Models\User::class)
    <li class="nav-item">
        <a href="{{ route('role.index') }}" class="nav-link  {{ Request::is('role*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-tag"></i>
            <p>
                Role
            </p>
        </a>
    </li>
@endcan

@can('is-admin', App\Models\User::class)
    <li class="nav-item">
        <a href="{{ route('permission.index') }}" class="nav-link  {{ Request::is('permission*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Permission
            </p>
        </a>
    </li>
@endcan
