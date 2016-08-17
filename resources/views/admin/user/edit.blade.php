@extends('layouts.app')

@section('content')
@include('admin.sidebar')
<div id="page-wrapper">
    <div class="contrainer-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-lg-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ trans('settings.edit_user') }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="page-header">
                            @include('common.errors')
                            {!! Form::open([
                                'method' => 'PUT',
                                'route' => ['admin.users.update', $user->id]
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('name', trans('settings.name'), [
                                        'class' => 'col-sm-3 control-label'
                                    ]) !!}
                                    {!! Form::text('name', $user->name, [
                                        'class' => 'form-control',
                                        'autofocus'
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', trans('settings.email'), [
                                        'class' => 'col-md-4 control-label'
                                    ]) !!}
                                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'required' => true ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('role', trans('settings.role'), [
                                        'class' => 'col-md-12 control-label'
                                    ]) !!}
                                    {!! Form::select('role', config('common.user_role'), $user->role, ['class' => 'form-control']) !!}
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
