@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            @foreach ($categoriesParent as $categoryParent)
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cutlery"></i> {{ $categoryParent->name }}
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <ul class="dropdown-menu" id="menu-user">
                    @foreach ($categoriesChild as $categoryChild)
                        @if ($categoryChild->parent_id == $categoryParent->id)
                            <li class="sub-menu">
                                <a href="#">{{ $categoryChild->name }}</a>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="container">
        <section>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="{{ $product->image }}" class="image-product">
                                    <div class="caption">
                                        <h4>{{ $product->name }}</h4>
                                        <div class="clearfix">
                                            <div class="pull-left price"> 
                                                {{ config('common.currency') }} {{ $product->price }}
                                            </div>
                                            <a href="{{ route('products.show', $product->id) }}" 
                                                class="btn btn-success pull-right"> 
                                                {{ trans('product.view') }} 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
