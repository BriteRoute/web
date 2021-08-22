@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')
@include('sweetalert::alert')

@section('meta_tags')

<meta name="title" content="{{ $gsetting['title'] }}">
<meta name="description" content="{{ $gsetting['meta_data_desc'] }} ">
<meta property="og:title" content="{{ $gsetting['title'] }} ">
<meta property="og:url" content="{{ url()->full() }}">
<meta property="og:description" content="{{ $gsetting['meta_data_desc'] }}">
<meta property="og:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta itemprop="image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="twitter:title" content="{{ $gsetting['title'] }} ">
<meta property="twitter:description" content="{{ $gsetting['meta_data_desc'] }}">
<meta name="twitter:site" content="{{ url()->full() }}" />

<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
    
@endsection

<!-- categories-tab start-->
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
           
            @foreach($category as $cat)
                @if($cat->status == 1)
                <div class="item categories-tab-dtl">
                    <a href="{{ route('category.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))]) }}" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
                </div>
                @endif
            @endforeach
        </div>
    </div>

</section>

<!-- categories-tab end-->

@if(isset($sliders))
<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="lazy item home-slider-img">
        @foreach($sliders as $slider)

        @if($slider->status == 1)
        <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/slider/'.$slider['image']) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 {{$slider['left'] == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''}}">
                        <div class="home-dtl">
                            <div class="home-heading">{{ $slider['heading'] }}</div>
                            <p class="btm-10">{{ $slider['sub_heading'] }}</p>
                            <p class="btm-20">{{ $slider['detail'] }}</div>

                            @if($slider->search_enable == 1)
                                <div class="home-search">
                                    <form method="GET" id="searchform" action="{{ route('search') }}">
                                        <div class="search">
                                        
                                          <input type="text" name="searchTerm" class="searchTerm" placeholder="What do you want to learn?">
                                          <button type="submit" class="searchButton">
                                            <i class="fa fa-search"></i>
                                         </button>

                                        </div>
                                    </form> 
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif
<!-- home end -->
<!-- learning-work start -->
@if(isset($facts))
<section id="learning-work" class="learning-work-main-block">
    <div class="container">
        <div class="row">
            @foreach($facts as $fact)
            <div class="col-lg-4 col-sm-6">
                <div class="learning-work-block">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="learning-work-icon">
                                <i class="fa {{ $fact['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="learning-work-dtl">
                                <div class="work-heading">{{ $fact['heading'] }}</div>
                                <p>{{ $fact['sub_heading'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- learning-work end -->

<!-- Info -->
<section>
    <div class="py-5 service-32">
    <div class="container">
        <div class="row wrap-feature-32"> 
            <div class="col-md-6"> <img src = "{{ asset('/images/added/Project_157-01.jpg') }}" class="img-fluid" width="100%"> </div>
            <div class="col-md-6 align-self-center"> 
								<span class="badge badge-info rounded-pill px-3 py-1 font-weight-light">Start With us Today</span>
                <h3 class="my-3">Create, Market and Scale your online coaching business</h3>
                <p class="mt-3">With Brite Route, you save money!, we have an all in one service that can help you grow your online coaching business.</p> 
								<p>Set up automationd, send emails, sell tickets, schedule your coaching calls and sell online courses all from your dashboard.</p>
                                <a class="btn btn-info-gradiant btn-md rounded-pill mt-3" href="#f32"><span>Enrol Now</span></a> 
						</div>
        </div>
    </div>
</div>
</section>
<!-- End Info -->


<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowslider')
<br>  
<section id="student" class="student-main-block top-40">
 <div class="container">
<a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
<img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
  alt="{{ $adv->image1 }}">
</a>
</div>
</section>

@endif
@endforeach
@endif

<!-- Student start -->

@if(Auth::check())
@if( isset($recent_course_id)  )
<section id="student" class="student-main-block top-40">
    <div class="container">
        
        @if($total_count >= '0')
        <h4 class="student-heading">{{ __('frontstaticword.RecentlyViewedCourses') }}</h4>
        <div id="recent-courses-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($recent_course_id as $view)
            @php
        
            $recent_course = App\Course::where('id', $view)->first();

            @endphp
            @if(isset($recent_course))

              @if($recent_course->status == 1 && $recent_course->featured == 1)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image">
                        <div class="view-block">
                            <div class="view-img">
                                @if($recent_course['preview_image'] !== NULL && $recent_course['preview_image'] !== '')
                                    <a href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}"><img data-src="{{ asset('images/course/'.$recent_course['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                    <a href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}"><img data-src="{{ Avatar::create($recent_course->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif
                            </div>
                            @if($recent_course['level_tags'] == !NULL)
                            <div class="best-seller">{{ $recent_course['level_tags'] }}</div>
                            @endif
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}">{{ str_limit($recent_course->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($recent_course->user)) {{ $recent_course->user['fname'] }} {{ $recent_course->user['lname'] }} @endif</a></p>
                                <div class="rating">
                                    <ul>
                                        <li>
                                            <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$recent_course->id)->get();
                                            ?> 
                                            @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$recent_course->id)->count();

                                            foreach($reviews as $review){
                                                $learn = $review->price*5;
                                                $price = $review->price*5;
                                                $value = $review->value*5;
                                                $sub_total = $sub_total + $learn + $price + $value;
                                            }

                                            $count = ($count*3) * 5;
                                            $rat = $sub_total/$count;
                                            $ratings_var = ($rat*100)/5;
                                            ?>
                            
                                            <div class="pull-left">
                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                </div>
                                            </div>
                                       
                                             
                                            @else
                                                <div class="pull-left">{{ __('frontstaticword.NoRating') }}</div>
                                            @endif
                                        </li>
                                        <!-- overall rating-->
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $count =  count($reviews);
                                        $onlyrev = array();

                                        $reviewcount = App\ReviewRating::where('course_id', $recent_course->id)->WhereNotNull('review')->get();

                                        foreach($reviews as $review){

                                            $learn = $review->learn*5;
                                            $price = $review->price*5;
                                            $value = $review->value*5;
                                            $sub_total = $sub_total + $learn + $price + $value;
                                        }

                                        $count = ($count*3) * 5;
                                         
                                        if($count != "")
                                        {
                                            $rat = $sub_total/$count;
                                     
                                            $ratings_var = ($rat*100)/5;
                                   
                                            $overallrating = ($ratings_var/2)/10;
                                        }
                                         
                                        ?>

                                        @php
                                            $reviewsrating = App\ReviewRating::where('course_id', $recent_course->id)->first();
                                        @endphp
                                        @if(!empty($reviewsrating))
                                        <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li>
                                        @endif
                                      <li>
                                        (@php
                                            $data = App\ReviewRating::where('course_id', $recent_course->id)->get();
                                            if(count($data)>0){

                                                echo count($data);
                                            }
                                            else{

                                                echo "0";
                                            }
                                        @endphp)
                                    </li> 
                                    </ul>
                                </div>
                                @if( $recent_course->type == 1)
                                    <div class="rate text-right">
                                        <ul>
                                            

                                            @if($recent_course->discount_price == !NULL)
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $recent_course->discount_price }}</b></a></li>&nbsp;
                                                    <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $recent_course->price }}</strike></b></a></li>
                                                @else
                                                    <li><a><b>{{ $recent_course->discount_price }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                    <li><a><b><strike>{{ $recent_course->price }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                @endif
                                                
                                            @else
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $recent_course->price }}</b></a></li>
                                                @else
                                                    <li><a><b>{{ $recent_course->price }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <div class="rate text-right">
                                        <ul>
                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="img-wishlist">
                                    <div class="protip-wishlist">
                                        <ul>
                                            @if(Auth::check())
                                                @php
                                                    $wish = App\Wishlist::where('user_id', auth()->user()->id)->where('course_id', $recent_course->id)->first();
                                                @endphp
                                                @if ($wish == NULL)
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post" action="{{ url('show/wishlist', $recent_course->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{auth()->user()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$recent_course->id}}" />

                                                            <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $recent_course->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{auth()->user()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$recent_course->id}}" />

                                                            <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @endif 
                                            @else
                                                <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
              @endif
            @endif
            @endforeach
        </div>
        @endif
        
    </div>
</section>
@endif
@endif
<!-- Students end -->

<!-- Student start -->
@if(Auth::check())
@php
if(Schema::hasColumn('orders', 'refunded')){
    $enroll = App\Order::where('refunded', '0')->where('user_id', auth()->user()->id)->where('status', '1')->get();
}
else{
    $enroll = NULL;
}
@endphp
@if( isset($enroll) )
<section id="student" class="student-main-block top-40">
    <div class="container">
       
        @if(count($enroll) > 0)
        <h4 class="student-heading">{{ __('frontstaticword.MyPurchasedCourses') }}</h4>
        <div id="my-courses-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($enroll as $enrol)
               @if(isset($enrol->courses) && $enrol->courses['status'] == 1 )
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image">
                        <div class="view-block">
                            <div class="view-img">
                                @if($enrol->courses['preview_image'] !== NULL && $enrol->courses['preview_image'] !== '')
                                    <a href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}"><img data-src="{{ asset('images/course/'.$enrol->courses['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                    <a href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}"><img data-src="{{ Avatar::create($enrol->courses->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}">{{ str_limit($enrol->courses->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($enrol->user)) {{ $enrol->courses->user['fname'] }} {{$enrol->courses->user['lname'] }} @endif</a></p>
                                <div class="rating">
                                    <ul>
                                        <li>
                                            <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$enrol->courses->id)->get();
                                            ?> 
                                            @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$enrol->courses->id)->count();

                                            foreach($reviews as $review){
                                                $learn = $review->price*5;
                                                $price = $review->price*5;
                                                $value = $review->value*5;
                                                $sub_total = $sub_total + $learn + $price + $value;
                                            }

                                            $count = ($count*3) * 5;
                                            $rat = $sub_total/$count;
                                            $ratings_var = ($rat*100)/5;
                                            ?>
                            
                                            <div class="pull-left">
                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                </div>
                                            </div>
                                       
                                             
                                            @else
                                                <div class="pull-left">{{ __('frontstaticword.NoRating') }}</div>
                                            @endif
                                        </li>
                                        <!-- overall rating-->
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $count =  count($reviews);
                                        $onlyrev = array();

                                        $reviewcount = App\ReviewRating::where('course_id', $enrol->courses->id)->WhereNotNull('review')->get();

                                        foreach($reviews as $review){

                                            $learn = $review->learn*5;
                                            $price = $review->price*5;
                                            $value = $review->value*5;
                                            $sub_total = $sub_total + $learn + $price + $value;
                                        }

                                        $count = ($count*3) * 5;
                                         
                                        if($count != "")
                                        {
                                            $rat = $sub_total/$count;
                                     
                                            $ratings_var = ($rat*100)/5;
                                   
                                            $overallrating = ($ratings_var/2)/10;
                                        }
                                         
                                        ?>

                                        @php
                                            $reviewsrating = App\ReviewRating::where('course_id', $enrol->courses->id)->first();
                                        @endphp
                                        @if(!empty($reviewsrating))
                                        <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li>
                                        @endif
                                        <li>
                                            (@php
                                                $data = App\ReviewRating::where('course_id', $enrol->courses->id)->get();
                                                if(count($data)>0){

                                                    echo count($data);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp)
                                        </li> 
                                    </ul>
                                </div>
                                @if( $enrol->courses->type == 1)
                                    <div class="rate text-right">
                                        <ul>
                                           

                                            @if($enrol->courses->discount_price == !NULL)
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $enrol->courses->discount_price }}</b></a></li>&nbsp;
                                                    <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $enrol->courses->price }}</strike></b></a></li>
                                                @else
                                                    <li><a><b>{{ $enrol->courses->discount_price }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                    <li><a><b><strike>{{ $enrol->courses->price }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                @endif
                                                
                                            @else
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $enrol->courses->price }}</b></a></li>
                                                @else
                                                    <li><a><b>{{ $enrol->courses->price }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <div class="rate text-right">
                                        <ul>
                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="img-wishlist">
                                    <div class="protip-wishlist">
                                        <ul>
                                            @if(Auth::check())
                                                @php
                                                    $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $enrol->courses->id)->first();
                                                @endphp
                                                @if ($wish == NULL)
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post" action="{{ url('show/wishlist', $enrol->courses->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$enrol->courses->id}}" />

                                                            <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $enrol->courses->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$enrol->courses->id}}" />

                                                            <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @endif 
                                            @else
                                                <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
              @endif
            @endforeach
        </div>
        @endif
        
    </div>
