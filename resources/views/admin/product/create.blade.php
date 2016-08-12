@extends('layouts.app')

@section('content')
@include('admin.sidebar')
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-7 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                {{ trans('settings.create_product') }}
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="page-header">
                                @include('common.errors')
                                {!! Form::open(['route' => 'admin.products.store', 'method' => 'POST', 'files' => true]) !!}
                                    <div class="form-group">
                                        {!! Form::label('name', trans('settings.name'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('name', null, [
                                            'class' => 'form-control',
                                            'id' => 'name',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('description', trans('settings.description'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('description', null, [
                                            'class' => 'form-control',
                                            'id' => 'description',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', trans('settings.price'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('price', null, [
                                            'class' => 'form-control',
                                            'id' => 'price',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('status', trans('settings.status'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::select('status', config('common.status'), null, ['class' =>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('image', trans('settings.image'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::file('image', ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('quantity', trans('settings.quantity'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::text('quantity', null, [
                                            'class' => 'form-control',
                                            'id' => 'quantity',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rating', trans('settings.rating'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::text('rating', null, [
                                            'class' => 'form-control',
                                            'id' => 'rating',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('category_id', trans('settings.category_id'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::select('category_id', $listCategories, null, [
                                            'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
