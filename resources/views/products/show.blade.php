@extends('layouts.master')

@section('title')
Product Management
@endsection

@section('css')
@endsection

@section('page_title')
Show Product
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
<a href="#" class="c-grey">show</a>
@endsection

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <a class="btn btn-primary d-inline-block" href="{{ route('products.index') }}"> Back </a>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->detail }}
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
@endsection
