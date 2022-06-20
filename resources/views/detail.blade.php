@extends('layouts.frontend')

@section('content')

<div class="col-md-8 col-sm-10 col-11 mx-auto my-5">
    <div class="row align-items-center justify-content-center py-5">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="col-8 mx-auto">
                <img src="{{ asset('storage/images/books/'. $data->picture) }}" alt="" width="100%">
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-12 mt-xs-3">
            <div class="col-md-8 col-sm-10 col-12">
                <span class="badge bg-primary small">{{ ucfirst($data->genre->name) }}</span>
                <h3>{{ $data->name }}</h3>
                <p class="text-muted mb-4">{{ $data->description }}</p>
                <table class="text-muted mb-4">
                    <tr>
                        <td class="pe-4">Tahun Terbit</td>
                        <td>: {{$data->publication_year}}</td>
                    </tr>
                    <tr>
                        <td>Penulis</td>
                        <td>: {{$data->author}}</td>
                    </tr>
                </table>
                <a href="{{ route('booking.store', $data->hashid) }}" class="btn btn-primary px-5 d-xs-block" style="border-radius: 25px;">Booking Now</a>
            </div>
        </div>
    </div>
</div>

{{-- Latest Book --}}
<section id="latestBook" class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center mb-5"><span style="border-bottom: 3px solid #68A7AD;padding: 3px">LATEST BOOKS</span></h4>
        <div class="row my-5">
            @foreach($latestBooks as $item)
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('detail', $item->hashid) }}" class="nav-link">
                    <div class="card books shadow-sm">
                        <span class="latest-books">NEW</span>
                        <div class="card-body text-dark" style="text-align: justify">
                            <div class="card-image">
                                <img src="{{ asset('storage/images/books/'. $item->picture) }}" alt="" width="100%">
                            </div>
                            <span class="badge bg-primary small">{{ ucfirst($item->genre->name) }}</span>
                            <h6>{{ substr($item->name, 0, 26) . (strlen($item->name) > 26 ? '...' : '') }}</h6>
                            <p class="text-muted">{{ substr($item->description, 0, 35) . (strlen($item->description) > 35 ? '...' : '') }}</p>
                            <p class="text-end text-muted m-0 p-0" style="font-size: 10px;">{{ number_format($item->count_views) }} views</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- End Latest Book --}}

@endsection