</section>
@endif
@endif
<!-- Students end -->

<!-- learning-courses start -->
@if(isset($categories))
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <h4 class="student-heading">{{ __('frontstaticword.RecentCourses') }}</h4>
        <div class="row">
            
            <div class="col-lg-12">
                <div class="learning-courses">
                    @if(isset($categories->category_id))
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      @foreach($categories->category_id as $cate)
                        @php
                            $cats= App\Categories::find($cate);
                        @endphp
                        @if(isset($cats))
                        @if($cats['status'] == 1)
                            <li class="btn nav-item" ><a class="nav-item nav-link" id="home-tab" data-toggle="tab" href="#content-tabs" role="tab" aria-controls="home" onclick="showtab('{{ $cats->id }}')" aria-selected="true">{{ $cats['title'] }}</a></li>
                        @endif
                        @endif
                      @endforeach
                    </ul>
                    @endif
                </div>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($categories))
                        @foreach($categories->category_id as $cate)
                            <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div id="tabShow">
                                    
                                </div>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- learning-courses end -->


<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowrecent')
<br>  
<section id="student" class="student-main-block btm-40">
 <div class="container">
<a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
<img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
  alt="{{ $adv->image1 }}">
</a>
</div>
</section>
@endif

@endforeach

@endif
<!-- Advertisement -->
<!-- Student start -->

