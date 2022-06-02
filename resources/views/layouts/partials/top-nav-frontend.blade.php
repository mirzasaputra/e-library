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
        <div class="ms-auto">
            <button class="btn btn-primary btn-custom-left">Login</button>
            <button class="btn btn-primary btn-custom-right">Register</button>
        </div>
    </div>
</nav>