@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            @foreach ($categoriesParent as $categoryParent)
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cutlery"></i> {{ $categoryParent->name }}
                        <i class="fa fa-angle-right"></i></a>
                    <ul class="dropdown-menu" id="menu-user">
                    @foreach ($categoriesChild as $categoryChild)
                        @if ($categoryChild->parent_id == $categoryParent->id)
                            <li class="sub-menu"><a href="#">{{ $categoryChild->name }}</a></li>
                        @endif
                    @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
