@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-sm-3">
            <div class="card shadow-sm rounded">
                <ul class="katalog">
                    <li class="item active">
                        <a href="">All</a>
                    </li>
                    <li class="item">
                        <a href="">Romance</a>
                    </li>
                    <li class="item">
                        <a href="">Education</a>
                    </li>
                    <li class="item">
                        <a href="">Comic</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="col-sm-6 col-10 mx-auto mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-search" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mx-auto">
                        <img src="{{ asset('storage/images/no-result-found.png') }}" alt="" width="100%">
                        <h5 class="text-center text-primary" style="margin-top: -50px;">No Result Found.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('_js')
<script>
    $('ul.katalog li.item a').unbind().on('click', function(e){
        e.preventDefault();
        $('ul.katalog li.item.active').removeClass('active')
        $(this).parent().addClass('active')
    })
</script>
@endsection