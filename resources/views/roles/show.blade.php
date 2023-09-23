@extends('layouts.master')

@section('title')
    Role Management
@endsection

@section('css')
@endsection

@section('page_title')
    Show Role
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
    <a href="#" class="c-grey">show</a>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="mb-3">
            <a class="btn btn-primary d-inline-block" href="{{ route('roles.index') }}"> Back </a>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if (!empty($rolePermissions))
                        @foreach ($rolePermissions as $v)
                            <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
@endsection
