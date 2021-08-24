
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Asset Management </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
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
                  <a href="{{ route('unit.index') }}" class="nav-link  {{ Request::is('unit*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Thông tin đơn vị
                      </p>
                  </a>
              </li>
           @endcan

           {{-- Phần menu cho Chi nhánh --}}
           @can(['view_branch','view_all_branch'], App\Models\User::class)
           <li class="nav-item">
               <a href="{{ route('branch.index') }}" class="nav-link  {{ Request::is('branch*') ? 'active' : '' }}">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Quản lý chi nhánh
                   </p>
                </a>
            </li>
          @endcan
            {{-- Phần menu cho phòng ban --}}
          @can('view_department', App\Models\User::class)
                <li class="nav-item">
                  <a href="{{ route('department.index') }}" class="nav-link {{ Request::is('department*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-building"></i>
                      <p>
                          Quản lý phòng ban
                      </p>
                  </a>
              </li>
           @endcan

           @can('view_role', App\Models\User::class)
                <li class="nav-item">
                  <a href="{{ route('role.index') }}" class="nav-link {{ Request::is('role*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-building"></i>
                      <p>
                          Quản lý role
                      </p>
                  </a>
              </li>
           @endcan

           @can('view_permission', App\Models\User::class)
                <li class="nav-item">
                  <a href="{{ route('permission.index') }}" class="nav-link {{ Request::is('permission*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-building"></i>
                      <p>
                          Quản lý quyền
                      </p>
                  </a>
              </li>
           @endcan
          

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>