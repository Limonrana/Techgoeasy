<!-- .app-aside -->
<aside class="app-aside app-aside-expand-md app-aside-light">
    <!-- .aside-content -->
    <div class="aside-content">
        <!-- .aside-header -->
        <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
                <span class="user-avatar user-avatar-lg"><img src="{{ 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&color=7F9CF5&background=EBF4FF' }}" alt="{{ Auth::user()->name }}"></span>
                <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span>
                <span class="account-summary"><span class="account-name">{{ Auth::user()->name }}</span>
                    <span class="account-description"> @if (Auth::user()->is_super) Super Admin @else Admin @endif </span></span>
            </button>
            <!-- /.btn-account -->

            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
                <!-- dropdown-items -->
                <div class="pb-3">
                    <a class="dropdown-item" href="{{ route('admin.account') }}">
                        <span class="dropdown-icon oi oi-person"></span> Account
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();">
                            <span class="dropdown-icon oi oi-account-logout"></span> Logout
                        </a>
                    </form>
                </div><!-- /dropdown-items -->
            </div><!-- /.dropdown-aside -->
        </header><!-- /.aside-header -->
        <!-- .aside-menu -->
        <div class="aside-menu overflow-hidden">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
                <!-- .menu -->
                <ul class="menu">
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/dashboard') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <span class="menu-icon fas fa-home"></span> <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-header -->
                    <li class="menu-header">CMS Manage</li>
                    <!-- /.menu-header -->
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/media*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.media') }}" class="menu-link">
                            <span class="menu-icon fas fa-images"></span> <span class="menu-text">Media</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/categories*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.categories.index') }}" class="menu-link">
                            <span class="menu-icon oi oi-bar-chart"></span> <span class="menu-text">Category</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/tags*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.tags.index') }}" class="menu-link">
                            <span class="menu-icon fas fa-table"></span> <span class="menu-text">Tags</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item has-child {{ Request::is('admin/blogs*') ? 'has-open' : '' }}">
                        <a href="#" class="menu-link">
                            <span class="menu-icon oi oi-list-rich"></span> <span class="menu-text">Blog Post</span>
                        </a>
                        <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/blogs') ? 'has-active' : '' }}">
                                <a href="{{ route('admin.blogs.index') }}" class="menu-link">Blog Overview</a>
                            </li>
                            <li class="menu-item {{ Request::is('admin/blogs/create') ? 'has-active' : '' }}">
                                <a href="{{ route('admin.blogs.create') }}" class="menu-link">Add New Blog</a>
                            </li>
                        </ul>
                        <!-- /child menu -->
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item has-child {{ Request::is('admin/appearance*') ? 'has-open' : '' }}">
                        <a href="#" class="menu-link">
                            <span class="menu-icon oi oi-puzzle-piece"></span> <span class="menu-text">Appearance</span>
                        </a>
                        <!-- child menu -->
                        <ul class="menu">
                            <li class="menu-item {{ Request::is('admin/appearance/customize*') ? 'has-active' : '' }}">
                                <a href="{{ route('admin.customize.index', 'header') }}" class="menu-link">Customize</a>
                            </li>
{{--                            <li class="menu-item">--}}
{{--                                <a href="#" class="menu-link">Theme Settings</a>--}}
{{--                            </li>--}}
                            <li class="menu-item {{ Request::is('admin/appearance/menus*') ? 'has-active' : '' }}">
                                <a href="{{ route('admin.menus.index') }}" class="menu-link">Menu Builder</a>
                            </li>
                        </ul>
                        <!-- /child menu -->
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-header -->
                    <li class="menu-header">Account Manage </li>
                    <!-- /.menu-header -->
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/settings*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.settings.index', 'general') }}" class="menu-link">
                            <span class="menu-icon oi oi-wrench"></span> <span class="menu-text">Settings</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
{{--                    <li class="menu-item has-child">--}}
{{--                        <a href="#" class="menu-link">--}}
{{--                            <span class="menu-icon oi oi-person"></span> <span class="menu-text">User</span>--}}
{{--                        </a>--}}
{{--                        <!-- child menu -->--}}
{{--                        <ul class="menu">--}}
{{--                            <li class="menu-item">--}}
{{--                                <a href="user-profile.html" class="menu-link">Users Overview</a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item">--}}
{{--                                <a href="user-activities.html" class="menu-link">Add New User</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <!-- /child menu -->--}}
{{--                    </li>--}}
                    <!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item {{ Request::is('admin/account*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.account') }}" class="menu-link">
                            <span class="menu-icon fas fa-user-circle"></span> <span class="menu-text">My Account</span>
                        </a>
                    </li>
                    <!-- /.menu-item -->
                </ul><!-- /.menu -->
            </nav><!-- /.stacked-menu -->
        </div><!-- /.aside-menu -->
        <!-- Skin changer -->
        <footer class="aside-footer border-top p-2">
            <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span class="d-compact-menu-none">Night mode</span> <i class="fas fa-moon ml-1"></i></button>
        </footer><!-- /Skin changer -->
    </div><!-- /.aside-content -->
</aside>
<!-- /.app-aside -->
