@extends('layouts.master')

@section('title')
    Role Management
@endsection

@section('css')
@endsection

@section('page_title')
    Roles
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
    <a href="#" class="c-grey">index</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="mb-3">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role </a>
                @endcan
            </div>

            @if ($message = Session::get('success'))
                <div class="alert col-12  alert-success alert-shade alert-dismissible fade show" role="alert">
                    <p class="fnt-code c-white">{{ $message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" width="400px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $role->name }}</td>
                            <td>

                                <div class="row">

                                    <div class="col">
                                        @can('role-list')
                                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                                        @endcan
                                    </div>

                                    <div class="col">
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                        @endcan
                                    </div>

                                    <div class="col">
                                        @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $roles->render() !!}

        </div>
    </div>
@endsection

@section('scripts')
@endsection
