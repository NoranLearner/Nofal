@extends('layouts.master')

@section('title')
    Users Management
@endsection

@section('css')
@endsection

@section('page_title')
    Users
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
    <a href="#" class="c-grey">index</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="mb-3">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>
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
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col" width="400px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <div class="c-grey text-center col">
                                            <label class="badge badge-pill f-success">{{ $v }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                            <td>

                                <div class="row">

                                    <div class="col">
                                        @can('user-list')
                                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                        @endcan
                                    </div>

                                    <div class="col">
                                        @can('user-edit')
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        @endcan
                                    </div>

                                    <div class="col">
                                        @can('user-delete')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['users.destroy', $user->id],
                                                'style' => 'display:inline-block',
                                            ]) !!}
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

            {!! $data->render() !!}

        </div>
    </div>
@endsection

@section('scripts')
@endsection
