<header id="header">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <img class ="navbar-brand" id="logo" src="{{ asset('images/logo1.png') }}"/>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>
                                {{ trans('settings.logout') }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
