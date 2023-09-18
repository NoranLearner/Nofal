@extends('layouts.master')

@section('title')
    Post Management
@endsection

@section('css')
@endsection

@section('page_title')
    Show Post
@endsection

@section('page_desc')
    Post Management
@endsection

@section('page_icon')
    <i class="fab far fa-comments"></i>
@endsection

@section('page_title1')
    <a href="{{ route('posts.index') }}">Products</a>
@endsection

@section('page_title2')
    <a href="#" class="c-grey">show</a>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="mb-3">
            <a class="btn btn-primary d-inline-block" href="{{ route('posts.index') }}"> Back </a>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <h5 class="c-first d-inline-block">{{ $post->title }}</h5>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Author:</strong>
                    <h5 class="c-first d-inline-block">{{ $post->author }}</h5>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <h5 class="c-first d-inline-block">{{ $post->body }}</h5>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cover Image:</strong>
                    <div class="card shade c-grey m-4">
                        <h5 class="card-header">Post Cover</h5>
                        <div class="card-body">
                            <form action="/coverDelete/{{ $post->id }}" method="post">
                                <button class="btn text-danger d-block"
                                    onclick="return confirm('Are you sure detete this cover image ?')">X</button>
                                @csrf
                                @method('delete')
                            </form>
                            <img src="{{ asset('cover/' . $post->cover) }}" class="img-responsive"
                                style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Images:</strong>
                    <div class="card shade c-grey m-4">
                        <h5 class="card-header">Post Images</h5>
                        <div class="card-body">
                            <div class="row">
                                @if (count($post->images) > 0)
                                    @foreach ($post->images as $img)
                                        <div class="m-4">
                                            <form action="/imageDelete/{{ $img->id }}" method="post">
                                                <button class="btn text-danger d-block"
                                                    onclick="return confirm('Are you sure detete this image ?')">X</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <img src="{{ asset('images/' . $img->image) }}" class="img-responsive"
                                                style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
@endsection
