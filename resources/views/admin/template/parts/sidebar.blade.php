<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}"
                class="nav-link {{ strpos(Route::current()->getName(), 'admin.dashboard.') !== false ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @canany(['view permissions', 'view users'])
            <li
                class="nav-item {{ strpos(Route::current()->getName(), 'admin.user_config.') !== false ? 'menu-open' : '' }} ">
                <a href="#"
                    class="nav-link {{ strpos(Route::current()->getName(), 'admin.user_config.') !== false ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                        Pengaturan User
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('view permissions')
                        <li class="nav-item">
                            <a href="{{ route('admin.user_config.permission.index') }}"
                                class="nav-link {{ strpos(Route::current()->getName(), 'admin.user_config.permission.') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perizinan</p>
                            </a>
                        </li>
                    @endcan
                    @can('view users')
                        <li class="nav-item">
                            <a href="{{ route('admin.user_config.user.index') }}"
                                class="nav-link {{ strpos(Route::current()->getName(), 'admin.user_config.user') !== false ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    </ul>
</nav>
