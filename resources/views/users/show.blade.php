@extends('layouts.master')

@section('title')
    Users Management
@endsection

@section('css')
@endsection

@section('page_title')
    Show User
@endsection

@section('page_desc')
    Users Management
@endsection

@section('page_icon')
    <i class="fa fa-solid fa-users"></i>
@endsection

@section('page_title1')
    <a href="{{ route('users.index') }}">Users</a>
@endsection

@section('page_title2')
    <a href="#" class="c-grey">show</a>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="mb-3">
            <a class="btn btn-primary d-inline-block" href="{{ route('users.index') }}"> Back </a>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-pill f-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
