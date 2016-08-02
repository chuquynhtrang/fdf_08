@extends('layouts.app')

@section('content')
@include('admin.sidebar')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.admin_manager') }}</h3>
                        <div class="pull-right">
                            <a href="{{ route('admin.products.create') }}"
                                class="btn btn-default btn-xs">{{ trans('settings.create') }}
                            </a>
                            <button class="btn btn-default btn-xs btn-filter">
                                <span class="fa fa-filter"></span>{{ trans('settings.filter') }}
                            </button>
                        </div>
                    </div>
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="filters">
                                <th>
                                    <input type="checkbox" id="checkall"/>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.stt') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.name') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.description') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.price') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.status') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.quantity') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.category_id') }}" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.edit') }}" disabled>
                                </th>

                                <th>
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.delete') }}" disabled>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkable"/>
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->status }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>
                                        <a class="btn btn-success" href="" title="{{ trans('settings.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open() !!}
                                            {{ Form::button("<i class=\"fa fa-trash-o\"></i> ", [
                                                'class' => 'btn btn-danger',
                                                'onclick' => "return confirm('" . trans('settings.confirm_delete') . "')",
                                                'type' => 'submit',
                                            ]) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination pull-right">
                        {!! $products->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
