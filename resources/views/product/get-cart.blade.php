@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <table class="table table-striped table-bordered table-hover">
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
                                            <img src="{{ $product->options->image }}" class="image-item">
                                        </td>
                                        <td>{{ $product->name }}</td>
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
            <div class="col-lg-3">
                <table class="table table-bordered" id="table-price">
                    <tr>
                        <td>
                            <strong> {{ trans('settings.totalPrice') }} </strong>
                            <span class="price">{{ $totalPrice }}</span>
                            <hr>
                            <strong> {{ trans('settings.tax') }}</strong>
                            <span class="price">{{ $tax }}</span>
                            <hr>
                            <strong> {{ trans('settings.total') }} </strong>
                            <span class="price">{{ $totalIncludeTax }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-success btn-lg pull-right"> 
                                {{ trans('settings.order') }} 
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
