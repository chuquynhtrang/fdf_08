@extends('layouts.app')

@section('content')
@include('admin.sidebar')
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ trans('settings.orders') }}
                        </div>
                        <div class="panel-body">
                            <div class="order_div"></div>
                            {!! Lava::render('LineChart', 'Orders', 'order_div', ['width' => 400, 'height' => 300]) !!}
                        </div>
                    </div>
                </div>

               <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ trans('settings.price') }}
                        </div>
                        <div class="panel-body">
                            <div class="price_div"></div>   
                            {!! Lava::render('ColumnChart', 'Prices', 'price_div', ['width' => 400, 'height' => 300]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div id="product_div"></div>   
                    {!! Lava::render('PieChart', 'Products', 'product_div') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
