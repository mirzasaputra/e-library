<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ ucfirst(getInfoLogin()->name) }}</span><span class="user-status">{{ getInfoLogin()->roles[0]->name }}</span></div><span><img class="round" src="{{ 'https://ui-avatars.com/api/?name=' . getInfoLogin()->name . '&&background=random' }}" alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="feather icon-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="feather icon-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mx-auto">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}" data-toggle="ajax">
                    <img src="{{ asset('storage/images/'. getSetting('app_logo')) }}" alt="" height="50" >
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can('read-dashboard')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">
                    <i class="feather icon-home"></i> 
                    Dashboard
                </a>
            </li>
            @endcan
            @canany(['read-genres', 'read-books', 'read-members', 'read-borrows', 'read-book-returns', 'read-reports'])
            <li class=" navigation-header">
                <span>Apps</span>
            </li>
            @canany(['read-genres', 'read-books', 'read-members'])
            <li class=" nav-item">
                <a href="#">
                    <i class="feather icon-grid"></i>
                    <span class="menu-title">Master Data</span>
                </a>
                <ul class="menu-content">
                    @can('read-genres')
                    <li>
                        <a href="{{ route('admin.genres') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Data Genre</span>
                        </a>
                    </li>
                    @endcan
                    @can('read-books')
                    <li>
                        <a href="{{ route('admin.books') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Data Buku</span>
                        </a>
                    </li>
                    @endcan
                    @can('read-members')
                    <li>
                        <a href="{{ route('admin.members') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Data Anggota</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @canany(['read-borrows', 'read-book-returns'])
            <li class=" nav-item">
                <a href="#">
                    <i class="feather icon-repeat"></i>
                    <span class="menu-title">Transaksi</span>
                </a>
                <ul class="menu-content">
                    @can('read-borrows')
                    <li>
                        <a href="{{ route('admin.borrows') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Peminjaman</span>
                        </a>
                    </li>
                    @endcan
                    @can('read-book-returns')
                    <li>
                        <a href="{{ route('admin.book-returns') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Pengembalian</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @can('read-reports')
            <li class="nav-item">
                <a href="{{ route('admin.reports') }}" data-toggle="ajax" class="nav-link">
                    <i class="feather icon-file"></i>
                    Laporan
                </a>
            </li>
            @endcan
            @endcanany
            @canany(['read-settings', 'read-users', 'read-roles'])
            <li class=" navigation-header">
                <span>Pengaturan</span>
            </li>
            @can('read-settings')
            <li class="nav-item">
                <a href="{{ route('admin.settings') }}" data-toggle="ajax" class="nav-link">
                    <i class="feather icon-settings"></i>
                    Setting
                </a>
            </li>
            @endcan
            @canany(['read-users', 'read-roles'])
            <li class=" nav-item">
                <a href="#">
                    <i class="feather icon-user"></i>
                    <span class="menu-title">Management Users</span>
                </a>
                <ul class="menu-content">
                    @can('read-users')
                    <li>
                        <a href="{{ route('admin.users') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Users</span>
                        </a>
                    </li>
                    @endcan
                    @can('read-roles')
                    <li>
                        <a href="{{ route('admin.roles') }}" data-toggle="ajax">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">Roles</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @endcanany
        </ul>
    </div>
</div>
<!-- END: Main Menu-->