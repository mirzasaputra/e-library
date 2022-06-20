@extends('layouts.frontend')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-sm-3 mb-5">
            <div class="card shadow-sm rounded">
                <ul class="katalog">
                    <li class="item active">
                        <a href="{{ route('katalog.getData', 'all') }}">All</a>
                    </li>
                    @foreach($genres as $item)
                        <li class="item">
                            <a href="{{ route('katalog.getData', $item->hashid) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card shadow-sm" style="min-height: 90vh">
                <div class="card-body p-4">
                    <div class="col-sm-6 col-10 mx-auto mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-search" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="loader d-flex align-items-center justify-content-center d-none" style="height: 70vh">
                        <div class="text-center">
                            <i class="fa fa-sync-alt fa-spin fa-2x text-primary mb-3"></i>
                            <p>Memuat data...</p>
                        </div>
                    </div>
                    <div class="d-none" id="render"></div>
                    <div class="col-md-6 col-10 mx-auto d-none" id="noResultFound">
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
    loadData(`{{ route('katalog.getData', 'all') }}`)

    $('ul.katalog li.item a').unbind().on('click', async function(e){
        e.preventDefault();
        $('ul.katalog li.item.active').removeClass('active')
        $(this).parent().addClass('active')

        loadData($(this).attr('href'))
    })
    
    async function loadData(url)
    {
        $('.loader').removeClass('d-none')
        $('#noResultFound').addClass('d-none')
        $('#render').addClass('d-none')
        const res = await fetch(url)
        
        if(res.status == 200){
            var render = `<div class="row">`
            var data = await res.json()

            if(data.length > 0){
                data.forEach((val) => {
                    render += `<div class="col-md-4 col-sm-6 col-12">
                                <a href="${$('meta[name="base-url"]').attr('content') }/${val.hashid}/detail" class="nav-link">
                                    <div class="card books shadow-sm">
                                        <span class="latest-books">NEW</span>
                                        <div class="card-body text-dark" style="text-align: justify">
                                            <div class="card-image">
                                                <img src="${$('meta[name="base-url"]').attr('content') }/storage/images/books/${val.picture}" alt="" width="100%">
                                            </div>
                                            <span class="badge bg-primary small">${val.genre}</span>
                                            <h6>${val.name}</h6>
                                            <p class="text-muted">${val.description}</p>
                                            <p class="text-end text-muted m-0 p-0" style="font-size: 10px;">${val.count_views} views</p>
                                        </div>
                                    </div>
                                </a>
                            </div>`
                })
                render += `</div>`
                $('#render').html(render)
                
                $('.loader').addClass('d-none')
                $('#render').removeClass('d-none')
                $('#noResultFound').addClass('d-none')
            } else {
                $('.loader').addClass('d-none')
                $('#render').addClass('d-none')
                $('#noResultFound').removeClass('d-none')
            }
        } else {
            $('.loader').addClass('d-none')
            $('#render').addClass('d-none')
            $('#noResultFound').removeClass('d-none')
        }
    }
</script>
@endsection