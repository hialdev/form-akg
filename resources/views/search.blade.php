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
                <input type="search" class="form-control" name="q" value="{{$q ? $q : old('q')}}" id="search-top" placeholder="Search title" value="">
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
                    <h1 style="font-size: 42px;">Mencari Folder / Form</h1>
                    <p class="fs-2 text-secondary">"{{$q}}"</p>
                    <form id="search-form" class="mb-3 d-flex align-items-center gap-1 mx-auto" style="max-width:30em" onsubmit="handleSearch(event)">
                        <input type="search" class="form-control" name="q" value="{{$q ? $q : old('q')}}" id="search-input" placeholder="Search title" value="">
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
            <div class="col-12">
                <h4>Folders</h4>
            </div>
            @forelse ( $folders as $folder )
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="p-3 shadow-2 rounded-3 border">
                    <img src="{{ $folder->image ? Voyager::image($folder->image) : '/src/image/logo_artisan.png'}}" alt="{{$folder->title}} Image" class="mb-3 d-block rounded-3" style="max-height: 5em;">
                    <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark"><div class="text-bold">{{count($folder->forms)}}</div><span>Forms</span></div>
                    <h6 class="mb-0">{{$folder->title}}</h6>
                    <p class="text-secondary">{{$folder->description}}</p>
                    <a href="{{route('folder.slug', $folder->slug)}}" class="btn btn-dark">Open ></a>
                </div>
            </div>
            @empty
            <div class="col-12 d-flex align-items-center justify-content-center p-4">
                Tidak ada folder yang cocok dengan kata pencarian
            </div>
            @endforelse
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h4>Forms</h4>
            </div>
            @forelse ($forms as $form)
            <div class="col-12 col-md-6 mb-2">
                <div class="text-decoration-none d-block text-dark bg-white rounded-3 p-3 px-4 border">
                    <div class="mb-2">
                        <div class="fw-semibold">{{$form->title}}</div>
                        <p class="mb-0 text-secondary">{{$form->description}}</p>
                    </div>
                    @if ($form->link)
                    <a href="{{$form->link}}" class="d-flex align-items-center justify-content-between bg-light text-dark p-2 px-3 rounded-3 gap-3">
                        <div>Buka Link</div>
                        <svg style="transform: scaleX(-1)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17.6 18L8 8.4V17H6V5h12v2H9.4l9.6 9.6z"/></svg>
                    </a>
                    @else
                    @php
                        $file = json_decode($form->files);
                        $file = $file[0];
                    @endphp
                    <a href="{{Voyager::image($file->download_link)}}" class="text-decoration-none d-flex align-items-center justify-content-between bg-light text-dark p-2 px-3 rounded-3 gap-3">
                        <div>{{$file->original_name}}</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2a1 1 0 0 0-1 1v2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-6V3a1 1 0 0 0-1-1m1 3v8.828L14.828 12a1 1 0 0 1 1.415 1.414l-3.36 3.359a1.25 1.25 0 0 1-1.767 0l-3.359-3.359A1 1 0 1 1 9.172 12L11 13.828V5z"/></g></svg>
                    </a> 
                    @endif
                </div>
            </div>    
            @empty
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    Tidak ada form yang sesuai dengan kata pencarian
                </div>
            </div>
            @endforelse
        </div>
    </div>
</main>
<footer>
    <div class="container bg-light rounded-3 p-3 mt-5 mt-3">
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