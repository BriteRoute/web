@extends('theme.master')
@section('title', 'Blog')
@section('content')

@include('admin.message')
<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading">{{ __('frontstaticword.Blog') }}</h1>
    </div>
</section> 
<!-- about-home end --> 
<!-- blog start -->
@if(isset($blogs))
<section id="blog" class="blog-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="blog-slider" class="blog-slider owl-carousel btm-40">
                    @foreach($blogs->take(3) as $item)
                    @if($item->status == 1 && $item->approved == 1)
                        <div class="item blog-slider-block">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="blog-slider-img">
                                        @if($item->slug != NULL)
                                            <a href="{{ route('blog.detail', ['id' => $item->id, 'slug' => $item->slug ]) }}">
                                        @else
                                             <a href="{{ route('blog.detail', ['id' => $item->id, 'slug' => str_slug(str_replace('-','&',$item->heading)) ]) }}">
                                        @endif
                                            <img src="{{ asset('images/blog/'.$item->image) }}" class="img-fluid" alt="blog">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="blog-slider-dtl">
                                        <div class="slider-date btm-10">
                                            @if($item->created_at == !NULL)
                                            {{ date('jS F Y', strtotime($item->created_at)) }}
                                         
                                            @endif
                                        </div>
                                        <h3 class="blog-slider-heading">
                                            @if($item->slug != NULL)
                                                <a href="{{ route('blog.detail', ['id' => $item->id, 'slug' => $item->slug ]) }}">
                                            @else
                                                 <a href="{{ route('blog.detail', ['id' => $item->id, 'slug' => str_slug(str_replace('-','&',$item->heading)) ]) }}">
                                            @endif
                                            </a>
                                        </h3>
                                        <p class="btm-10">{{substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($item->detail))), 0, 400)}}</p>
                                        <div class="business-home-slider-btn btm-20">
                                            @if($item->slug != NULL)

                                            <button onclick="window.location.href='{{ route('blog.detail', ['id' => $item->id, 'slug' => $item->slug ]) }}';"  type="button" class="btn btn-link">{{ $item->text }}</button>

                                            @else

                                            <button onclick="window.location.href='{{ route('blog.detail', ['id' => $item->id, 'slug' => str_slug(str_replace('-','&',$item->heading)) ]) }}';"  type="button" class="btn btn-link">{{ $item->text }}</button>

                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    @endif
                    @endforeach
                </div>
                @foreach($blogs as $blog)
                @if($blog->status == 1 && $blog->approved == 1)
                    <div class="blog-block btm-40">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="slider-date btm-10">
                                    @if($blog->created_at == !NULL)
                                    {{ date('jS F Y', strtotime($blog->created_at)) }}
                                    @endif
                                </div>
                                <div class="blog-block-img">
                                   @if($blog->slug != NULL)
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                    @else
                                         <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                    @endif

                                    <img src="{{ asset('images/blog/'.$blog->image) }}" class="img-fluid"  alt="blog">

                                   </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="block-block-dtl">
                                    <h3 class="blog-slider-heading">
                                        @if($blog->slug != NULL)
                                            <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                        @else
                                             <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                        @endif
                                        </a>
                                    </h3>
                                    <p>{{substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($blog->detail))), 0, 400)}}</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <hr>
                @endif
                @endforeach
                <div class="pull-right">{{ $blogs->links() }}</div>
            </div>
            
        </div>
    </div>
    <hr>
</section>
@endif
<!-- blog end -->

@endsection
