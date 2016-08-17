@extends('layouts.app')

@section('content')
@include('admin.sidebar')
<div id="page-wrapper">
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <h3> {{ trans('category.categories') }} <small>&raquo;
                    {{ trans('category.listing') }} </small>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('categories.downloadExcel', 'xlsx') }}">
                    <button class="btn btn-success"><i class="fa fa-download"></i></button>
                </a>
                <a href="{{ route('admin.users.create') }}"
                    class="btn btn-success">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.admin_manager') }}</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs button-create btn-filter">
                                <span class="fa fa-filter"></span>{{ trans('settings.filter') }}
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            {!! Form::open(['method' => 'POST', 'route' => 'users.destroy']) !!}
                                <table class="table table-striped table-bordered table-hover">
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
                                                <input type="text" class="form-control" placeholder="{{ trans('settings.email') }}" disabled>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control" placeholder="{{ trans('settings.role') }}" disabled>
                                            </th>

                                            <th>
                                                <input type="text" class="form-control" placeholder="{{ trans('settings.edit') }}" disabled>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td><input type="checkbox" name="checkbox[]" value="{{ $user->id }}"></td>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{ route('admin.users.edit', [ $user->id ]) }}" title="{{ trans('settings.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ Form::button("<i class=\"fa fa-trash-o\"></i> ", [
                                    'class' => 'btn btn-danger',
                                    'onclick' => "return confirm('" . trans('settings.confirm_delete') . "')",
                                    'type' => 'submit',
                                ]) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="pagination pull-right">
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
