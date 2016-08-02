@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')

    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <img src="{{ $product->image }}" class="product_details">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <hr>
                <h4> {{ trans('product.price') }} </h4>
                <div id="price">
                    {{ config('common.currency') }} {{ $product-> price }}
                </div>
                <hr>
                <h4> {{ trans('product.quantity') }} {{ $product->quantity }} </h4>
                <a href="{{ route('products.addToCart', [$product->id]) }}" class="btn btn-success btn-lg"> 
                    {{ trans('product.add_to_cart') }} 
                </a>
            </div>
        </div>
    </div>
@endsection
