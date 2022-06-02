<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Member | E-Library App</title>
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
        <div class="img" style="margin-right: 16rem">
            <img src="{{ asset('storage/images/login.svg') }}" alt="">
        </div>
        <div class="card ms-5 col-3">
            <div class="card-body">
                <img class="avatar" src="{{ asset('storage/images/avatar.svg') }}" alt="">
                <h2 class="card-title text-center"> Sign In</h2>
                <div class="card-text">
                    <form>
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 text-center mb-3">Sign In</button>
                        <p class="small text-center">Don't have an account? <a style="text-decoration: none" href="{{route('register')}}" >sign up</a></p>
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
