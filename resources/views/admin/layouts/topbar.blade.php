<!-- .app-header -->
<header class="app-header app-header-dark">
    <!-- .top-bar -->
    <div class="top-bar">
        <!-- .top-bar-brand -->
        <div class="top-bar-brand">
            <!-- toggle aside menu -->
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
            <a href="{{ route('admin.dashboard') }}">
                <h4 class="mb-0">ADMIN BLOG</h4>
            </a>
        </div><!-- /.top-bar-brand -->
        <!-- .top-bar-list -->
        <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <!-- toggle menu -->
                <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
            </div>
            <!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-full">
                <!-- .top-bar-search -->
                <form class="top-bar-search">
                    <!-- .input-group -->
                    <div class="input-group input-group-search dropdown">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="oi oi-magnifying-glass"></span>
                            </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Search" placeholder="Search">
                    </div>
                    <!-- /.input-group -->
                </form>
                <!-- /.top-bar-search -->
            </div>
            <!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                <!-- .nav -->
                <ul class="header-nav nav">
                    <!-- .nav-item -->
                    <li class="nav-item dropdown header-nav-dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="oi oi-grid-three-up"></span>
                        </a>
                        <!-- .dropdown-menu -->
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <div class="dropdown-arrow"></div>
                            <!-- .dropdown-sheets -->
                            <div class="dropdown-sheets">
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper">
                                        <span class="tile tile-lg bg-teal">
                                            <i class="oi oi-fork"></i>
                                        </span>
                                        <span class="tile-peek">Blogs</span>
                                    </a>
                                </div>
                                <!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper">
                                        <span class="tile tile-lg bg-pink">
                                            <i class="fa fa-tasks"></i>
                                        </span>
                                        <span class="tile-peek">Tasks</span>
                                    </a>
                                </div>
                                <!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper">
                                        <span class="tile tile-lg bg-cyan">
                                            <i class="oi oi-document"></i></span>
                                        <span class="tile-peek">Media</span>
                                    </a>
                                </div>
                                <!-- /.dropdown-sheet-item -->
                            </div>
                            <!-- .dropdown-sheets -->
                        </div>
                        <!-- .dropdown-menu -->
                    </li>
                    <!-- /.nav-item -->
                </ul>
                <!-- /.nav -->
                <!-- .btn-account -->
                <div class="dropdown d-none d-md-flex">
                    <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user-avatar user-avatar-md">
                            <img src="{{ 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&color=7F9CF5&background=EBF4FF' }}" alt="{{ Auth::user()->name }}">
                        </span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <span class="account-name">{{ Auth::user()->name }}</span>
                            <span class="account-description">
                                @if (Auth::user()->is_super) Super Admin @else Admin @endif
                            </span>
                        </span>
                    </button>
                    <!-- .dropdown-menu -->
                    <div class="dropdown-menu">
                        <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                        <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                        <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ Auth::user()->name }} </h6>
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
                    </div>
                    <!-- /.dropdown-menu -->
                </div>
                <!-- /.btn-account -->
            </div>
            <!-- /.top-bar-item -->
        </div>
        <!-- /.top-bar-list -->
    </div>
    <!-- /.top-bar -->
</header>
<!-- /.app-header -->
