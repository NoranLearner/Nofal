@extends('layouts.master')

@section('title')
    Product Management
@endsection

@section('css')
@endsection

@section('page_title')
    Products
@endsection

@section('page_desc')
    Product Management
@endsection

@section('page_icon')
    <i class="fa fa-shopping-basket"></i>
@endsection

@section('page_title1')
    <a href="{{ route('products.index') }}">Products</a>
@endsection

@section('page_title2')
    <a href="#" class="c-grey">index</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="mb-3">
                @can('product-create')
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product </a>
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

            <table class="table table-bordered table-striped"">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Details</th>
                        <th scope="col" width="400px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->detail }}</td>
                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                                    <div class="row">

                                        <div class="col">
                                            @can('product-list')
                                                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                            @endcan
                                        </div>

                                        <div class="col">
                                            @can('product-edit')
                                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                            @endcan
                                        </div>

                                        <div class="col">
                                            @csrf
                                            @method('DELETE')
                                            @can('product-delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