@php
$cors = App\Course::where('status', '1')->where('featured', '1')->get();
@endphp
@if( ! $cors->isEmpty() )
<section id="student" class="student-main-block">
    <div class="container">
        <h4 class="student-heading">{{ __('frontstaticword.FeaturedCourses') }}</h4>
        <div id="student-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($cors as $c)
              @if($c->status == 1 && $c->featured == 1)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$c->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img data-src="{{ asset('images/course/'.$c['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img data-src="{{ Avatar::create($c->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif
                            </div>
                            @if($c['level_tags'] == !NULL)
                            <div class="best-seller">{{ $c['level_tags'] }}</div>
                            @endif
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}">{{ str_limit($c->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($c->user)) {{ $c->user['fname'] }} {{ $c->user['lname'] }} @endif</a></p>
                                <div class="rating">
                                    <ul>
                                        <li>
                                            <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$c->id)->get();
                                            ?> 
                                            @if(!empty($reviews[0]))
                                            <?php
                                            $count =  App\ReviewRating::where('course_id',$c->id)->count();

                                            foreach($reviews as $review){
                                                $learn = $review->price*5;
                                                $price = $review->price*5;
                                                $value = $review->value*5;
                                                $sub_total = $sub_total + $learn + $price + $value;
                                            }

                                            $count = ($count*3) * 5;
                                            $rat = $sub_total/$count;
                                            $ratings_var = ($rat*100)/5;
                                            ?>
                            
                                            <div class="pull-left">
                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                </div>
                                            </div>
                                       
                                             
                                            @else
                                                <div class="pull-left">{{ __('frontstaticword.NoRating') }}</div>
                                            @endif
                                        </li>
                                        <!-- overall rating-->
                                        <?php 
                                        $learn = 0;
                                        $price = 0;
                                        $value = 0;
                                        $sub_total = 0;
                                        $count =  count($reviews);
                                        $onlyrev = array();

                                        $reviewcount = App\ReviewRating::where('course_id', $c->id)->WhereNotNull('review')->get();

                                        foreach($reviews as $review){

                                            $learn = $review->learn*5;
                                            $price = $review->price*5;
                                            $value = $review->value*5;
                                            $sub_total = $sub_total + $learn + $price + $value;
                                        }

                                        $count = ($count*3) * 5;
                                         
                                        if($count != "")
                                        {
                                            $rat = $sub_total/$count;
                                     
                                            $ratings_var = ($rat*100)/5;
                                   
                                            $overallrating = ($ratings_var/2)/10;
                                        }
                                         
                                        ?>

                                        @php
                                            $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
                                        @endphp
                                        @if(!empty($reviewsrating))
                                        <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li>
                                        @endif
                                        <li>
                                            (@php
                                                $data = App\ReviewRating::where('course_id', $c->id)->get();
                                                if(count($data)>0){

                                                    echo count($data);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp)
                                        </li> 
                                    </ul>
                                </div>
                                @if( $c->type == 1)
                                    <div class="rate text-right">
                                        <ul>
                                            

                                            @if($c->discount_price == !NULL)
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->discount_price }}</b></a></li>&nbsp;
                                                    <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $c->price }}</strike></b></a></li>
                                                @else
                                                    <li><a><b>{{ $c->discount_price }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                    <li><a><b><strike>{{ $c->price }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                @endif
                                                
                                            @else
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->price }}</b></a></li>
                                                @else
                                                    <li><a><b>{{ $c->price }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <div class="rate text-right">
                                        <ul>
                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="img-wishlist">
                                    <div class="protip-wishlist">
                                        <ul>
                                            @if(Auth::check())
                                                @php
                                                    $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                @endphp
                                                @if ($wish == NULL)
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post" action="{{ url('show/wishlist', $c->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                            <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $c->id) }}" data-parsley-validate 
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id"  value="{{$c->id}}" />

                                                            <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                        </form>
                                                    </li>
                                                @endif 
                                            @else
                                                <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block{{$c->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $c['title'] }}</h5>
                                <div class="protip-img">
                                    @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
                                        <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ asset('images/course/'.$c['preview_image']) }}" alt="student" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ Avatar::create($c->title)->toBase64() }}" alt="student" class="img-fluid">
                                        </a>
                                    @endif
                                </div>

                                <ul class="description-list">
                                    <li>{{ __('frontstaticword.Classes') }}: 
                                        @php
                                            $data = App\CourseClass::where('course_id', $c->id)->get();
                                            if(count($data)>0){

                                                echo count($data);
                                            }
                                            else{

                                                echo "0";
                                            }
                                        @endphp
                                    </li>
                                    &nbsp;
                                    <li>
                                        @if( $c->type == 1)
                                            <div class="rate text-right">
                                                <ul>
                                                    

                                                    @if($c->discount_price == !NULL)
                                                        @if($gsetting['currency_swipe'] == 1)
                                                            <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->discount_price }}</b></a></li>&nbsp;
                                                            <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $c->price }}</strike></b></a></li>
                                                        @else
                                                            <li><a><b>{{ $c->discount_price }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                            <li><a><b><strike>{{ $c->price }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                        @endif
                                                        
                                                    @else
                                                        @if($gsetting['currency_swipe'] == 1)
                                                            <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->price }}</b></a></li>
                                                        @else
                                                            <li><a><b>{{ $c->price }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        @else
                                            <div class="rate text-right">
                                                <ul>
                                                    <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                </ul>

                                <div class="main-des">
                                    <p>{{ $c->short_detail }}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if($c->type == 1)
                                                @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if(!empty($order) && $order->status == 1)
                                                            <div class="protip-btn">
                                                                <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                            </div>
                                                        @else
                                                            @php
                                                                $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                            @endphp
                                                            @if(!empty($cart))
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                                        {{ csrf_field() }}
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ]) }}"
                                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                                            {{ csrf_field() }}

                                                                        <input type="hidden" name="category_id"  value="{{$c->category['id']}}" />
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                                    </div>
                                                @endif
                                            @else
                                                 @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if($enroll == NULL)
                                                            <div class="protip-btn">
                                                                <a href="{{url('enroll/show',$c->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.GoToCourse') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
              @endif
            @endforeach
        </div>
        
    </div>
