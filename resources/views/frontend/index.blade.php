<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <title>Document</title>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <img src="{{ asset('storage/images/logo.png')}}" alt="" style="width: 200px">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Katalog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Booking</a>
              </li>
              <li class="nav-item">
                <a class="nav-link">Contact Us</a>
              </li>
            </ul>
            <div class="btn-group mx-3">
                <a href="#" class="btn btn-primary" aria-current="page">Register</a>
                <a href="#" class="btn btn-primary">Login</a>
            </div>
          </div>
        </div>
    </nav>
      <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="{{ asset('storage/images/buku resep1.jpg')}}" alt="" width= "100%">
            </div>
            <div class="col-4">
                <div class="d-block mb-3">
                    <img src="{{ asset('storage/images/buku sejarah1.jpg')}}" alt="" width="100%">
                </div>
                <div class="d-block">
                    <img src="{{ asset('storage/images/buku motivasi3.jpg')}}" alt="" width="100%">
                </div>
            </div>
        </div>
      </div>
      <div class="container bg-light mt-5 py-4">
        <h2 class="text-center">Popular Books</h2>
        <div class="row">
            <div class="col-3">
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/images/buku1.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/images/buku1.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/images/buku1.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/images/buku1.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to...</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>