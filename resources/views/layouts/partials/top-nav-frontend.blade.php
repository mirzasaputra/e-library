<div class="container">
    <div class="row">
        <div class="col-6 py-3">
            <img src="{{ asset('storage/images/Logo.png') }}" alt="" height="50">
        </div>
        <div class="col-6 align-items-center d-flex">
            <div class="col-md-6 ms-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-search" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            @if(!is_null(getInfoLogin()))
            <div class="ms-auto">
                <a class="nav-link text-muted" href="#" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="me-3">
                            <strong class="p-0 m-0">{{ ucfirst(getInfoLogin()->name) }}</strong>
                            <p class="p-0 m-0 small text-muted">{{ getInfoLogin()->roles[0]->name }}</p>
                        </div>
                        <span><img class="round" src="{{ 'https://ui-avatars.com/api/?name=' . getInfoLogin()->name . '&&background=random' }}" alt="avatar" height="40" width="40"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i> Edit Profile</a>
                    <a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a>
                    <a class="dropdown-item" href="app-todo.html"><i class="feather icon-check-square"></i> Task</a>
                    <a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="feather icon-power"></i> Logout</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupport"><span class="navbar-toggler-icon"></span></button>
        <div class="navbar-collapse collapse" id="navbarSupport">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('katalog') }}" class="nav-link">Katalog</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('booking') }}" class="nav-link">Booking</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                </li>
            </ul>
        </div>
        @if(is_null(getInfoLogin()))
            <div class="ms-auto">
                <a href="{{ route('auth') }}" class="btn btn-primary btn-custom-left">Login</a>
                <a href="{{ route('auth.register') }}" class="btn btn-primary btn-custom-right">Register</a>
            </div>
        @endif
    </div>
</nav>