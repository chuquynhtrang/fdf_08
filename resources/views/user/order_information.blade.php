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
                        {{ trans('settings.orders') }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="filters">
                                        <th>
                                            {{ trans('order.id') }}
                                        </th>
                                        <th>
                                            {{ trans('order.price') }}   
                                        </th>
                                        <th>
                                            {{ trans('order.shipping_address') }}
                                        </th>
                                        <th>
                                            {{ trans('order.status') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('orderDetails', [Auth::user()->id, $order->id]) }}">
                                                    {{ $order->id }}
                                                </a>
                                            </td>
                                            <td>{{ config('common.currency') }} {{ $order->price }}</td>
                                            <td>{{ $order->shipping_address }}</td>
                                            <td>
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
