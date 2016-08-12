@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('settings.paid_information') }}
                </div>
                <div class="panel-body check_success">
                    <h1><i class="fa fa-check"></i></h1>
                    <h3>{{ trans('settings.order_successful') }}</h3>
                    <br>
                    <p>{{ trans('settings.check_mail') }}</p>
                    <hr>
                    <a href="{{ route('orderDetails', [Auth::user()->id, $order]) }}" class="btn btn-primary" style="margin-left:170px;">{{ trans('settings.view_detail_order') }}</a>
                    <a href="{{ route('home') }}" class="btn btn-default">
                        {{ trans('settings.come_back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
