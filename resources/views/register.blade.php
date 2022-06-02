<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Member | E-Library App</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">

    <style>
        .wave{
            width: 50%;
            position: fixed;
            bottom: 0;
            z-index: -1;
        }
        .img img{
            width: 500px;
            
        }
        .avatar{
            width: 100px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

</head>

<body>
    <img class="wave" src="{{ asset('storage/images/wave.png') }}" alt="">
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="img" style="margin-right: 8rem">
            <img src="{{ asset('storage/images/login.svg') }}" alt="">
        </div>
        <div class="card ms-5 col-4">
            <div class="card-body">
                {{-- <img class="avatar" src="{{ asset('storage/images/avatar.svg') }}" alt=""> --}}
                <h2 class="card-title">Sign Up</h2>
                <div class="card-text">
                    <form>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="username">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                  <label for="phone" class="form-label">Phone Number</label>
                                  <input type="text" class="form-control" id="phone">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 text-center mb-3">Sign Up</button>
                        <p class="small text-center">Already have an account? <a style="text-decoration: none" href="{{route('login')}}">sign in</a></p>
                      </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>

</body>

</html>
