@extends('theme.master')
@section('title', "$blog->heading")
@section('content')

@include('admin.message')

@section('meta_tags')
@php
    $url =  URL::current();
@endphp

<meta name="title" content="{{ $blog['heading'] }}">
<meta name="description" content="{{ $blog['detail'] }} ">
<meta name="author" content="elsecolor">
<meta property="og:title" content="{{ $blog['title'] }} ">
<meta property="og:url" content="{{ $url }}">
<meta property="og:description" content="{{ $blog['detail'] }}">
<meta property="og:image" content="{{ asset('images/blog/'.$blog['image']) }}">
<meta itemprop="image" content="{{ asset('images/blog/'.$blog['image']) }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/blog/'.$blog['image']) }}">
<meta property="twitter:title" content="{{ $blog['heading'] }} ">
<meta property="twitter:description" content="{{ $blog['detail'] }}">
<meta name="twitter:site" content="{{ url()->full() }}" />

<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
    

@endsection

<!-- blog-dtl start-->
<section id="blog-dtl" class="blog-dtl-main-block">
    <div class="container">
        <div class="blog-link btm-30"><a href="{{ route('blog.all') }}" title="back to blog"><i class="fa fa-chevron-left"></i>{{ __('frontstaticword.BacktoBlog') }}</a></div>
        <div class="blog-dtl-block-heading text-center btm-20">{{ $blog->heading }}</div>
        <div class="blog-dtl-heading-dtl text-center">@if($blog->created_at == !NULL){{ date('jS F Y', strtotime($blog->created_at)) }}@endif By <a href="#" title="post of">{{ $blog->user->fname }}</a></div>
        <div class="blog-idea text-center btm-30"><a href="#" title="blog-idea">{{ $blog->text }}</a></div>
        <div class="blog-dtl-img text-center btm-30">
            <img src="{{ asset('images/blog/'.$blog->image) }}" class="img-fluid text-center" alt="blog"> 
        </div>
        <div class="blog-dtl-block">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="btm-20">{!! $blog->detail !!}</p>
                </div>
            </div>
        </div>
        
    </div>
</section>
<hr>
<!-- blog-dtl end-->
@endsection
