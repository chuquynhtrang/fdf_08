@extends('layouts.app')

@section('content')
    @if (Auth::user())
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ trans('settings.shipping_address') }}
                                </div>
                                <div class="panel-body">
                                    <p><strong>{{ Auth::user()->name }}</strong></p>
                                    <p>{{ Auth::user()->address }}</p>
                                    <p>{{ Auth::user()->phone }}</p>
                                    <a href="{{ route('order') }}" 
                                        class="btn btn-success btn-md" 
                                        onclick="return confirm('Are you sure order?')">
                                        {{ trans('settings.delivery') }}
                                    </a>
                                    <button id="edit" type="button" class="btn btn-default btn-md">
                                        {{ trans('settings.edit_address') }}
                                    </button>
                                    <button type="button" class="btn btn-default btn-md">
                                        {{ trans('settings.cancel') }}
                                    </button>
                                </div>
                            </div>
                            <div class="panel panel-default" id="information">
                                <div class="panel-body">
                                    {!! Form::open([
                                        'method' => 'PUT', 
                                        'route' => 'updateAddress',
                                    ]) !!}
                                        <div class="form-group">
                                            {!! Form::label('address', trans('settings.address'), [
                                                'class' => 'control-label',
                                            ]) !!}
                                            {!! Form::text('address', Auth::user()->address, [
                                                'class' => 'form-control',
                                                'autofocus',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ trans('settings.update') }}
                                            </button>
                                            <button class="btn btn-default">
                                                {{ trans('settings.cancel') }}
                                            </button>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ trans('settings.order_information') }}
                                </div>
                                <div class="panel-body">
                                    <div class="order-items">
                                        @foreach ($products as $product)
                                            <div class="order-item">
                                                <div class="name">
                                                    {{ $product-> name }} X {{ $product->qty }}
                                                </div>
                                                <div class="product-price">
                                                    {{ config('common.currency') }} {{ $product->price }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <ul class="order-summary">
                                        <li>
                                            <span class="label-summary">
                                                {{ trans('settings.quantity') }}
                                            </span>
                                            <span class="value-summary">
                                                {{ $totalCartItems }}
                                            </span>
                                        </li>
                                        <li>
                                            <span class="label-summary">
                                                {{ trans('settings.totalPrice') }}
                                            </span>
                                            <span class="value-summary">
                                                {{ $totalPrice }}
                                            </span>
                                        </li>
                                        <li>
                                            <span class="label-summary">
                                                {{ trans('settings.tax') }}
                                            </span>
                                            <span class="value-summary">
                                                {{ $tax }}
                                            </span>
                                        </li>
                                    </ul>
                                    <hr>
                                    <div class="total">
                                        <span class="label-total">{{ trans('settings.total') }}</span>
                                        <span class="value-total">
                                            {{ $totalIncludeTax }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
