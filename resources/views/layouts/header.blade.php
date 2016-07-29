<header id="header">
    <nav id="menu" class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header logo-header">
                <img class ="navbar-brand" id="logo" src="{{ asset('images/logo1.png') }}"/>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul>
                    <li>
                        <div clas="row">
                            <div class="col-md-6">
                                <div class="text-search">
                                    <input type="text" class="form-control" placeholder="{{ trans('settings.search') }}"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info button-search" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right login-register">
                    @if (Auth::guest())
                        <li>
                            <a id="login" data-toggle="modal">
                                {{ trans('settings.login') }}
                            </a>
                        </li>
                        <li>
                            <a id="register" data-toggle="modal">
                                {{ trans('settings.register') }}
                            </a>
                        </li>
                    @else
                        <li class="dropdown" id="avatar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {!! Html::image(Auth::user()->avatar, null , ['id' => 'profile_avatar']) !!}
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                               <li>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.profile', Auth::user()->id) }}"<i class="fa fa-user"></i> {{ trans('settings.profile') }} </a>
                                    @else
                                        <a href="{{ url('/profile') }}"><i class="fa fa-user"></i> {{ trans('settings.profile') }} </a>
                                    @endif
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('settings.logout') }} </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
