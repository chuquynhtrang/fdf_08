<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li>
            <a href="#">
                <i class="fa fa-bar-chart-o"></i> {{ trans('settings.charts') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}">
                <i class="fa fa-dashboard"></i> {{ trans('settings.categories') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}">
                <i class="fa fa-cutlery"></i> {{ trans('settings.products') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}">
                <i class="fa fa-file-text"></i> {{ trans('settings.orders') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-users"></i> {{ trans('settings.users') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.suggests.index') }}">
                <i class="fa fa-bell"></i> {{ trans('settings.suggests') }}
                <span class="badge">
                    @if (isset($countSuggest))
                        {{ $countSuggest }}
                    @else
                        {{ config('common.no_item') }}
                    @endif
                </span>
            </a>
        </li>
    </ul>
</div>
