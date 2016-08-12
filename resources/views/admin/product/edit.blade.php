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
                                {{ trans('settings.edit_product') }}
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="page-header">
                                @include('common.errors')
                                {!! Form::open([
                                    'method' => 'PUT',
                                    'route' => ['admin.products.update', $product->id]
                                ]) !!}
                                    <div class="form-group">
                                        {!! Form::label('name', trans('settings.name'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('name', $product->name, [
                                            'class' => 'form-control',
                                            'id' => 'name',
                                            'autofocus',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('description', trans('settings.description'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('description', $product->description, [
                                            'class' => 'form-control',
                                            'id' => 'description',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', trans('settings.price'), [
                                            'class' => 'col-sm-3 control-label'
                                        ]) !!}
                                        {!! Form::text('price', $product->price, [
                                            'class' => 'form-control',
                                            'id' => 'price',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('status', trans('settings.status'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::select('status', config('common.status'), $product->status, ['class' =>'form-control']) !!}
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
                                        {!! Form::text('quantity', $product->quantity, [
                                            'class' => 'form-control',
                                            'id' => 'quantity',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rating', trans('settings.rating'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::text('rating', $product->rating, [
                                            'class' => 'form-control',
                                            'id' => 'rating',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('category_id', trans('settings.category_id'), [
                                            'class' => 'col-md-12 control-label'
                                        ]) !!}
                                        {!! Form::select('category_id', $listCategories, $product->category_id, [
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
