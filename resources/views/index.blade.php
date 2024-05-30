@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<header>
    <nav class="navbar navbar bg-white">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <a href="{{route('home')}}" class="navbar-brand">
                <img src="{{ Voyager::image(setting('site.logo'))}}" alt="Image Brand" class="" style="max-height: 3.5em;">
            </a>
            <form id="search-form" class="mb-3 d-none d-md-flex align-items-center gap-1 ms-auto" style="max-width:30em" onsubmit="handleSearch(event)">
                <input type="search" class="form-control" name="q" id="search-top" placeholder="Search title" value="">
                <button type="submit" class="btn btn-dark">Search</button>
            </form>

            <script>
                function handleSearch(event) {
                    event.preventDefault(); // Mencegah form dari pengiriman default
                    const query = document.getElementById('search-top').value;
                    const url = `/search/${encodeURIComponent(query)}`;
                    window.location.href = url;
                }
            </script>
        </div>
    </nav>
</header>
<main>
    <div class="container rounded-3 my-3 p-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="text-center mx-auto" style="max-width: 50em">
                    <h1 style="font-size: 42px;">{{setting('content.title_hero')}}</h1>
                    <p>{{setting('content.description_hero')}}</p>
                    <form id="search-form" class="mb-3 d-flex align-items-center gap-1 mx-auto" style="max-width:30em" onsubmit="handleSearch(event)">
                        <input type="search" class="form-control" name="q" id="search-input" placeholder="Search title" value="">
                        <button type="submit" class="btn btn-dark">Search</button>
                    </form>
                    
                    <script>
                        function handleSearch(event) {
                            event.preventDefault(); // Mencegah form dari pengiriman default
                            const query = document.getElementById('search-input').value;
                            const url = `/search/${encodeURIComponent(query)}`;
                            window.location.href = url;
                        }
                    </script>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-5">
                    <div>
                        <h2 class="text-bold text-dark mb-0" style="font-size: 28px;">{{ $count->folder }}</h2>
                        <p class="text-uppercase text-secondary">Folders</p>    
                    </div>
                    <div>
                        <h2 class="text-bold text-dark mb-0" style="font-size: 28px;">{{ $count->form }}</h2>
                        <p class="text-uppercase text-secondary">Forms</p>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @forelse ( $folders as $folder )
            @if (!$folder->parent)
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="p-3 shadow-2 rounded-3 border">
                    <img src="{{ $folder->image ? Voyager::image($folder->image) : '/src/image/logo_artisan.png'}}" alt="{{$folder->title}} Image" class="mb-3 d-block rounded-3" style="max-height: 5em;">
                    <div class="d-inline-flex align-items-center gap-1">
                        @if (count($folder->children) > 0)
                        <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark">
                            <div class="text-bold">{{count($folder->children)}}</div><span>Sub Folders</span>
                        </div>
                        @endif
                        <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark">
                            <div class="text-bold">{{count($folder->forms)}}</div><span>Forms</span>
                        </div>
                    </div>
                    <h6 class="mb-0">{{$folder->title}}</h6>
                    <p class="text-secondary">{{$folder->description}}</p>
                    <a href="{{route('folder.slug', $folder->slug)}}" class="btn btn-dark">Open ></a>
                </div>
            </div>
            @endif
            @empty
            <div class="col-12 d-flex align-items-center justify-content-center p-4">
                Oopppsss!! Belum Ada Data Folder, yuk isi
            </div>
            @endforelse
        </div>
    </div>
</main>
<footer>
    <div class="container bg-light rounded-3 p-3 mt-5 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="{{Voyager::image(setting('site.logo'))}}" alt="Logo Footer" class="d-block" style="max-height: 4.5em">
                    <div class="d-flex align-items-center gap-4 pt-2 border-top">
                        @forelse ($sosmeds as $sosmed)
                        <a href="{{url($sosmed->link_sosmed)}}" class="text-dark d-flex align-items-center justify-content-center">
                            <span class="iconify fs-2" data-icon="{{$sosmed->id_icon}}"></span>
                        </a>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

@section('beforebody')
@endsection