</section>
@endif
<!-- Students end -->

<!-- Info2 -->
<section>
<div class="py-5 service-26">
    <div class="container">
        <div class="row wrap-service-26">
            <div class="col-md-7 align-self-center">
                <h4 class="student-heading">Platform Features</h4>
                <div class="max-box"> 
										<span class="badge badge-info rounded-pill px-3 py-1 font-weight-light">Feature</span>
                    <h3 class="mt-3">Video & E-book Courses </h3>
                    <p class="mt-3">You can easily create and sell your online courses for FREE on our all-in-one platform, Briteroute has made it easy to start selling courses. No technical or design skills needed.</p>
                    <p>We guarantee you a fast and reliable delivery for your courses.</p>
                    <a href="https://briteroute.com/pages/vide-ebook-courses" class="linking">Learn More</a>
                </div>
            </div>
            <div class="col-md-5 col-md-5"> 
                <img src = "{{ asset('/images/added/picture1.jpg') }}" class="img-fluid" width="100%"> 
						</div>
        </div>
        <div class="row wrap-service-26 mt-4 pt-3">
            <div class="col-md-6"> 
                <img src = "{{ asset('/images/added/3PeopleMountain.jpg') }}" class="img-fluid" width="100%"> 
						</div>
            <div class="col-md-6 align-self-center">
                <span class="badge badge-info rounded-pill px-3 py-1 font-weight-light">Feature</span>
                <h3 class="mt-3">Coaching and Tickets</h3>
                <p class="mt-3">Create and deliver personalized one-on-one coaching services to your students on Kobocourse. Choose your preferred date, availability and delivery channel like WhatsApp, Zoom, Skype or Physical training.</p>
                <p>Our coaching feature allows you to track and enagage with students who want to learn from you directly. Receive reminders directly to your email about your upcoming one-on-one coaching appointments.</p>
                <a class="linking" href="https://briteroute.com/pages/coaching-tickets">Learn More</a>
            </div>
        </div>
    </div>
</div>
</section>
<!--Info2 End -->

