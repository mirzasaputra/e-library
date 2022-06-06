@extends('layouts.auth')

@section('content')
    <img class="wave" src="{{ asset('storage/images/wave.png') }}" alt="">
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="img" style="margin-right: 16rem">
            <img src="{{ asset('storage/images/login.svg') }}" alt="">
        </div>
        <div class="card ms-5 col-3">
            <div class="card-body">
                <img class="avatar" src="{{ asset('storage/images/avatar.svg') }}" alt="">
                <h2 class="card-title text-center"> Sign In</h2>
                <div class="card-text">
                    <form action="{{ route('auth.login') }}" method="post" data-request="ajax" data-redirect="true">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="Check">
                            <label class="form-check-label" for="Check">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 text-center mb-1">Sign In</button>
                        <p class="small text-center">Don't have an account? <a style="text-decoration: none"
                                href="{{ route('auth.register') }}">sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection
