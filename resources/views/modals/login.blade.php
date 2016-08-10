<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('settings.login') }}</h4>
                <a class="circle facebook" href=" {{ url('login/facebook')}} ">
                    <i class="fa fa-facebook-square fa-2x"></i>
                </a>
                <a class="circle twitter" href=" {{ url('login/twitter')}}">
                    <i class="fa fa-twitter-square fa-2x"></i>
                </a>
                <a class="circle google" href=" {{ url('login/google') }} ">
                    <i class="fa fa-google-plus-official fa-2x"></i>
                </a>
            </div>
            <div class="modal-body">
                <div class="box">
                    @include('common.errors')
                    {!! Form::open(['route' => 'login', 'name' => 'formLogin', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="alert alert-danger" id="login-message" role="alert"></div>
                            {!! Form::label('email', trans('settings.email'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', trans('settings.password'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} {{ trans('settings.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('settings.login'), ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('password.reset') }}" class="forgot-password">
                                    {{ trans('settings.forgot_your_password') }}
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer clearfix">
                {!! Form::button(trans('settings.close'), [
                    'class' => 'close',
                    'data-dismiss' => 'modal'
                ]) !!}
            </div>
        </div>
    </div>
</div>