<!-- Subscription Bundle start -->
<section id="subscription" class="student-main-block">
    <div class="container">
        @if (isset($subscriptionBundles) && !$subscriptionBundles->isEmpty())
            <h4 class="student-heading">{{ __('frontstaticword.SubscriptionBundles') }}</h4>
            <div id="subscription-bundle-view-slider" class="student-view-slider-main-block owl-carousel">
                @foreach ($subscriptionBundles as $bundle)
                    @if ($bundle->status == 1 && $bundle->is_subscription_enabled == 1)

                        <div class="item student-view-block student-view-block-1">
                            <div class="genre-slide-image protip" data-pt-placement="outside"
                                data-pt-interactive="false"
                                data-pt-title="#prime-next-item-description-block-3{{ $bundle->id }}">
                                <div class="view-block">
                                    <div class="view-img">
                                        @if ($bundle['preview_image'] !== null && $bundle['preview_image'] !== '')
                                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img data-src="{{ asset('images/bundle/' . $bundle['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                        @else
                                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img data-src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                        @endif
                                    </div>
                                    <div class="view-dtl">
                                        <div class="view-heading btm-10"><a href="{{ route('bundle.detail', $bundle->id) }}">{{ str_limit($bundle->title, $limit = 30, $end = '...') }}</a>
                                        </div>
                                        <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($bundle->user)) {{ $bundle->user['fname'] }} {{ $bundle->user['lname'] }} @endif</a></p>

                                        <p class="btm-10"><a herf="#">Created At:
                                                {{ date('d-m-Y', strtotime($bundle['created_at'])) }}</a></p>

                                        @if ($bundle->type == 1)
                                            <div class="rate text-right">
                                                <ul>
                                                   

                                                    @if ($bundle->discount_price == !null)
                                                        @if($gsetting['currency_swipe'] == 1)
                                                            <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->discount_price }}/{{ $bundle->billing_interval }}</b></a></li>&nbsp;
                                                            <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}/{{ $bundle->billing_interval }}</strike></b></a></li>
                                                        @else
                                                            <li><a><b>{{ $bundle->discount_price }}/{{ $bundle->billing_interval }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                            <li><a><b><strike>{{ $bundle->price }}/{{ $bundle->billing_interval }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                        @endif

                                                    @else
                                                        @if($gsetting['currency_swipe'] == 1)
                                                            <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}/{{ $bundle->billing_interval }}</b></a></li>
                                                        @else
                                                            <li><a><b>{{ $bundle->price }}/{{ $bundle->billing_interval }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>

                                        @else
                                            <div class="rate text-right">
                                                <ul>
                                                    <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                                </ul>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                            <div id="prime-next-item-description-block-3{{ $bundle->id }}"
                                class="prime-description-block">
                                <div class="prime-description-under-block">
                                    <div class="prime-description-under-block">
                                        <h5 class="description-heading">{{ $bundle['title'] }}</h5>
                                        <div class="protip-img">
                                            @if ($bundle['preview_image'] !== null && $bundle['preview_image'] !== '')
                                                <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ asset('images/bundle/' . $bundle['preview_image']) }}"
                                                        alt="student" class="img-fluid">
                                                </a>
                                            @else
                                                <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="student" class="img-fluid">
                                                </a>
                                            @endif
                                        </div>



                                        <div class="main-des">
                                            @if($bundle['short_detail'] != NUll)

                                            <p>{{ str_limit($bundle['short_detail'], $limit = 200, $end = '...') }}</p>
                                            @else
                                            <p>{{ str_limit($bundle['detail'], $limit = 200, $end = '...') }}</p>
                                            @endif
                                        </div>
                                        <div class="des-btn-block">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if ($bundle->type == 1)
                                                        @if (Auth::check())
                                                            @if (Auth::User()->role == 'admin')
                                                                <div class="protip-btn">
                                                                    <a href="" class="btn btn-secondary"
                                                                        title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                                </div>
                                                            @else
                                                                @php
                                                                $order = App\Order::where('user_id',
                                                                Auth::User()->id)->where('bundle_id',
                                                                $bundle->id)->first();
                                                                @endphp
                                                                @if (!empty($order) && $order->status == 1)
                                                                    <div class="protip-btn">
                                                                        <a href="" class="btn btn-secondary"
                                                                            title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                                    </div>
                                                                @else
                                                                    @php
                                                                    $cart = App\Cart::where('user_id',
                                                                    Auth::User()->id)->where('bundle_id',
                                                                    $bundle->id)->first();
                                                                    @endphp
                                                                    @if (!empty($cart))
                                                                        <div class="protip-btn">
                                                                            <form id="demo-form2" method="post"
                                                                                action="{{ route('remove.item.cart', $cart->id) }}">
                                                                                {{ csrf_field() }}

                                                                                <div class="box-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @else
                                                                        <div class="protip-btn">
                                                                            <form id="demo-form2" method="post"
                                                                                action="{{ route('bundlecart', $bundle->id) }}"
                                                                                data-parsley-validate
                                                                                class="form-horizontal form-label-left">
                                                                                {{ csrf_field() }}

                                                                                <input type="hidden" name="user_id"
                                                                                    value="{{ Auth::User()->id }}" />
                                                                                <input type="hidden" name="bundle_id"
                                                                                    value="{{ $bundle->id }}" />

                                                                                <div class="box-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">{{ __('frontstaticword.SubscribeNow') }}</button>
                                                                                </div>


                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="protip-btn">

                                                                <a href="{{ route('login') }}"
                                                                    class="btn btn-primary"><i class="fa fa-cart-plus"
                                                                        aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.SubscribeNow') }}</a>

                                                            </div>
                                                        @endif
                                                    @else
                                                        @if (Auth::check())
                                                            @if (Auth::User()->role == 'admin')
                                                                <div class="protip-btn">
                                                                    <a href="" class="btn btn-secondary"
                                                                        title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                                </div>
                                                            @else
                                                                @php
                                                                $enroll = App\Order::where('user_id',
                                                                Auth::User()->id)->where('course_id', $c->id)->first();
                                                                @endphp
                                                                @if ($enroll == null)
                                                                    <div class="protip-btn">
                                                                        <a href="{{ url('enroll/show', $bundle->id) }}"
                                                                            class="btn btn-primary"
                                                                            title="Enroll Now">{{ __('frontstaticword.SubscribeNow') }}</a>
                                                                    </div>
                                                                @else
                                                                    <div class="protip-btn">
                                                                        <a href="" class="btn btn-secondary"
                                                                            title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="{{ route('login') }}" class="btn btn-primary"
                                                                    title="Enroll Now">{{ __('frontstaticword.SubscribeNow') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endif

                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- Subscription Bundle end -->

<!-- Bundle start -->
@if(isset($bundles))
<section id="bundle-block" class="student-main-block">
    <div class="container">
        @if(count($bundles) > 0)
        <h4 class="student-heading">{{ __('frontstaticword.BundleCourses') }}</h4>

        <div id="bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($bundles as $bundle)
                @if($bundle->status == 1)
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-4{{$bundle->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                                    <a href="{{ route('bundle.detail', $bundle->id) }}"><img data-src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                    <a href="{{ route('bundle.detail', $bundle->id) }}"><img data-src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('bundle.detail', $bundle->id) }}">{{ str_limit($bundle->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($bundle->user)) {{ $bundle->user['fname'] }} {{ $bundle->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Created At: {{ date('d-m-Y',strtotime($bundle['created_at'])) }}</a></p>

                                @if($bundle->type == 1)
                                    <div class="rate text-right">
                                        <ul>

                                            @if($bundle->discount_price == !NULL)
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->discount_price }}</b></a></li>&nbsp;
                                                    <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}</strike></b></a></li>
                                                @else
                                                    <li><a><b>{{ $bundle->discount_price }}<i class="{{ $currency->icon }}"></i></b></a></li>&nbsp;
                                                    <li><a><b><strike>{{ $bundle->price }}<i class="{{ $currency->icon }}"></i></strike></b></a></li>
                                                @endif
                                                
                                            @else
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li><a><b><i class="{{ $currency->icon }}"></i>{{ $bundle->price }}</b></a></li>
                                                @else
                                                    <li><a><b>{{ $bundle->price }}<i class="{{ $currency->icon }}"></i></b></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <div class="rate text-right">
                                        <ul>
                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                        </ul>
                                    </div>
                                @endif
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-4{{$bundle->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $bundle['title'] }}</h5>
                                <div class="protip-img">
                                    @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                                        <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" alt="student" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="{{ route('bundle.detail', $bundle->id) }}"><img src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="student" class="img-fluid">
                                        </a>
                                    @endif
                                </div>

                                

                               <div class="main-des">
                                    <p>{{ strip_tags(str_limit($bundle['detail'], $limit = 200, $end = '...')) }}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if($bundle->type == 1)
                                                @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $order = App\Order::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                                        @endphp
                                                        @if(!empty($order) && $order->status == 1)
                                                            <div class="protip-btn">
                                                                <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                            </div>
                                                        @else
                                                            @php
                                                                $cart = App\Cart::where('user_id', Auth::User()->id)->where('bundle_id', $bundle->id)->first();
                                                            @endphp
                                                            @if(!empty($cart))
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                                        {{ csrf_field() }}
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="protip-btn">
                                                                    <form id="demo-form2" method="post" action="{{ route('bundlecart', $bundle->id) }}"
                                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                                            {{ csrf_field() }}

                                                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                                        <input type="hidden" name="bundle_id"  value="{{$bundle->id}}" />
                                                                                
                                                                        <div class="box-footer">
                                                                         <button type="submit" class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                                    </div>
                                                @endif
                                            @else
                                                 @if(Auth::check())
                                                    @if(Auth::User()->role == "admin")
                                                        <div class="protip-btn">
                                                            <a href="" class="btn btn-secondary" title="course">{{ __('frontstaticword.Purchased') }}</a>
                                                        </div>
                                                    @else
                                                        @php
                                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        @endphp
                                                        @if($enroll == NULL)
                                                            <div class="protip-btn">
                                                                <a href="{{url('enroll/show',$bundle->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="protip-btn">
                                                                <a href="" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <div class="protip-btn">
                                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 

                @endif
             
            @endforeach
        </div>
        @endif
        
    </div>
