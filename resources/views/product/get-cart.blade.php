@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th> {{ trans('settings.name') }} </th>
                                    <th> {{ trans('settings.price') }} </th>
                                    <th> {{ trans('settings.quantity') }} </th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                        {!! Form::open([
                                            'method' => 'PUT',
                                            'route' => ['products.updateCart', $product->rowId],
                                        ]) !!}
                                            <tr>
                                                <td class="data-image">
                                                    <a href="{{ route('products.show', $product->id) }}"><img src="{{ $product->options->image }}" class="image-item"></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                                </td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    {!! Form::text('quantity', $product->qty, [
                                                        'class' => 'input-quantity',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        {{ trans('settings.update') }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('deleteItem', $product->rowId) }}" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        {!! Form::close() !!}
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            {{ trans('settings.no_item') }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="6">
                                        <a href="{{ route('home') }}" class="btn btn-success btn-md pull-left">
                                            {{ trans('settings.continue') }}
                                        </a>
                                        <div class="pull-right">
                                            <a href="{{ route('deleteAllCart') }}" class="btn btn-danger btn-md">
                                                {{ trans('settings.deleteAllCart') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
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
                            <span class="label-total"> {{ trans('settings.total') }} </span>
                            <span class="value-total">
                                {{ $totalIncludeTax }}
                            </span>
                        </div>
                        @if (Auth::check())
                            <a href="{{ route('checkout') }}"
                                class="btn btn-success btn-lg pull-right">
                                {{ trans('settings.order') }}
                            </a>
                        @else
                            <div class="alert alert-danger" role="alert">
                                {{ trans('settings.you_must_login_to_order') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
