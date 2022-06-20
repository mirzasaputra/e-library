@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <div class="row align-items-center justify-content-center mb-5">
        <div class="col-md-7">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.0557942098394!2d114.3016026143771!3d-8.29724669403051!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1572a014c0f71%3A0xc4cff52255bb2ce4!2sKec.%20Rogojampi%2C%20Kabupaten%20Banyuwangi%2C%20Jawa%20Timur%2C%20Indonesia!5e0!3m2!1sid!2ssg!4v1653814824297!5m2!1sid!2ssg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-md-5 ms-4 ms-xs-0 mt-xs-3">
            <h4>Kontak Kami</h4>
            <hr>
            <p class="text-muted mt-4" style="text-align: justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur animi ratione voluptatem alias provident odio in! Modi nihil voluptatibus error, sunt, quaerat odit doloremque totam ducimus temporibus quod ipsa maiores asperiores expedita at mollitia nemo!
            </p>
            <div class="my-5">
                <p><i class="fa fa-map-marker-alt text-primary me-3"></i> Jl. Untung Suropati No. 20</p>
                <p><i class="fa fa-phone fa-rotate-90 text-primary me-3"></i> +62 812 3822 2293</p>
                <p><i class="fa fa-envelope text-primary me-3"></i> service@elibrary.co.id</p>
                <p><i class="fab fa-instagram text-primary me-3"></i> @e_library_rogojampii</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center m-0">Kritik & Saran</h3>
            <p class="text-muted text-center mb-4">Berikan kritik & saran anda untuk kami.</p>
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input type="text" class="form-control px-4 py-3" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input type="text" class="form-control px-4 py-3" placeholder="No. Telp">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea rows="4" class="form-control px-4 py-3" placeholder="Messages"></textarea>
                </div>
                <div class="text-center mb-3">
                    <button class="btn btn-primary px-5 py-3"><i class="fa fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection