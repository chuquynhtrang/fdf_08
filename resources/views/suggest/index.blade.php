@extends('layouts.app')

@section('content')
@include('admin.sidebar')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.suggest_product') }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>{{ trans('settings.stt') }}</th>
                                        <th>{{ trans('settings.user_id') }}</th>
                                        <th>{{ trans('settings.category_id') }}</th>
                                        <th>{{ trans('settings.name') }}</th>
                                        <th>{{ trans('settings.price') }}</th>
                                        <th>{{ trans('settings.description') }}</th>
                                        <th>{{ trans('settings.add_cart') }}</th>
                                        <th>{{ trans('settings.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suggestProduct as $index => $suggest)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $suggest->user_id }}</td>
                                            <td>{{ $suggest->category_id }}</td>
                                            <td>{{ $suggest->name }}</td>
                                            <td>{{ $suggest->price }}</td>
                                            <td>{{ $suggest->description }}</td>
                                            <td>
                                                <a href="{{ route('admin.suggests.edit', [$suggest->id]) }}" class="btn btn-success">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['admin.suggests.destroy', $suggest->id], 'method' => 'DELETE']) !!}
                                                    {!! Form::button("<i class=\"fa fa-trash-o\"></i> ", [
                                                        'class' => 'btn btn-info',
                                                        'type' => 'submit',
                                                    ]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination pull-right">
                        {!! $suggestProduct->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
