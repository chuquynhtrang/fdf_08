@extends('layouts.app')

@section('content')
    @include('modals.login')
    @include('modals.register')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-5">
                        <img src="{{ $product->image }}" class="product_details">
                        <div class="fb-like" data-href="{{ route('products.show', ['id' => $product['id']]) }} data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <hr>
                        <h4> {{ trans('product.price') }} </h4>
                        <div class="price">
                            {{ config('common.currency') }} {{ $product-> price }}
                        </div>
                        <hr>
                        <h4> {{ trans('product.quantity') }} {{ $product->quantity }} </h4>
                        <hr>
                        <a href="{{ route('products.addToCart', [$product->id]) }}" class="btn btn-success btn-lg">
                            {{ trans('product.add_to_cart') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
         <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-12">
                        @if (Auth::check())
                            <a id="comment" class="btn btn-danger comment">
                                {{ trans('settings.comment') }}
                            </a>
                            <div class="panel-body" id="commentProduct">
                                <div class="box">
                                    {!! Form::open([
                                        'method' => 'POST',
                                        'route' => ['comment', $product->id],
                                    ]) !!}
                                        <div class="form-group">
                                            {!! Form::textarea('content', null, [
                                                'class' => 'form-control',
                                                'autofocus',
                                                'rows' => 3
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::button('Post', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success',
                                            ]) }}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="comments-block">
                                <div class="comments comments-list">
                                    @foreach($comments as $comment)
                                        <div class="commentId">
                                            <div class="comment_avatar">
                                                <img src="{{ $comment->user->avatar }}" class="user-comment">
                                            </div>
                                            <div class="comment_content">
                                                <div class="comment_text">
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                                <div class="comment-info">
                                                    <span class="comment-from">
                                                        {{ trans('settings.to') }}
                                                        <span class="comment-author">
                                                            {{ $comment->user->name }}
                                                        </span>
                                                        <span class="comment-time">
                                                            {{ trans('settings.date') }}{{ $comment->created_at }}
                                                        </span>
                                                        <span class="comment-rating">
                                                            {{ trans('settings.rating') }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <h4>{{ trans('settings.comment_use_facebook') }}</h4>
                            </div>
                            <div class="fb-comments" data-href="{{ route('products.show', ['id' => $product['id']]) }}" data-width="1100">
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                {{ trans('settings.required_login') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
@endsection
