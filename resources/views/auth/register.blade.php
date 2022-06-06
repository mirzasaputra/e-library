@extends('layouts.auth')

@section('content')
    <img class="wave" src="{{ asset('storage/images/wave.png') }}" alt="">
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="img" style="margin-right: 8rem">
            <img src="{{ asset('storage/images/login.svg') }}" alt="">
        </div>
        <div class="card ms-5 col-4">
            <div class="card-body">
                <h2 class="card-title">Sign Up</h2>
                <div class="card-text">
                    <form action="{{ route('auth.register.store') }}" method="post" data-request="ajax"
                        data-success-callback="{{ route('auth') }}" data-redirect="true">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=" password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="confirm" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 text-center mb-1">Sign Up</button>
                        <p class="small text-center">Already have an account? <a style="text-decoration: none"
                                href="{{ route('auth') }}">sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
