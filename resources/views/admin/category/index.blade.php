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
                    <h3> {{ trans('category.categories') }} <small>&raquo; 
                        {{ trans('category.listing') }} </small>
                    </h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('categories.downloadExcel', 'xlsx') }}">
                        <button class="btn btn-success"><i class="fa fa-download"></i></button>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" 
                        class="btn btn-success">
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <div class="panel panel-primary filterable">
                        <div class="panel-heading">
                            {{ trans('category.table') }}
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs btn-filter">
                                    <span class="fa fa-filter"></span> {{ trans('category.filter') }} 
                                </button>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                {!! Form::open(['method' => 'POST', 'route' => 'categories.destroy']) !!}
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr class="filters">
                                                <th>
                                                    <input type="checkbox" id="checkAll">
                                                </th>
                                                <th>
                                                    <input type="text" class="form-control" 
                                                        placeholder="{{ trans('category.id') }}" disabled>
                                                </th>
                                                <th>
                                                    <input type="text" class="form-control" 
                                                        placeholder="{{ trans('category.parent') }}" disabled>
                                                </th>
                                                <th>
                                                    <input type="text" class="form-control" 
                                                        placeholder="{{ trans('category.name') }}" disabled>
                                                </th>
                                                <th> {{ trans('category.edit') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td><input type="checkbox" name="checkbox[]" value="{{ $category->id }}"></td>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->parent_id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                        'class' => 'btn btn-danger', 
                                        'type' => 'submit', 
                                        'onclick' => "return confirm('Are you sure delete?')",
                                    ]) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="paginate"> 
                        {{ $categories->render() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

