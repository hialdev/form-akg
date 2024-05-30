@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<header>
    
</header>
<main>
    <div class="position-sticky top-0 p-3">
        <div class="d-flex align-items-center gap-2 pe-3" style="border-radius: 99px; background-color:rgb(248, 220, 166);">
            @php
                $back = route('home');
                if($folder->parent){
                    $back = url()->previous();
                }else{
                    $back = route('home');
                }
            @endphp
            <a href="{{$back}}" class="d-flex align-items-center justify-content-center p-3 bg-dark text-white border-2 border-white" style="border-radius: 99px">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4"/></svg>
            </a>
            Back

            <div class="ms-auto d-flex align-items-center gap-3 pe-3">
                @forelse ($sosmeds as $sosmed)
                <a href="{{url($sosmed->link_sosmed)}}" class="text-dark d-flex align-items-center justify-content-center">
                    <span class="iconify fs-4" data-icon="{{$sosmed->id_icon}}"></span>
                </a>
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 py-3">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="p-3 shadow-2 rounded-3 d-flex gap-3">
                            <img src="{{$folder->image ? Voyager::image($folder->image) : '/src/image/logo_artisan.png' }}" alt="Logo" class="mb-3 d-block rounded-3" style="max-height: 5em;">
                            <div>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form class="ms-auto d-flex mb-3">
                            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ $searched ? $searched : old('search')}}">
                            <button type="submit" class="btn btn-dark">Search</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="bg-light py-4" style="min-height: 80vh;">
        @if(count($folder->children) > 0)
            <div class="container mb-3">
                <div class="row">
                    <div class="col-12">
                        <h4>Sub Folders</h4>
                    </div>
                    @forelse ($folder->children as $children)
                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="p-3 shadow-2 rounded-3 border bg-white">
                            <img src="{{ $children->image ? Voyager::image($children->image) : '/src/image/logo_artisan.png'}}" alt="{{$children->title}} Image" class="mb-3 d-block rounded-3" style="max-height: 5em;">
                            <div class="d-inline-flex align-items-center gap-1">
                                @if (count($children->children) > 0)
                                <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark">
                                    <div class="text-bold">{{count($children->children)}}</div><span>Sub Folders</span>
                                </div>
                                @endif
                                <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark">
                                    <div class="text-bold">{{count($children->forms)}}</div><span>Forms</span>
                                </div>
                            </div>
                            <h6 class="mb-0">{{$children->title}}</h6>
                            <p class="text-secondary">{{$children->description}}</p>
                            <a href="{{route('folder.slug', $children->slug)}}" class="btn btn-dark">Open ></a>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row">
                @if (count($folder->children) > 0)
                    <div class="col-12">
                        <h4>Forms</h4>
                    </div>
                @endif
                @forelse ($forms as $form)
                <div class="col-12 col-md-6 mb-2">
                    <div class="text-decoration-none d-block text-dark bg-white rounded-3 p-3 px-4">
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
                @if (count($folder->children) < 1)
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        Oooppsss!! Tidak ditemukan Form nih, lihat folder lain yah
                    </div>
                </div>
                @else
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        Oooppsss!! Tidak ditemukan Form nih, lihat dan cari pada folder / subfolder lain yah
                    </div>
                </div>
                @endif
                @endforelse
                
            </div>
        </div>
    </section>
</main>
@endsection

@section('beforebody')
@endsection