@extends('layout.app')
@section('seo')
    @include('partials.seo', ['data' => $seo])
@endsection
@section('inhead')
@endsection

@section('content')
<main class="bg-light" style="min-height:100vh">
    <div class="container p-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column align-items-center justify-center">
                    <a href="{{route('home')}}" class="navbar-brand">
                        <img src="{{ Voyager::image(setting('site.logo'))}}" alt="Image Brand" class="" style="max-height: 5.5em;">
                    </a>
                    <div class="text-center">
                        <h4>The Door is locked!</h4>
                        <p>Unlock for see the secret recipe..</p>
                    </div>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div style="min-width: 20em" class="p-4 rounded-3 bg-white">
                        <form method="POST" action="{{route('access.unlock')}}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" placeholder="username" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="password" placeholder="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Unlock</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('beforebody')
@endsection