</section>
@endif
<!-- Bundle end -->

<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowbundle')
<br>  
<section id="student" class="student-main-block btm-40">
 <div class="container">
<a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
<img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
  alt="{{ $adv->image1 }}">
</a>
</div>
</section>
@endif

@endforeach

@endif


<!-- Batch start -->
@if(isset($batches))

<section id="batch-block" class="student-main-block">
    <div class="container">
        @if(count($batches) > 0)
        <h4 class="student-heading">{{ __('frontstaticword.Batches') }}</h4>
        
        <div id="batch-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($batches as $batch)
                @if($batch->status == 1)
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-5{{$batch->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($batch['preview_image'] !== NULL && $batch['preview_image'] !== '')
                                    <a href="{{ route('batch.detail', $batch->id) }}"><img data-src="{{ asset('images/batch/'.$batch['preview_image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                    <a href="{{ route('batch.detail', $batch->id) }}"><img data-src="{{ Avatar::create($batch->title)->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('batch.detail', $batch->id) }}">{{ str_limit($batch->title, $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($batch->user)) {{ $batch->user['fname'] }} {{ $batch->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Created At: {{ date('d-m-Y',strtotime($batch['created_at'])) }}</a></p>
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-5{{$batch->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $batch['title'] }}</h5>
                                <div class="protip-img">
                                    @if($batch['preview_image'] !== NULL && $batch['preview_image'] !== '')
                                        <a href="{{ route('batch.detail', $batch->id) }}"><img src="{{ asset('images/batch/'.$batch['preview_image']) }}" alt="student" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="{{ route('batch.detail', $batch->id) }}"><img src="{{ Avatar::create($batch->title)->toBase64() }}" alt="course" class="img-fluid"></a>
                                    @endif
                                </div>

                                

                                <div class="main-des">
                                    <p>{!! str_limit($batch['detail'], $limit = 200, $end = '...') !!}</p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
                </div> 

                @endif
             
            @endforeach
        </div>

        @endif
        
    </div>
</section>

@endif
<!-- Batch end -->

<!-- Zoom start -->
@if($gsetting->zoom_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( ! $meetings->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.ZoomMeetings') }}</h4>
        <div id="zoom-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($meetings as $meeting)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6{{$meeting->id}}">
                        <div class="view-block">
                            <div class="view-img">

                                @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                                    <a href="{{ route('zoom.detail', $meeting->id) }}"><img data-src="{{ asset('images/zoom/'.$meeting['image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                   <a href="{{ route('zoom.detail', $meeting->id) }}"><img data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif

                               
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">{{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-6{{$meeting->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading"><a href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a></h5>
                                <div class="protip-img">
                                    <h3 class="description-heading">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner: {{ $meeting->owner_id }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                </div>
                                <div class="des-btn-block">
                                    <a href="{{ $meeting->zoom_url }}" target="_blank" class="btn btn-light">Join Meeting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Zoom end -->


<!-- Bundle start -->
@if($gsetting->bbl_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        
        @if( ! $bigblue->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.BigBlueMeetings') }}</h4>
        <div id="bbl-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($bigblue as $bbl)
                
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-7{{$bbl->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                <a href="{{ route('bbl.detail', $bbl->id) }}"><img data-src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10"><a href="{{ route('bbl.detail', $bbl->id) }}">{{ str_limit($bbl['meetingname'], $limit = 30, $end = '...') }}</a></div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($bbl->user)) {{ $bbl->user['fname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($bbl['start_time'])) }}</a></p>
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-7{{$bbl->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $bbl['meetingname'] }}</h5>
                                <div class="protip-img">
                                    <a href="{{ route('bbl.detail', $bbl->id) }}"><img src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" alt="course" class="img-fluid"></a>
                                </div>

                                <div class="main-des">
                                    <p>{!! $bbl['detail'] !!}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Bundle end -->

<!-- Google meet start -->
@if($gsetting->googlemeet_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( isset($allgooglemeet) )
        <h4 class="student-heading">{{ __('frontstaticword.GoogleMeetings') }}</h4>
        <div id="google-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($allgooglemeet as $meeting)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6{{ $meeting['meeting_id'] }}">
                        <div class="view-block">
                            <div class="view-img">

                                @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                                    <a href="{{ route('googlemeetdetailpage.detail', $meeting['id']) }}"><img data-src="{{ asset('images/googlemeet/profile_image/'.$meeting['image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                   <a href="{{ route('googlemeetdetailpage.detail', $meeting['id']) }}"><img data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif

                               
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">{{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                <!-- <p class="btm-10"><a herf="#">End At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['end_time'])) }}</a></p> -->
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-6{{$meeting['meeting_id']}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading"><a href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a></h5>
                                <div class="protip-img">
                                    <h3 class="description-heading">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner: {{ $meeting->owner_id }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">End At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['end_time'])) }}</a></p>
                                </div>
                                <div class="des-btn-block">
                                    <a href="{{ $meeting->meet_url }}" target="_blank" class="btn btn-light">Join Meeting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Google meet end -->

<!-- jitsi meet start -->
@if($gsetting->jitsimeet_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( ! $jitsimeeting->isEmpty() )
        <h4 class="student-heading">Jitsi Meetings</h4>
        <div id="jitsi-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($jitsimeeting as $meeting)
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6{{ $meeting['meeting_id'] }}">
                        <div class="view-block">
                            <div class="view-img">

                                @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                                    <a href="{{ route('jitsipage.detail', $meeting['id']) }}"><img data-src="{{ asset('images/jitsimeet/'.$meeting['image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                @else
                                   <a href="{{ route('jitsipage.detail', $meeting['id']) }}"><img data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                @endif

                               
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">{{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                <!-- <p class="btm-10"><a herf="#">End At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['end_time'])) }}</a></p> -->
                            </div>
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-6{{$meeting['meeting_id']}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading"><a href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a></h5>
                                <div class="protip-img">
                                    <h3 class="description-heading">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner: {{ $meeting->owner_id }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                </div>
                                <div class="main-des">
                                    <p class="btm-10"><a herf="#">End At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['end_time'])) }}</a></p>
                                </div>
                                <div class="des-btn-block">
                                    <a href="{{url('meetup-conferencing/'.$meeting->meeting_id) }}" target="_blank" class="btn btn-light">Join Meeting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- jitsi meet end -->


<!-- Bundle start -->
<!--
@if( ! $blogs->isEmpty() ) 
<section id="student" class="student-main-block">
    <div class="container">
        
        <h4 class="student-heading">{{ __('frontstaticword.RecentBlogs') }}</h4>
        <div id="blog-post-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($blogs as $blog)
                
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-8{{$blog->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($blog['image'] !== NULL && $blog['image'] !== '')
                                    @if($blog->slug != NULL)
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                    @else
                                         <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                    @endif

                                        <img data-src="{{ asset('images/blog/'.$blog['image']) }}" alt="course" class="img-fluid owl-lazy">
                                    </a>
                                @else
                                    @if($blog->slug != NULL)
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                    @else
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                    @endif
                                        <img data-src="{{ Avatar::create($blog->heading)->toBase64() }}" alt="course" class="img-fluid owl-lazy">
                                    </a>
                                @endif

                                
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">
                                     @if($blog->slug != NULL)
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                            {{ str_limit($blog['heading'], $limit = 25, $end = '...') }}
                                    @else
                                        <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">

                                            {{ str_limit($blog['heading'], $limit = 25, $end = '...') }}
                                    @endif
                                    </a>
                                </div>
                                <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($blog->user)) {{ $blog->user['fname'] }} {{ $blog->user['lname'] }} @endif</a></p>

                                <p class="btm-10"><a herf="#">Created At: {{ date('d-m-Y | h:i:s A',strtotime($blog['created_at'])) }}</a></p>
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-8{{$blog->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $blog['heading'] }}</h5>
                                <div class="protip-img">
                                    @if($blog['image'] !== NULL && $blog['image'] !== '')
                                        @if($blog->slug != NULL)
                                            <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                        @else
                                             <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                        @endif
                                            <img src="{{ asset('images/blog/'.$blog['image']) }}" alt="course" class="img-fluid">
                                        </a>
                                    @else
                                        
                                        @if($blog->slug != NULL)
                                            <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                        @else
                                             <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                        @endif
                                            <img src="{{ Avatar::create($blog->heading)->toBase64() }}" alt="course" class="img-fluid">
                                        </a>
                                    @endif
                                </div>

                                <div class="main-des">
                                    <p>{{substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($blog->detail))), 0, 400)}}</p>
                                </div>
                                <div class="des-btn-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            @endforeach
        </div>
        
    </div>
</section>
@endif
                                        -->
<!-- Bundle end -->
<!-- recommendations start -->
<section id="border-recommendation" class="border-recommendation">
    @php
        $gets = App\GetStarted::first();
    @endphp
    @if(isset($gets)) 
    <div class="top-border"></div>
    <div class="recommendation-main-block  text-center" style="background-image: url('{{ asset('images/getstarted/'.$gets['image']) }}')">
        <div class="container">
            <h3 class="text-white">{{ $gets['heading'] }}</h3>
            <p class="text-white btm-20">{{ $gets['sub_heading'] }}</p>
            @if($gets->button_txt == !NULL)
            <div class="recommendation-btn text-white">
                <a href="{{ $gets['link'] }}" class="btn btn-primary" title="search">{{ $gets['button_txt'] }}</a>
            </div>
            @endif 
        </div>
    </div>
    @endif
</section>
<!-- recommendations end -->
<!-- categories start -->

@if(!$category->isEmpty())

<section id="categories" class="categories-main-block">
    <div class="container">
        <h3 class="categories-heading btm-30">{{ __('frontstaticword.FeaturedCategories') }}</h3>
        <div class="row">

            @foreach($category as $t)
            @if($t->status == 1 && $t->featured == 1)

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="image-container btm-20">
                <a href="{{ route('category.page',['id' => $t->id, 'category' => str_slug(str_replace('-','&',$t->slug))]) }}">

                  <div class="image-overlay">
                    <i class="fa {{ $t['icon'] }}"></i>{{ $t['title'] }}
                  </div>

                  @if($t['cat_image'] == !NULL)
                    <img src="{{ asset('images/category/'.$t['cat_image']) }}">
                  @else
                    <img src="{{ Avatar::create($t->title)->toBase64() }}">
                  @endif
                </a>
                </div>
                
            </div>

            @endif
            @endforeach
        </div>
    </div>
</section>



@endif

<!-- categories end -->
<!-- testimonial start -->
 @php
    $testi = App\Testimonial::all();
@endphp
@if( ! $testi->isEmpty() )
<section id="testimonial" class="testimonial-main-block">
    <div class="container">
        <h3 class="btm-30">{{ __('frontstaticword.HomeTestimonial') }}</h3>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            
            @foreach($testi as $tes)
             @if($tes->status == 1)
            <div class="item testimonial-block">
                <ul>
                    <li><img data-src="{{ asset('images/testimonial/'.$tes['image']) }}" alt="blog" class="img-fluid owl-lazy"></li>
                    <li><h5 class="testimonial-heading">{{ $tes['client_name'] }}</h5></li>
                </ul>
                <p>{{ str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($tes->details))) , $limit = 300, $end = '...') }}</p>
            </div>
             @endif
            @endforeach
        </div> 
        
    </div>
</section>
@endif


<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowtestimonial')
<br>  
<section id="student" class="student-main-block btm-40">
 <div class="container">
<a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
<img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
  alt="{{ $adv->image1 }}">
</a>
</div>
</section>

@endif
@endforeach
@endif


@if( !$trusted->isEmpty() )
<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">
            
            <h6 class="patners-heading text-center btm-40">{{ __('frontstaticword.Trusted') }}</h6>
            <div id="patners-slider" class="patners-slider owl-carousel">
                @foreach($trusted as $trust)
                    @if($trust->status == 1)
                    <div class="item-patners-img">
                        <a href="{{ $trust['url'] }}" target="_blank"><img data-src="{{ asset('images/trusted/'.$trust['image']) }}" class="img-fluid owl-lazy" alt="patners-1"></a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
</section>
@endif

<section id="trusted" class="trusted-main-block">
    <!-- google adsense code -->
    <div class="container-fluid" id="adsense">
        @php
            $ad = App\Adsense::first();
        @endphp
        <?php
            if (isset($ad) ) {
             if ($ad->ishome==1 && $ad->status==1) {
                $code = $ad->code;
                echo html_entity_decode($code);
             }
            }
        ?>
    </div>
</section>

@endsection

@section('custom-script')
<script>
    (function($) {
      "use strict";
        $(function() {
           $( "#home-tab" ).trigger( "click" );
        });
    })(jQuery);

    function showtab(id){
        $.ajax({
            type : 'GET',
            url  : '{{ url('/tabcontent') }}/'+id,
            dataType  : 'html',
            success : function(data){

                $('#tabShow').html('');
                $('#tabShow').append(data);
            }
        });
    }
</script>

@endsection
