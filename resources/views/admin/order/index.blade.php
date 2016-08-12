@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')
    @include('admin.sidebar')

     <div class="container">
        <section>
            <div class="row page-title-row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h3> {{ trans('order.orders') }} <small>&raquo; 
                        {{ trans('order.listing') }} </small>
                    </h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('orders.downloadExcel', 'xlsx') }}">
                        <button class="btn btn-success"><i class="fa fa-download"></i></button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <div class="panel panel-primary filterable">
                        <div class="panel-heading">
                            {{ trans('order.table') }}
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs btn-filter">
                                    <span class="fa fa-filter"></span> {{ trans('order.filter') }} 
                                </button>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="filters">
                                            <th>
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" 
                                                    placeholder="{{ trans('order.id') }}" disabled>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" 
                                                    placeholder="{{ trans('order.user') }}" disabled>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" 
                                                    placeholder="{{ trans('order.price') }}" disabled>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" 
                                                    placeholder="{{ trans('order.status') }}" disabled>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" 
                                                    placeholder="{{ trans('order.shipping_address') }}" disabled>
                                            </th>
                                            <th> {{ trans('order.edit') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><input type="checkbox" name="checkbox[]" value="{{ $order->id }}"></td>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->price }}</td>
                                                <td>{{ $order->shipping_address }}</td>
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
                                                <td>
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}" 
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="paginate"> 
                        {{ $orders->render() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

