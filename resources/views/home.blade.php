@extends('layouts.master')

@section('title')
    Nozha Admin Panel
@endsection

@section('css')
@endsection

@section('scripts')
@endsection

@section('page_title')
    Dashboard
@endsection

@section('page_desc')
    Nozha Admin Panel
@endsection

@section('page_icon')
    <i class="fas fa-home"></i>
@endsection

@section('page_title1')
    <a href="{{ route('home') }}">Dashboard</a>
@endsection

@section('page_title2')
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">

            @foreach ($posts as $post)
                <div class="col col-xl-3 col-md-6 col-sm-12 p-2">

                    <div class="card shade outlined o-grey">

                        <div class="p-2">
                            <div class="embed-responsive embed-responsive-1by1">
                                <img class="card-img-top embed-responsive-item" src="{{ asset('cover/' . $post->cover) }}"
                                    alt="">
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title c-grey text-center">{{ $post->title }}</h5>
                            {{-- <p class="text-center">
                                {{ $post->body }}
                            </p> --}}
                            <p class="text-center c-grey">
                                " {{ $post->author }} "
                            </p>
                        </div>

                        <div class="card-body c-grey">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="btn btn-block main f-info fnt-xxs m-1 text-center">Show</a>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="pagination main justify-content-center mt-3">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
