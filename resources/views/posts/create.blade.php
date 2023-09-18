@extends('layouts.master')

@section('title')
    Post Management
@endsection

@section('css')
@endsection

@section('page_title')
    Create New Post
@endsection

@section('page_desc')
    Post Management
@endsection

@section('page_icon')
    <i class="fab far fa-comments"></i>
@endsection

@section('page_title1')
    <a href="{{ route('posts.index') }}">Posts</a>
@endsection

@section('page_title2')
    <a href="#" class="c-grey">create</a>
@endsection

@section('content')

    <div class="container-fluid">

        @if (count($errors) > 0)
            <div class="alert col-12  alert-danger alert-shade alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong>Something went wrong.<br><br>
                <ul class="fnt-code c-white">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="mb-3">
            <a class="btn btn-primary d-inline-block" href="{{ route('posts.index') }}"> Back </a>
        </div>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control mt-2 @error('title') is-invalid @enderror" placeholder="Title">
                        @error('title')
                            <div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Author:</strong>
                        <input type="text" name="author" class="form-control mt-2 @error('author') is-invalid @enderror" placeholder="Author">
                        @error('author')
                            <div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea name="body" cols="20" rows="4" class="form-control mt-2 @error('body') is-invalid @enderror" placeholder="Description"></textarea>
                        @error('body')
                            <div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cover Image:</strong>
                        <input type="file" class="form-control mt-2 @error('cover') is-invalid @enderror" name="cover" />
                        @error('cover')
                            <div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Images:</strong>
                        <input type="file" class="form-control mt-2 @error('images') is-invalid @enderror" name="images[]" multiple />
                        @error('images')
                            <div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>

        </form>

    </div>

@endsection

@section('scripts')
@endsection
