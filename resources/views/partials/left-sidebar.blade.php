<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Asset Management </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @foreach (Session::get('userInfo') as $user)
                <div class="image">
                    <img src={{$user->image ? $user->image : asset('/files/user_avt/user-avt.png')}}  
                    style="display: inline-block; width: 2rem; height: 2rem; object-fit: cover"
                    class="img-circle elevation-2" 
                    alt="User Image">
                </div>
                <div class="info">
                    <a href="/profile" class="d-block">
                            {{ $user->name }}
                    </a>
                </div>
            @endforeach
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Phần menu cho đơn vị --}}
                @can('view_unit', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('unit.index') }}"
                            class="nav-link  {{ Request::is('unit*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Thông tin đơn vị
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu cho chi nhánh --}}
                @can(['view_all_branch', 'view_branch'], App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('branch.index') }}"
                            class="nav-link  {{ Request::is('branch*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-code-branch"></i>
                            <p>
                                Quản lý chi nhánh
                            </p>
                        </a>
                    </li>
                @endcan
                @cannot(['view_all_branch', 'view_branch'], App\Models\User::class)
                    @can('view_all_branch', App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('branch.index') }}"
                                class="nav-link  {{ Request::is('branch*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>
                                    Quản lý chi nhánh
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view_branch', App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('branch.index') }}"
                                class="nav-link  {{ Request::is('branch*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>
                                    Quản lý chi nhánh
                                </p>
                            </a>
                        </li>
                    @endcan
                @endcannot

                {{-- Quản lý tài sản --}}
                @can('view_assets', User::class)
                <li class="nav-item {{ Request::is('assets*') || Request::is('repair-fee*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="/assets" class="nav-link {{ Request::is('assets*') ||  Request::is('repair-fee*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-suitcase-rolling"></i>
                      <p>
                        Quản lý tài sản
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('assets.index') }}" class="nav-link {{ Request::is('assets*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Quản lý tài sản</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('assets-repair.index') }}" class="nav-link {{ Request::is('repair-fee*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Sửa chữa</p>
                        </a>
                      </li>
                    </ul>
                </li>
                @endcan
                {{-- Quản lý phiếu nhập xuất --}}
                <li class="nav-item {{ Request::is('*note*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="/" class="nav-link {{ Request::is('*note*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Quản lý nhập xuất
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('receipt-note.index')}} class="nav-link {{ Request::is('*note*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý nhập xuất</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Phần menu cho phòng ban --}}
                @can('view_department', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('department.index') }}"
                            class="nav-link {{ Request::is('department*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Quản lý phòng ban
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu users --}}
                @can('view_user', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Quản lý nhân viên
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu role --}}
                @can('view_role', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}"
                            class="nav-link {{ Request::is('role*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>
                                Quản lý role
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu permission --}}
                @can('view_permission', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}"
                            class="nav-link {{ Request::is('permission*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Quản lý quyền
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu nhà cung cấp --}}
                @can('view_provide', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('provide.index') }}"
                            class="nav-link {{ Request::is('provide*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Nhà cung cấp
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu loại tài sản--}}
                @can('view_property_type', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('property_type.index') }}"
                            class="nav-link {{ Request::is('property_type*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Loại tài sản
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần menu nhóm tài sản --}}
                @can('view_property_group', App\Models\User::class)
                    <li class="nav-item">
                        <a href="{{ route('property_group.index') }}"
                            class="nav-link {{ Request::is('property_group*') ? 'active' : '' }}">
                            <i class="nav-icon fab fa-blackberry"></i>
                            <p>
                                Nhóm tài sản
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- Phần đăng xuất --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt icon-logout"></i>
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
