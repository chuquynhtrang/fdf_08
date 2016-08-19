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
                                <a href="{{ route('sublink', $categoryChild->link) }}">{{ $categoryChild->name }}</a>
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
                    <div class="block-title">
                        <div class="product-sorting">
                            <div class="filter-title">
                                <i class="fa fa-bars filter-title"></i>
                                {{ trans('settings.filter_by') }}
                            </div>
                            <div class="filter-body">
                                <a href="{{ route('home') }}" class="btn btn-default sorting">
                                    {{ trans('settings.default') }}
                                </a>
                                <a href="{{ route('bestSelling') }}" class="btn btn-default sorting">
                                    {{ trans('settings.best_selling') }}&nbsp;
                                    <i class="fa fa-long-arrow-down"></i>
                                </a>
                                <a href="{{ route('bestPrice') }}" class="btn btn-default sorting">
                                    {{ trans('settings.best_price') }}&nbsp;
                                    <i class="fa fa-long-arrow-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img data-original="{{ $product->image }}" class="image-product">
                                    </a>
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
                    <div class="paginate">
                        {{ $products->render() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
