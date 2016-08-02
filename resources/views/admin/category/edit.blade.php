@extends('admin.index')

@section('content')
    @include('modals.login')
    @include('modals.register')
    @include('admin.sidebar')

    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h3> {{ trans('category.categories') }} <small>&raquo; {{ trans('category.edit') }} </small></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> {{ trans('category.edit') }} </h3>
                </div>
                <div class="panel-body">

                    @include ('common.errors')
                    
                    {!! Form::model($category, [
                        'method' => 'PUT', 
                        'route' => ['admin.categories.update', $category->id], 
                        'class' => 'form-horizontal',
                    ]) !!}
                        <div class="form-group"> 
                            {!! Form::label('name', trans('category.name'), [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text('name', $category['name'], [
                                'class' => 'form-control', 
                                'autofocus',
                            ]) !!}
                        </div>

                        <div class="form-group"> 
                            {!! Form::label('parent_id', trans('category.parent'), [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::select('parent_id', 
                                config('common.category_parent'), 
                                $category['parent_id'], 
                                ['class' => 'form-control']), 
                            !!}
                        </div>

                        <div class="form-group">
                            {!! Form::button('<i class="fa fa-edit"></i>&nbsp;' . trans('category.update'), [
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
