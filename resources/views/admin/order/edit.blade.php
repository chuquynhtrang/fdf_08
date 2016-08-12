@extends('admin.index')

@section('content')
    @include('modals.login')
    @include('modals.register')
    @include('admin.sidebar')

    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h3> {{ trans('order.orders') }} <small>&raquo; {{ trans('order.edit') }} </small></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> {{ trans('order.edit') }} </h3>
                </div>
                <div class="panel-body">

                    @include ('common.errors')

                    {!! Form::model($order, [
                        'method' => 'PUT',
                        'route' => ['admin.orders.update', $order['id']],
                        'class' => 'form-horizontal',
                    ]) !!}
                        <div class="form-group">
                            {!! Form::label('status', trans('order.status'), [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::select('status',
                                config('common.order_status'),
                                $order['status'],
                                ['class' => 'form-control'])
                            !!}
                        </div>

                        <div class="form-group">
                            {!! Form::button('<i class="fa fa-edit"></i>&nbsp;' . trans('order.update'), [
                                'type' => 'submit',
                                'class' => 'btn btn-success btn-md',
                            ]) !!}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
