<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ $title }}</h2>
                <div class="breadcrumb-wrapper col-12">
                    @yield('breadcrumb')
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        @yield('header')
    </div>
</div>
<div class="content-body">
    @yield('content')
</div>

<script>
    document.title = "{{ $title .' | Administrator '. getSetting('app_name') }}";
    
    if(!window.jQuery){
        document.body.innerHTML = "";
        window.location.reload();
    }
</script>

@if(isset($mods))
    @if(is_array($mods))
        @foreach($mods as $m)
            <script src="{{ asset('mods/mod_'. $m .'.js') }}"></script>
        @endforeach
    @else
        <script src="{{ asset('mods/mod_'. $mods .'.js') }}"></script>
    @endif
@endif

@yield('_js')