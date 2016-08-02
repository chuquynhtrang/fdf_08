<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('admin.categories.index') }}">
                <i class="fa fa-dashboard"></i> {{ trans('settings.categories') }} 
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-cutlery"></i> {{ trans('settings.products') }} 
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-file-text"></i> {{ trans('settings.orders') }} 
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-users"></i> {{ trans('settings.users') }} 
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-bell"></i> {{ trans('settings.suggests') }} 
            </a>
        </li>
    </ul>
</div>
