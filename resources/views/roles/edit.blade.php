@extends('layouts.master')

@section('title')
    Role Management
@endsection

@section('css')
@endsection

@section('page_title')
    Edit Role
@endsection

@section('page_desc')
    Role Management
@endsection

@section('page_icon')
    <i class="fa fa-solid fa-user-shield"></i>
@endsection

@section('page_title1')
    <a href="{{ route('roles.index') }}">Roles</a>
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
            <a class="btn btn-primary d-inline-block" href="{{ route('roles.index') }}"> Back </a>
        </div>

        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permission:</strong>
                    <br />
                    @foreach ($permission as $value)
                        <label class="w-25 p-3">
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            {{ $value->name }}
                        </label>
                    @endforeach
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
