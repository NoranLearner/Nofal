@extends('layouts.master')

@section('title')
    Users Management
@endsection

@section('css')
@endsection

@section('page_title')
    Edit User
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
    <a href="#" class="c-grey">edit</a>
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
            <a class="btn btn-primary d-inline-block" href="{{ route('users.index') }}"> Back </a>
        </div>


        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('scripts')
@endsection
