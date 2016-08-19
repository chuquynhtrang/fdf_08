<header id="header">
    <nav id="menu" class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header logo-header">
                <a href="{{ route((Auth::check() && !Auth::user()->isAdmin()) ? 'home' : 'admin') }}">
                    <img class ="navbar-brand" id="logo" src="{{ asset('images/logo1.png') }}"/>
                </a>
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
                    @if (Auth::check() && !Auth::user()->isAdmin())
                        <li id="header-suggest">
                            <a href="{{ route('users.create') }}">
                                <i class="fa fa-comment">&nbsp;{{ trans('settings.suggests') }}</i>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guest() || Auth::user()->isUser())
                        <li>
                            <a href="{{ route('products.getCart') }}" data-toggle="dropdown" id="cart">
                                <i class="fa fa-shopping-cart"></i> {{ trans('settings.shopping_cart') }}
                                <span class="badge">
                                    @if (isset($totalCartItems))
                                        {{ $totalCartItems }}
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-cart" role="menu">
                                <div class="minicart-wrapper">
                                    @foreach ($productCarts as $productCart)
                                        <div class="minicart-item">
                                            <div class="minicart-item-info">
                                                <img src="{{ $productCart->options->image }}" alt="">
                                                <div class="minicart-item-name">
                                                    <a href="{{ route('products.show', $productCart->id) }}"> 
                                                        {{ $productCart->name }}
                                                    </a>
                                                </div>
                                                <span class="minicart-item-price">
                                                    {{ config('common.currency') }} {{ $productCart->price }} 
                                                    X {{ $productCart->qty }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="minicart-summary">
                                    {{ trans('settings.total') }} 
                                    <strong>
                                        <span class="price-value">
                                            {{ config('common.currency') }} {{ $totalPrice }}
                                        </span>
                                    </strong>
                                </div>
                                <div class="minicart-actions">
                                    <a href="{{ route('products.getCart') }}" class="btn btn-default btn-md">
                                        {{ trans('settings.view_cart') }}
                                    </a>
                                    <a href="{{ route('checkout') }}" class="btn btn-success btn-md btn-checkout">
                                        {{ trans('settings.checkout') }}
                                    </a>
                                </div>
                            </div>
                        </li>
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

                            <li class="dropdown" id="language">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ trans('settings.language') }}
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('lang', 'en') }}">{{ trans('settings.english') }}</a>
                                     </li>
                                    <li>
                                        <a href="{{ route('lang', 'vi') }}">{{ trans('settings.vietnamese') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @else 
                            <li class="dropdown" id="avatar">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {!! Html::image(Auth::user()->avatar, null , ['id' => 'profile_avatar']) !!}
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                   <li>
                                        <a href="{{ route('userProfile', Auth::user()->id) }}">
                                            <i class="fa fa-user"></i> {{ trans('settings.profile') }} 
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i class="fa fa-btn fa-sign-out"></i> {{ trans('settings.logout') }} 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @else
                        <li class="dropdown" id="avatar">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {!! Html::image(Auth::user()->avatar, null , ['id' => 'profile_avatar']) !!}
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                   <li>
                                        <a href="{{ route('admin.profile', Auth::user()->id) }}">
                                            <i class="fa fa-user"></i> {{ trans('settings.profile') }} 
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i class="fa fa-btn fa-sign-out"></i> {{ trans('settings.logout') }} 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
