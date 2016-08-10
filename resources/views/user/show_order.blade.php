@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="tabs-profile">
            <ul class="nav nav-tabs">
                <li>
                    <a href="{{ route('userProfile', Auth::user()->id) }}"> 
                        {{ trans('user.edit_profile') }} 
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('orderInformation', Auth::user()->id) }}"> 
                        {{ trans('order.information') }} 
                    </a>
                </li>
            </ul>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        {{ trans('order.details') }}
                    </div>
                    <div class="panel-body">
                        <div class="order-items">
                            <table class="order-summary">
                                <tr>
                                    <th class="label-order">
                                        {{ trans('order.id') }}
                                    </th>
                                    <td class="value-order">
                                        {{ $order->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="label-order">
                                        {{ trans('order.date') }}
                                    </th>
                                    <td class="value-order">
                                        {{ $order->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="label-order">
                                        {{ trans('order.status') }}
                                    </th>
                                    <td class="value-order">
                                        @if ($order->isUnpaid())
                                            <button class="btn btn-default btn-sm">
                                                {{ trans('order.unpaid') }}
                                            </button>
                                        @elseif ($order->isPaid())
                                            <button class="btn btn-success btn-sm">
                                                {{ trans('order.paid') }}
                                            </button>
                                        @else 
                                            <button class="btn btn-danger btn-sm">
                                                {{ trans('order.cancel') }}
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="order-items">
                            <table class="order-summary">
                                <tr>
                                    <th class="label-order">
                                        {{ trans('user.name') }}
                                    </th>
                                    <td class="value-order">
                                        {{ Auth::user()->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="label-order">
                                        {{ trans('user.shipping_address') }}
                                    </th>
                                    <td class="value-order">
                                        {{ $order->shipping_address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="label-order">
                                        {{ trans('user.phone') }}
                                    </th>
                                    <td class="value-order">
                                        {{ Auth::user()->phone }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="order-items">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> {{ trans('order.id') }} </th>
                                        <th> {{ trans('order.product') }} </th>
                                        <th> {{ trans('order.quantity') }} </th>
                                        <th> {{ trans('order.price') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->lineItems as $lineItem)
                                        <tr>
                                            <td>{{ $lineItem->id }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $lineItem->product_id) }}">
                                                    {{ $lineItem->product_id }}
                                                </a>
                                            </td>
                                            <td>{{ $lineItem->quantity_product }}</td>
                                            <td>{{ config('common.currency') }} {{ $lineItem->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
