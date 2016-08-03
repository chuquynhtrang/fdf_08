@extends('admin.index')

@section('content')
    @include('modals.login')
    @include('modals.register')
    @include('admin.sidebar')

    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h3> {{ trans('category.categories') }} <small>&raquo; {{ trans('category.create') }} </small></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-7 col-md-offset-2">
            {!! Form::open([
                'method' => 'POST', 
                'route' => 'categories.importExcel', 
                'files' => true]) 
            !!}
                <div class="col-md-4">
                    {!! Form::file('fileCategory') !!}
                </div>
                    {!! Form::button(trans('category.import'), [
                        'type' => 'submit', 
                        'class' => 'btn btn-success btn-sm',
                    ]) !!}
            {!! Form::close() !!}
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> {{ trans('category.new') }} </h3>
                </div>
                <div class="panel-body">

                    @include ('common.errors')

                    {!! Form::open([
                        'method' => 'POST', 
                        'route' => 'admin.categories.store', 
                        'class' => 'form-horizontal',
                    ]) !!}
                        <div class="form-group"> 
                            {!! Form::label('name', trans('category.name'), [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text('name', null, [
                                'class' => 'form-control', 
                                'autofocus',
                            ]) !!}
                        </div>

                        <div class="form-group"> 
                            {!! Form::label('parent_id', trans('category.parent'), [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::select('parent_id', config('common.category_parent'), null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::button('<i class="fa fa-plus-circle"></i>&nbsp;' . trans('category.add'), [
                                'type' => 'submit', 
                                'class' => 'btn btn-success btn-sm',
                            ]) !!}
                        </div>
                    {!! Form::close() !!}      
                </div>
            </div>
        </div>
    </div>
@stop
