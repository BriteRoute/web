@extends('theme.master')
@section('title', "$course->title")
@section('content')

@include('admin.message')

@section('meta_tags')

@php
    $url =  URL::current();
@endphp

<meta name="title" content="{{ $course['title'] }}">
<meta name="description" content="{{ $course['short_detail'] }} ">
<meta property="og:title" content="{{ $course['title'] }} ">
<meta property="og:url" content="{{ $url }}">
<meta property="og:description" content="{{ $course['short_detail'] }}">
<meta property="og:image" content="{{ asset('images/course/'.$course['preview_image']) }}">
<meta itemprop="image" content="{{ asset('images/course/'.$course['preview_image']) }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/course/'.$course['preview_image']) }}">
<meta property="twitter:title" content="{{ $course['title'] }} ">
<meta property="twitter:description" content="{{ $course['short_detail'] }}">
<meta name="twitter:site" content="{{ url()->full() }}" />
<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
    
@endsection

<section id="about-bar-fixed">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="about-home-heading">{{ $course['title'] }}</h1>
                <ul>
                    <li>
                        <?php
                        $learn = 0;
                        $price = 0;
                        $value = 0;
                        $sub_total = 0;
                        $sub_total = 0;
                        $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                        ?>
                        @if(!empty($reviews[0]))
                            <?php
                            $count =  App\ReviewRating::where('course_id',$course->id)->count();

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
                            <div class="no-rating">
                                {{ __('frontstaticword.NoRating') }}
                            </div>
                        @endif
                    </li>

                    <?php
                        $learn = 0;
                        $price = 0;
                        $value = 0;
                        $sub_total = 0;
                        $count =  count($reviews);
                        $onlyrev = array();

                        $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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


                    @if(! $reviews->isEmpty())
                    <li>
                        {{ round($overallrating, 1) }} {{ __('frontstaticword.rating') }}
                    </li>
                    @endif
                    <li>
                        (@php
                            $data = App\ReviewRating::where('course_id', $course->id)->get();
                            if(count($data)>0){

                                echo count($data);
                            }
                            else{

                                echo "0";
                            }
                        @endphp {{ __('frontstaticword.Reviews') }})
                    </li>
                    <li>
                        @php
                            $data = App\Order::where('course_id', $course->id)->get();
                            if(count($data)>0){

                                echo count($data);
                            }
                            else{

                                echo "0";
                            }
                        @endphp
                        {{ __('frontstaticword.studentsenrolled') }}
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</section>
<!-- course detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block">
                    <h1 class="about-home-heading">{{ $course['title'] }}</h1>
                    <p>{{ $course['short_detail'] }}</p>
                    <ul>
                        <li>
                            <?php
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $sub_total = 0;
                            $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                            ?>
                            @if(!empty($reviews[0]))
                                <?php
                                $count =  App\ReviewRating::where('course_id',$course->id)->count();

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
                                <div class="no-rating">
                                    {{ __('frontstaticword.NoRating') }}
                                </div>
                            @endif
                        </li>

                        <?php
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $count =  count($reviews);
                            $onlyrev = array();

                            $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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


                        @if(! $reviews->isEmpty())
                        <li>
                            {{ round($overallrating, 1) }} {{ __('frontstaticword.rating') }}
                        </li>
                        @endif
                        <li>
                            (@php
                                $data = App\ReviewRating::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp {{ __('frontstaticword.Reviews') }})
                        </li>
                        <li>
                            @php
                                $data = App\Order::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp
                            {{ __('frontstaticword.studentsenrolled') }}
                        </li>
                    </ul>
                    <ul>
                        <li><a href="#" title="about">{{ __('frontstaticword.Created') }}: @if(isset($course->user)) {{ $course->user['fname'] }} {{ $course->user['lname'] }} @endif</a></li>
                        <li><a href="#" title="about">{{ __('frontstaticword.LastUpdated') }}: {{ date('jS F Y', strtotime($course['updated_at'])) }}</a></li>
                        @if($course['language_id'] == !NULL)
                        @if(isset($course->language))
                        <li><a href="#" title="about"><i class="fa fa-comment"></i></a> {{ $course->language['name'] }}</li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
            <!-- course preview -->
            <div class="col-lg-4">
                <div class="about-home-icon text-white text-right">
                    <ul>
                        @if(Auth::check())

                            @if($wish == NULL)
                                <li class="about-icon-one">
                                    <form id="demo-form2" method="post" action="{{ url('show/wishlist', $course->id) }}" data-parsley-validate
                                        class="form-horizontal form-label-left">
                                        @csrf

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                        <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                        <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i>{{ __('frontstaticword.Wishlist') }}</button>
                                    </form>
                                </li>
                            @else
                                <li class="about-icon-two">
                                    <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $course->id) }}" data-parsley-validate
                                        class="form-horizontal form-label-left">
                                        @csrf

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                        <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                        <button class="wishlisht-btn" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i>{{ __('frontstaticword.Wishlisted') }}</button>
                                    </form>
                                </li>
                            @endif
                        @else
                            <li class="about-icon-one"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i>{{ __('frontstaticword.Wishlist') }}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                        <script type="text/javascript">
                        @if($course->video !="")
                        var video_url = '<iframe src="{{ asset('video/preview/'.$course['video']) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        @if($course->url !="")
                        var video_url = '<iframe src="{{ str_replace('watch?v=','embed/',$course['url']) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        </script>

                        <div class="video-device">
                            @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                <img src="{{ asset('images/course/'.$course['preview_image']) }}" class="bg_img img-fluid" alt="Background">
                            @else
                                <img src="{{ Avatar::create($course->title)->toBase64() }}" class="bg_img img-fluid" alt="Background">
                            @endif
                            @if($course->video !="" || $course->url !="")
                            <div class="video-preview">
                                <a href="javascript:void(0);" class="btn-video-play"><i class="fa fa-play"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="bar-fixed">
                        <div class="about-home-dtl-training">
                            <div class="about-home-dtl-block btm-10">
                            @if($course->type == 1)
                                <div class="about-home-rate">
                                    <ul>

                                        @if($course->discount_price == !NULL)
                                            @if($gsetting['currency_swipe'] == 1)
                                                <li><i class="{{ $currency['icon'] }}"></i>{{ $course['discount_price'] }}</li>
                                                <li><span><s><i class="{{ $currency->icon }}"></i>{{ $course['price'] }}</s></span></li>
                                            @else
                                                <li>{{ $course['discount_price'] }}<i class="{{ $currency['icon'] }}"></i></li>
                                                <li><span><s>{{ $course['price'] }}<i class="{{ $currency->icon }}"></i></s></span></li>
                                            @endif
                                        @else
                                            @if($gsetting['currency_swipe'] == 1)
                                                <li><i class="{{ $currency['icon'] }}"></i>{{ $course['price'] }}</li>
                                            @else
                                                <li>{{ $course['price'] }}<i class="{{ $currency['icon'] }}"></i></li>
                                            @endif
                                        @endif

                                    </ul>
                                </div>
                                @if(Auth::check())

                                    @if(Auth::User()->role == "admin")
                                        <div class="about-home-btn btm-20">
                                            <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                    @else
                                        @if(isset($course->duration))
                                            @if($course->duration_type == "m")
                                            <div class="course-duration btm-10">{{ __('frontstaticword.EnrollDuration') }}: {{ $course->duration }} Months</div>
                                            @else
                                            <div class="course-duration btm-10">{{ __('frontstaticword.EnrollDuration') }}: {{ $course->duration }} Days</div>
                                            @endif
                                        @endif


                                        @if(!empty($order) && $order->status == 1)

                                            <div class="about-home-btn btm-20">
                                                <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                            </div>

                                        @elseif(isset($course_id) && in_array($course->id, $course_id))
                                            <div class="about-home-btn btm-20">
                                                <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                            </div>





                                        @elseif(!empty($instruct_course->id) && $instruct_course->id == $course->id)

                                            <div class="about-home-btn btm-20">
                                                <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                            </div>


                                        @else

                                            @if(!empty($cart))
                                                <div class="about-home-btn btm-20">
                                                    <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                        {{ csrf_field() }}

                                                        <div class="box-footer">
                                                         <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="about-home-btn btm-20">
                                                    <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $course->id, 'price' => $course->price, 'discount_price' => $course->discount_price ]) }}"
                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                        <input type="hidden" name="category_id"  value="{{$course->category->id}}" />

                                                        <div class="box-footer">
                                                         <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif

                                        @endif


                                    @endif
                                @else
                                    <div class="about-home-btn btm-20">
                                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                    </div>
                                @endif
                            @else
                                <div class="about-home-rate">
                                    <ul>
                                        <li>{{ __('frontstaticword.Free') }}</li>
                                    </ul>
                                </div>
                                @if(Auth::check())
                                    @if(Auth::User()->role == "admin")
                                        <div class="about-home-btn btm-20">
                                            <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                    @else
                                        @php
                                            $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                        @endphp
                                        @if($enroll == NULL)
                                            <div class="about-home-btn btm-20">
                                                <a href="{{url('enroll/show',$course->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                            </div>
                                        @else
                                            <div class="about-home-btn btm-20">
                                                <a href="{{ route('course.content',['id' => $course->id, 'slug' => $course->slug ]) }}" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.GoToCourse') }}</a>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    <div class="about-home-btn btm-20">
                                        <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                    </div>
                                @endif
                            @endif



                            @if(isset($course->refund_policy_id))
                                <div class="refund-policy-block">
                                    @if(isset($course->policy))
                                        @php
                                        
                                            $days = $course->policy->days;

                                            $detail = $course->policy->detail;
                                        @endphp
                                        <div class="money-back-days">{{ $days }}-Day Money-Back Guarantee
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" data-html="true" title="{!! $detail !!}"><i class="fas fa-info-circle"></i></button>
                                        </div>
                                    @endif

                                </div>
                            @endif


                            <div class="about-home-includes-list btm-40">
                                <ul class="btm-40">
                                    @if($courseinclude->isNotEmpty())
                                        <li><span>{{ __('frontstaticword.CourseIncludes') }}</span></li>
                                        @foreach($course->include as $in)
                                            @if($in->status ==1)
                                                <li><i class="fa {{ $in->icon }}"></i>{{ str_limit($in->detail, $limit = 50, $end = '...') }}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                               
                                @if($course['course_tags'] == !NULL)
                                <span>{{ __('Tags') }}:</span>
                                <br>
                                @php
                                    $tags = $course['course_tags'];
                                @endphp 
                                @foreach($tags as $tag)
                                    <span class="badge badge-secondary"><i class="fa fa-tags"></i> {{ $tag }}</span>
                                @endforeach</p>
                                @endif
                            </div>
                            <hr>

                            <div class="about-home-share text-center">
                                <a href="#" data-toggle="modal" data-target="#myModalshare" title="share"><i class="fa fa-share rgt-10"></i>{{ __('frontstaticword.share') }}</a>
                            </div>

                            <!--Model start-->
                            <div class="modal fade" style="z-index: 999999999999999999;" id="myModalshare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">

                                      <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.Sharethiscourse') }}</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="box box-primary">
                                      <div class="panel panel-sum">
                                        <div class="modal-body">

                                            @php
                                            $url=  URL::current();
                                            @endphp

                                            <!-- The text field -->

                                            <div class="nav-search">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="myInput"  value="{{ $url }}">
                                                </div>
                                                <button onclick="myFunction()" class="btn btn-primary">{{ __('frontstaticword.CopyText') }}</button>
                                            </div>

                                            <div class="social-icon">

                                            @php

                                            echo Share::currentPage('', [], '<div class="row">')
                                                ->facebook()
                                                ->twitter()
                                                ->linkedin('Extra linkedin summary can be passed here')
                                                ->whatsapp()
                                                ->telegram();

                                            @endphp

                                            </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!--Model close -->
                        </div>


                        <div class="container-fluid" id="adsense">
                            <!-- google adsense code -->
                            <?php
                              if (isset($ad)) {
                               if ($ad->isdetail==1 && $ad->status==1) {
                                  $code = $ad->code;
                                  echo html_entity_decode($code);
                               }
                              }
                            ?>
                        </div>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>
</section>
<!-- course header end -->
<!-- course detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($whatlearns->isNotEmpty())
                    <div class="product-learn-block">
                        <h3 class="product-learn-heading">{{ __('frontstaticword.Whatlearn') }}</h2>
                        <div class="row">
                            @foreach($course['whatlearns'] as $wl)
                            @if($wl->status ==1)
                            <div class="col-lg-6 col-md-6">
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i class="flaticon-tick-inside-circle"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                @endif


                @if($coursechapters->isNotEmpty())
                <div class="course-content-block btm-30 top-20">

                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <h3>{{ __('frontstaticword.CourseContent') }}</h3>
                        </div>
                        <!--
                        FSMS commenting below div in order to show course length correctly.  
                        <div class="col-lg-4 col-6">
                            <div class="chapter-total-time">
                                @php
                                $classtwo =  App\CourseClass::where('course_id', $course->id)->sum("duration");

                                echo $duration_round2 = round($classtwo,2);
                                @endphp
                                {{ __('frontstaticword.min') }}
                            </div>
                        </div>
                        -->
                    </div>
                    <!-- FSMS -->
                    <div class="row" style="padding-bottom:10px">
                        <div class="col-lg-9 col-6"  >
                           @php
                                // FSMS
                                function convertToHoursMins($time, $format = '%02d:%02d') {
                                    if ($time < 1) {
                                        return;
                                    }
                                    $hours =floor($time / 60);
                                    $minutes = ($time % 60);
                                    return sprintf($format, $hours, $minutes);
                                }
                                $classtwo =  App\CourseClass::where('course_id', $course->id)->sum("duration");

                                // echo $duration_round2 = round($classtwo,2);

                                $chapterCount = $coursechapters->count();
                                $classesCount = count(App\CourseClass::where('course_id', $course->id)->get());
                                $courseDuration = convertToHoursMins($classtwo, '%02dh %02dm total length');
                                // FSMS
                            @endphp

                            <small>{{ $chapterCount . " sections • " .$classesCount . " lectures • " . $courseDuration }}</small>

                        </div>

                        <div class="col-lg-3 col-6 col-xs-6 nopadding">
                            <button type="button" onclick="toggleAllSections()" class="btn btn-link courseToggle"><span style="color:#0384a3"><strong>{{ __('frontstaticword.Expandallsections') }}</strong></span></button>
                            <button type="button" onclick="toggleAllSections()" class="btn btn-link courseToggle" style="display:none"><span style="color:#0384a3"><strong>{{ __('frontstaticword.Collapseallsections') }}</strong></span></button>
                        </div>
                    </div>
                    <!-- FSMS -->

                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">
                                @foreach($coursechapters as $chapter)
                                @if($chapter->status == 1 and $chapter->count() > 0 )

                                <div class="card">
                                    <div class="card-header" id="headingTwo{{ $chapter->id }}">
                                        <div class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo{{ $chapter->id }}" aria-expanded="false" aria-controls="collapseTwo">

                                                <div class="row">
                                                <div class="col-lg-8 col-6">
                                                    {{ $chapter['chapter_name'] }}
                                                    
                                                    @if($course->involvement_request == 1)
                                                        @php
                                                        $fullname = $chapter->user->fname . ' ' . $chapter->user->lname;
                                                        $fullname = preg_replace('/\s+/', '', $fullname);
                                                        @endphp
                                                        @if($chapter->user_id != NULL)
                                                        <a href="{{ route('instructor.profile', ['id' => $chapter->user->id, 'name' => $fullname] )  }}">- {{ __('frontstaticword.by') }} {{$chapter->user['fname']}} </a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="text-right">
                                                        @php
                                                            $classone = App\CourseClass::where('coursechapter_id', $chapter->id)->orderBy('position','ASC')->get();
                                                            if(count($classone)>0){

                                                                echo count($classone);
                                                            }
                                                            else{

                                                                echo "0";
                                                            }
                                                        @endphp
                                                        {{ __('frontstaticword.Classes') }}
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <div class="chapter-total-time">
                                                        @php
                                                        $classtwo =  App\CourseClass::where('coursechapter_id', $chapter->id)->sum("duration");

                                                        echo $duration_round = round($classtwo,2);
                                                        @endphp
                                                        {{ __('frontstaticword.min') }}
                                                    </div>
                                                </div>

                                            </div>

                                            </button>
                                        </div>

                                    </div>
                                    <!--
                                    FSMS commenting below line in order to collapse all chapters by default.  
                                       <div id="collapseTwo{{ $chapter->id }}" class="collapse {{ $loop->first ? "show" : "" }}" aria-labelledby="headingTwo" data-parent="#accordion">
                                       
                                     -->
                                    
                                    <div id="collapseTwo{{ $chapter->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

                                        <div class="card-body">
                                            <table class="table">
                                                <tbody>
                                                    @foreach($courseclass as $class)
                                                    @if($class->status == 1)
                                                    @if($class->coursechapter_id == $chapter->id)
                                                    <tr>
                                                        <th class="class-icon">
                                                        @if($class->type =='video' )
                                                        <a href="#" title="Course"><i class="fa fa-play-circle"></i></a>
                                                        @endif
                                                        @if($class->type =='audio' )
                                                        <a href="#" title="Course"><i class="fas fa-play"></i></a>
                                                        @endif
                                                        @if($class->type =='image' )
                                                        <a href="#" title="Course"><i class="fas fa-image"></i></a>
                                                        @endif
                                                        @if($class->type =='pdf' )
                                                        <a href="#" title="Course"><i class="fas fa-file-pdf"></i></a>
                                                        @endif
                                                        @if($class->type =='zip' )
                                                        <a href="#" title="Course"><i class="far fa-file-archive"></i></a>
                                                        @endif
                                                        </th>

                                                        <td>

                                                            <div class="koh-tab-content">
                                                              <div class="koh-tab-content-body">
                                                                <div class="koh-faq">
                                                                  <div class="koh-faq-question">

                                                                    <span class="koh-faq-question-span"> {{ $class['title'] }} </span>

                                                                    @if($class->date_time != NULL)
                                                                       <div class="live-class">Live at: {{ $class->date_time }}</div>
                                                                    @endif
                                                                    @if($class->detail != NULL)
                                                                        <i class="fa fa-sort-down" aria-hidden="true"></i>
                                                                    @endif
                                                                  </div>
                                                                  <div class="koh-faq-answer">
                                                                    {!! $class->detail !!}
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if($class->preview_url != NULL || $class->preview_video != NULL )

                                                            <a href="{{ route('lightbox',$class->id) }}" class="iframe" style="display: block;">{{ __('frontstaticword.preview') }}</a>

                                                            @endif

                                                        </td>

                                                        <td class="txt-rgt">
                                                        @if($class->type =='video')
                                                        {{ $class['duration'] }}{{ __('frontstaticword.min') }}
                                                        @else
                                                        {{ $class['size'] }}mb
                                                        @endif



                                                    </tr>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                @auth

                @php
                $user_enrolled = App\Order::where('course_id', $course->id)->where('user_id', Auth::user()->id) ->first();

                @endphp


                @if( $user_enrolled != NULL || Auth::user()->role == 'admin' )

                @if( ! $bigblue->isEmpty() )

                <div class="course-content-block btm-30">
                    <h5>{{ __('frontstaticword.BigBlueMeetings') }}</h5>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">

                            @foreach($bigblue as $bbl)
                            @if($bbl->is_ended != 1)

                            <div class="card">
                                <div class="card-header" id="headingThree{{ $bbl->id }}">
                                    <div class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree{{ $bbl->id }}" aria-expanded="false" aria-controls="collapseThree">

                                            {{ $bbl['meetingname'] }}

                                        </button>
                                    </div>

                                </div>
                                <div id="collapseThree{{ $bbl->id }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">

                                <div class="card-body">
                                    <table class="table">
                                    <tbody>
                                        <td>
                                          <ul>
                                            <li><a href="#" title="about">{{ __('frontstaticword.Created') }}: @if(isset($bbl->user)) {{ $bbl->user['fname'] }} {{ $bbl->user['lname'] }} @endif</a></li>
                                            <li><a href="#" title="about">{{ __('frontstaticword.StartAt') }}: {{ date('d-m-Y | h:i:s A',strtotime($bbl['start_time'])) }}</a></li>
                                            <li class="comment more">
                                               {!! $bbl->detail !!}
                                            </li>

                                            <li>
                                                <a href="" data-toggle="modal" data-target="#myModalBBL" title="join" class="btn btn-light" title="course">{{ __('frontstaticword.JoinMeeting') }}</a>
                                            </li>

                                            <div class="modal fade" id="myModalBBL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">

                                                      <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.JoinMeeting') }}</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="box box-primary">
                                                      <div class="panel panel-sum">
                                                        <div class="modal-body">

                                                            <form action="{{ route('bbl.api.join') }}" method="POST">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <label>Meeting ID:</label>
                                                                    <input readonly="" type="text" name="meetingid" value="{{ $bbl['meetingid'] }}" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Your Name:</label>
                                                                    <input value="{{ old('name') }}" type="text" required="" name="name" placeholder="enter your name" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Meeting Password:</label>
                                                                    <input type="password" name="password" placeholder="enter meeting password" class="form-control" required="">
                                                                </div>

                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    {{ __('frontstaticword.JoinMeeting') }}
                                                                </button>

                                                            </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>

                                          </ul>
                                        </td>

                                    </tbody>
                                    </table>
                                </div>
                               </div>
                            </div>

                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                @endif

                @if( ! $meetings->isEmpty() )

                <div class="course-content-block btm-30">
                    <h5>{{ __('frontstaticword.ZoomMeetings') }}</h5>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">


                            @foreach($meetings as $meeting)

                            <div class="card">
                                <div class="card-header" id="headingFour{{ $meeting->id }}">
                                    <div class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour{{ $meeting->id }}" aria-expanded="false" aria-controls="collapseFour">

                                            {{ $meeting['meeting_title'] }}

                                        </button>
                                    </div>

                                </div>
                                <div id="collapseFour{{ $meeting->id }}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">

                                <div class="card-body">
                                    <table class="table">
                                    <tbody>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="#" title="about">{{ __('frontstaticword.Created') }}: @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif </a>

                                                </li>
                                                <li>
                                                   <p>Meeting Owner: {{ $meeting->owner_id }}</p>
                                                </li>
                                                <li>
                                                   <p class="btm-10"><a herf="#">{{ __('frontstaticword.StartAt') }}: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                                </li>
                                                <li>
                                                     <a href="{{ $meeting->zoom_url }}" target="_blank" class="btn btn-light">{{ __('frontstaticword.JoinMeeting') }}</a>
                                                </li>
                                            </ul>

                                        </td>
                                    </tbody>
                                    </table>
                                </div>
                               </div>
                            </div>
                            @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @endif


                {{-- googlemeeting start --}}
                @if($gsetting->googlemeet_enable == '1')
                @if( ! $googlemeetmeetings->isEmpty() )

                <div class="course-content-block btm-30">
                    <h5> Google Meetings</h5>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">


                            @foreach($googlemeetmeetings as $meeting)

                            <div class="card">
                                <div class="card-header" id="headingFour{{ $meeting->id }}">
                                    <div class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour{{ $meeting->id }}" aria-expanded="false" aria-controls="collapseFour">

                                            {{ $meeting['meeting_title'] }}

                                        </button>
                                    </div>

                                </div>
                                <div id="collapseFour{{ $meeting->id }}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">

                                <div class="card-body">
                                    <table class="table">
                                    <tbody>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="#" title="about">{{ __('frontstaticword.Created') }}: @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif </a>

                                                </li>
                                                <li>
                                                   <p>Meeting Owner: {{ $meeting->owner_id }}</p>
                                                </li>
                                                <li>
                                                   <p class="btm-10"><a herf="#">{{ __('frontstaticword.StartAt') }}: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                                </li>
                                                <li>
                                                     <a href="{{ $meeting->meet_url }}" target="_blank" class="btn btn-light">{{ __('frontstaticword.JoinMeeting') }}</a>
                                                </li>
                                            </ul>

                                        </td>
                                    </tbody>
                                    </table>
                                </div>
                               </div>
                            </div>
                            @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                {{-- googlemeeting end --}}

                {{-- jitsi start --}}
                @if($gsetting->jitsimeet_enable == '1')
                @if( ! $jitsimeetings->isEmpty() )
                <div class="course-content-block btm-30">
                    <h5> Jitsi Meetings</h5>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">


                            @foreach($jitsimeetings as $meeting)

                            <div class="card">
                                <div class="card-header" id="headingFour{{ $meeting->id }}">
                                    <div class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour{{ $meeting->id }}" aria-expanded="false" aria-controls="collapseFour">

                                            {{ $meeting['meeting_title'] }}

                                        </button>
                                    </div>

                                </div>
                                <div id="collapseFour{{ $meeting->id }}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">

                                <div class="card-body">
                                    <table class="table">
                                    <tbody>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="#" title="about">{{ __('frontstaticword.Created') }}: @if(isset($meeting->user)) {{ $meeting->user['fname'] }} {{ $meeting->user['lname'] }} @endif </a>

                                                </li>
                                                <li>
                                                   <p>Meeting Owner: {{ $meeting->owner_id }}</p>
                                                </li>
                                                <li>
                                                   <p class="btm-10"><a herf="#">{{ __('frontstaticword.StartAt') }}: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                                </li>
                                                <li>
                                                     <a href="{{url('meetup-conferencing/'.$meeting->meeting_id) }}" target="_blank" class="btn btn-light">{{ __('frontstaticword.JoinMeeting') }}</a>
                                                </li>
                                            </ul>

                                        </td>
                                    </tbody>
                                    </table>
                                </div>
                               </div>
                            </div>
                            @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @endif
                {{-- jitsi end --}}


                @endif

                @endauth




                <div class="requirements">
                    <h3>{{ __('frontstaticword.Requirements') }}</h3>
                    <ul>
                        <li class="comment more">
                            @if(strlen($course->requirement) > 400)
                            {{substr($course->requirement,0,400)}}
                            <span class="read-more-show hide_content"><br>+&nbsp;See More</span>
                            <span class="read-more-content"> {{substr($course->requirement,400,strlen($course->requirement))}}
                            <span class="read-more-hide hide_content"><br>-&nbsp;See Less</span> </span>
                            @else
                            {{$course->requirement}}
                            @endif
                        </li>

                    </ul>
                </div>
                <div class="description-block btm-30">
                    <h3>{{ __('frontstaticword.Description') }}</h3>

                    <p>{!! $course->detail !!}</p>

                </div>


               @php
                    $alreadyrated = App\ReviewRating::where('course_id', $course->id)->limit(1)->first();
                @endphp
                @if($alreadyrated == !NULL)
                @if($alreadyrated->featured == 1)
                    <div class="featured-review btm-40">
                        <h3>{{ __('frontstaticword.FeaturedReview') }}</h3>
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                        @if(isset($alreadyrated))
                        
                        @foreach($coursereviews as $rating)
                        @if($rating->review == !null && $rating->featured == 1)
                        <div class="featured-review-block">
                            <div class="row">
                                <div class="col-lg-1 col-4">
                                    <div class="featured-review-img">
                                        <div class="review-img text-white">

                                        {{ str_limit($rating->user->fname, $limit = 1, $end = '') }}{{ str_limit($rating->user->lname, $limit = 1, $end = '') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-8">
                                    <div class="featured-review-img-dtl">
                                        <div class="review-img-name"><span> @if(isset($rating->user)) {{ $rating->user['fname'] }} {{ $rating->user['lname'] }} @endif</span></div>
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="year btm-20">{{ date('jS F Y', strtotime($rating['created_at'])) }}</div>
                                    </div>
                                </div>
                            </div>
                            <p class="btm-20">{{ $rating['review'] }}</p>

                            @auth
                            <div class="review">{{ __('frontstaticword.helpful') }}?
                                @php
                                $help = App\ReviewHelpful::where('user_id', Auth::User()->id)->where('review_id', $rating->id)->first();
                                @endphp

                                
                              
                                @if(isset($help['review_like']) == '1')
                                    <div class="helpful">
                                       
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_like"  value="0" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 "><i class="fa fa-check"></i> {{ __('frontstaticword.Yes') }}</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_like"  value="1" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 ">{{ __('frontstaticword.Yes') }}</button>
                                        </form>
                                    </div>
                                @endif



                                @if(isset($help['review_dislike']) == '1')
                                    <div class="helpful">
                                       

                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_dislike"  value="0" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 "><i class="fa fa-check"></i>{{ __('frontstaticword.No') }}</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_dislike"  value="1" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 ">{{ __('frontstaticword.No') }}</button>
                                        </form>
                                    </div>
                                @endif

                                

                                <a href="#" data-toggle="modal" data-target="#myModalreport"  title="report">{{ __('frontstaticword.Report') }}</a>

                            </div>

                            @endauth
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                @endif
                @endif



                

                <div class="students-bought btm-30">
                    <h3>{{ __('frontstaticword.RecentCourses') }}</h3>
                    @php
                        $items = App\Course::orderBy('created_at','desc')->limit(5)->get()
                    @endphp
                    @foreach($items as $item)
                    @if($item->status == 1)
                    <div class="course-bought-block">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-5">
                                        <div class="course-bought-img">
                                            @if($item->preview_image !== NULL && $item->preview_image !== '')
                                                <a href="{{ route('user.course.show',['id' => $item->id, 'slug' => $item->slug ]) }}"><img src="{{ asset('images/course/'.$item['preview_image']) }}" class="img-fluid" alt="blog"></a>
                                            @else
                                                <a href="{{ route('user.course.show',['id' => $item->id, 'slug' => $item->slug ]) }}"><img src="{{ Avatar::create($item->title)->toBase64() }}" class="img-fluid" alt="blog"></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-8 col-7">
                                        <div class="course-name"><a href="{{ route('user.course.show',['id' => $item->id, 'slug' => $item->slug ]) }}">{{ str_limit($item['title'], $limit = 35, $end = '...') }}</a></div>
                                        <div class="course-update">{{ __('frontstaticword.LastUpdated') }} {{ date('jS F Y', strtotime($item['updated_at'])) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-4">
                                <div class="course-user">
                                    <ul>
                                        <li><i class="fa fa-user"></i></li>
                                        <li>{{ $item->order->count() }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-4">
                                @if($item->type==1)

                                    @if($item->discount_price == !NULL)
                                        <div class="course-currency txt-rgt">
                                            <ul>
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li class="rate"><i class="{{ $currency['icon'] }}"></i>{{ $item->discount_price }}</li>
                                                    <li class="rate"><s><i class="{{ $currency['icon'] }}"></i>{{ $item['price'] }}</s></li>
                                                @else
                                                    <li class="rate">{{ $item->discount_price }}<i class="{{ $currency['icon'] }}"></i></li>
                                                    <li class="rate"><s>{{ $item['price'] }}<i class="{{ $currency['icon'] }}"></i></s></li>
                                                @endif

                                            </ul>
                                        </div>
                                    @else
                                        <div class="course-currency txt-rgt">
                                            <ul>
                                                @if($gsetting['currency_swipe'] == 1)
                                                <li><i class="{{ $currency['icon'] }}"></i>{{ $item['price'] }}</li>
                                                @else
                                                <li>{{ $item['price'] }}<i class="{{ $currency['icon'] }}"></i></li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                @else
                                    <div class="course-currency txt-rgt">
                                        <ul>
                                            <li>{{ __('frontstaticword.Free') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-1 col-md-2 col-4">
                                <div class="course-rate txt-rgt">
                                    <ul>
                                        <li>
                                        @if(Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $item->id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $item->id) }}" data-parsley-validate
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$item->id}}" />

                                                    <button class="wishlisht-btn heart" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $item->id) }}" data-parsley-validate
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$item->id}}" />

                                                    <button class="wishlisht-btn heart"  title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                        @else
                                            <div class="heart"><a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a></div>
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="about-instructor-block">
                    <h3>{{ __('frontstaticword.AboutInstructor') }}</h3>
                    @php
                    $fullname = isset($course->user['fname']) . ' ' . isset($course->user['lname']);
                    $fullname = preg_replace('/\s+/', '', $fullname);
                    @endphp

                    <div class="about-instructor btm-40">
                        <div class="row">
                            <div class="col-lg-2 col-5">
                                <div class="instructor-img btm-30">
                                    
                                    @if($course->user->user_img != null || $course->user->user_img !='')
                                      <a href="{{ route('instructor.profile', ['id' => $course->user->id, 'name' => $fullname] ) }}" title="instructor"><img src="{{ asset('images/user_img/'.$course->user['user_img']) }}" class="img-fluid" alt="instructor"></a>
                                    @else
                                      <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="instructor">
                                    @endif
                                    {{-- <ul>
                                        <li><span>10</span> Courses</li>
                                        <li><span>5</span> Reviews</li>
                                    </ul> --}}
                                </div>
                            </div>
                            <div class="col-lg-10 col-7">
                                <div class="instructor-block">
                                    <div class="instructor-name btm-10"><a href="{{ route('instructor.profile', ['id' => $course->user->id, 'name' => $fullname] ) }}" title="instructor-name">@if(isset($course->user)) {{ $course->user['fname'] }} {{ $course->user['lname'] }} @endif</a></div>
                                    <div class="instructor-post btm-5">{{ __('frontstaticword.AboutInstructor') }}</div>
                                    {{-- <div class="instructor-block-ratings">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div> --}}
                                    <p>{!! $course->user['detail'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(! $reviews->isEmpty())
                <div class="student-feedback btm-40">
                    <h3 class="student-feedback-heading">{{ __('frontstaticword.StudentFeedback') }}</h3>
                    <div class="student-feedback-block">

                        <div class="rating">
                            <?php
                                $learn = 0;
                                $price = 0;
                                $value = 0;
                                $sub_total = 0;
                                $count =  count($reviews);
                                $onlyrev = array();

                                $reviewcount = App\ReviewRating::where('course_id',1)->where('status',"1")->WhereNotNull('review')->get();

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

                            <div class="rating-num">{{ round($overallrating, 1) }}</div>

                            <?php
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $sub_total = 0;
                            $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                            ?>
                            @if(!empty($reviews[0]))
                                <?php
                                $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                foreach($reviews as $review){
                                    $learn = $review->learn*5;
                                    $price = $review->price*5;
                                    $value = $review->value*5;
                                    $sub_total = $sub_total + $learn + $price + $value;
                                }

                                $count = ($count*3) * 5;
                                $rat = $sub_total/$count;
                                $ratings_var = ($rat*100)/5;
                                ?>
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @else
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @endif
                            <div class="rating-users">{{ __('frontstaticword.CourseRating') }}</div>
                        </div>
                        <div class="histo">
                            <div class="three histo-rate">
                                <span class="histo-star">
                                    <?php
                                    $learn = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?>
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $learn = $review->learn*5;
                                            $total = $total + $learn;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>

                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>

                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-three" style=" width:{{ $ratings_var }}%;" class="bar bar-clr bar-radius">&nbsp;</span>
                                </span>
                            </div>
                            <div class="two histo-rate">
                                <span class="histo-star">
                                    <?php
                                    $price = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?>
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $price = $review->price*5;
                                            $total = $total + $price;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>

                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>

                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-two" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span>
                                </span>
                            </div>
                            <div class="one histo-rate">
                                <span class="histo-star">
                                    <?php
                                    $value = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?>
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $value = $review->value*5;
                                            $total = $total + $value;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>

                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>

                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-one" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endif

                <div class="learning-review btm-40">

                    @auth
                    @php
                        $orders = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                    @endphp
                    @if(!empty($orders))
                        <div class="review-block">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h3 class="top-20">{{ __('frontstaticword.Reviews') }}</h3>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <form id="demo-form2" method="post" action="{{route('course.rating',$course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}
                                        <div class="review-table top-20">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col"></th>
                                                  <th scope="col">1 {{ __('frontstaticword.Star') }}</th>
                                                  <th scope="col">2 {{ __('frontstaticword.Star') }}</th>
                                                  <th scope="col">3 {{ __('frontstaticword.Star') }}</th>
                                                  <th scope="col">4 {{ __('frontstaticword.Star') }}</th>
                                                  <th scope="col">5 {{ __('frontstaticword.Star') }}</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th scope="row">{{ __('frontstaticword.Learn') }}</th>
                                                  <td><input type="radio" name="learn" value="1" id="option1" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="2" id="option2" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="3" id="option3" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="4" id="option4" autocomplete="off"></td>
                                                  <td><input type="radio" name="learn" value="5" id="option5" autocomplete="off"></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">{{ __('frontstaticword.Price') }}</th>
                                                  <td><input type="radio" name="price" value="1" id="option6" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="2" id="option7" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="3" id="option8" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="4" id="option9" autocomplete="off"></td>
                                                  <td><input type="radio" name="price" value="5" id="option10" autocomplete="off"></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">{{ __('frontstaticword.Value') }}</th>
                                                  <td><input type="radio" name="value" value="1" id="option11" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="2" id="option12" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="3" id="option13" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="4" id="option14" autocomplete="off"></td>
                                                  <td><input type="radio" name="value" value="5" id="option15" autocomplete="off"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div class="review-text btm-30">
                                                <label for="review">{{ __('frontstaticword.Writereview') }}:</label>
                                                <textarea name="review" rows="4" class="form-control" placeholder=""></textarea>
                                            </div>
                                            <div class="review-rating-btn text-right">
                                                <button type="submit" class="btn btn-success" title="Review">{{ __('frontstaticword.Submit') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>

                    @endif
                    @endauth


                    @php
                        $alreadyrated = App\ReviewRating::where('course_id', $course->id)->first();
                    @endphp
                    @if($alreadyrated == !NULL)

                    <div class="review-dtl">
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                        @if(isset($alreadyrated))
                        @foreach($course->review as $rating)
                        @if($rating->review == !null && $rating->status == 1 && $rating->approved == 1)
                        <div class="row btm-20">
                            <div class="col-lg-4">
                                <div class="review-img text-white">
                                    {{ str_limit($rating->user->fname, $limit = 1, $end = '') }}{{ str_limit($rating->user->lname, $limit = 1, $end = '') }}
                                </div>
                                <div class="review-img-block">
                                    <div class="review-month">{{ date('d-m-Y', strtotime($rating['created_at'])) }}</div>
                                    <div class="review-name">{{ $rating->user['fname'] }} {{ $rating->user['lname'] }}</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="review-rating">
                                    <div class="pull-left-review">
                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>{{ $rating['review'] }}<p>
                                    </div>

                                    @auth

                                    <div class="review">{{ __('frontstaticword.helpful') }}?
                                @php
                                $help = App\ReviewHelpful::where('user_id', Auth::User()->id)->where('review_id', $rating->id)->first();
                                @endphp

                                
                              
                                @if(isset($help['review_like']) == '1')
                                    <div class="helpful">
                                       
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_like"  value="0" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 "><i class="fa fa-check"></i> {{ __('frontstaticword.Yes') }}</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_like"  value="1" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 ">{{ __('frontstaticword.Yes') }}</button>
                                        </form>
                                    </div>
                                @endif



                                @if(isset($help['review_dislike']) == '1')
                                    <div class="helpful">
                                       

                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_dislike"  value="0" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 "><i class="fa fa-check"></i>{{ __('frontstaticword.No') }}</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="helpful">
                                        <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                        <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                        <input type="hidden" name="helpful"  value="yes" />
                                        <input type="hidden" name="review_dislike"  value="1" />
                                        
                                          <button type="submit" class="btn btn-link lft-7 rgt-10 ">{{ __('frontstaticword.No') }}</button>
                                        </form>
                                    </div>
                                @endif

                            
                                        {{-- report --}}
                                        <a href="#" data-toggle="modal" data-target="#myModalreport"  title="report">{{ __('frontstaticword.Report') }}</a>
                                        <div class="modal fade" id="myModalreport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.Report') }}</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="box box-primary">
                                                  <div class="panel panel-sum">
                                                    <div class="modal-body">
                                                        @php
                                                            $courses = App\Course::first();
                                                        @endphp
                                                        <form id="demo-form2" method="post" action="{{ route('report.review', $course->id) }}"              data-parsley-validate class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title">{{ __('frontstaticword.Title') }}:<sup class="redstar">*</sup></label>
                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">{{ __('frontstaticword.Email') }}:<sup class="redstar">*</sup></label>
                                                                    <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::User()->email }}" required>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="detail">{{ __('frontstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                                                                    <textarea name="detail" rows="4"  class="form-control" placeholder=""></textarea>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="box-footer">
                                                             <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('frontstaticword.Submit') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endauth


                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @endif

                </div>


                @if(!$relatedcourse->isEmpty())
                <div class="more-courses btm-30">
                    <h2 class="more-courses-heading">{{ __('frontstaticword.RelatedCourses') }}</h2>
                    <div class="row">
                        @foreach($relatedcourse as $rel)
                        @if($rel->courses->status == 1)
                        <div class="col-lg-6 col-sm-6">
                            <div class="together-img">
                                <div class="student-view-block">
                                    <div class="view-block">
                                        <div class="view-img">
                                            @if($rel->courses['preview_image'] !== NULL && $rel->courses['preview_image'] !== '')
                                                <a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}"><img src="{{ asset('images/course/'.$rel->courses->preview_image) }}" alt="student">
                                                </a>
                                            @else
                                                <a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}"><img src="{{ Avatar::create($rel->courses->title)->toBase64() }}" alt="student">
                                                </a>
                                            @endif
                                        </div>
                                        {{-- Add to wishlisht --}}
                                        @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $rel->course_id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $rel->course_id) }}" data-parsley-validate
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $rel->course_id) }}" data-parsley-validate
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart"  title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                        @else
                                            <div class="heart">
                                                <a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a>
                                            </div>
                                        @endif
                                        {{-- Add to wishlisht end--}}

                                        <div class="view-dtl">
                                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}">{{ str_limit($rel->courses['title'], $limit = 30, $end = '...') }}</a></div>
                                            <p class="btm-10"><a herf="#">by  {{ $rel->courses->user['fname'] }}</a></p>
                                            <div class="rating">
                                                <ul>
                                                    <li>
                                                    <?php
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $sub_total = 0;
                                                    $reviews = App\ReviewRating::where('course_id',$rel->course_id)->where('status','1')->get();
                                                    ?>
                                                    @if(!empty($reviews[0]))
                                                    <?php
                                                    $count =  App\ReviewRating::where('course_id',$rel->course_id)->count();

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
                                                        <div class="pull-left no-rating">
                                                            {{ __('frontstaticword.NoRating') }}
                                                        </div>
                                                    @endif
                                                    </li>

                                                    <?php
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $count =  count($reviews);
                                                    $onlyrev = array();

                                                    $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

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
                                                        $reviewsrating = App\ReviewRating::where('course_id', $rel->course_id)->first();
                                                    @endphp
                                                    @if(!empty($reviewsrating))
                                                    <li>
                                                        <b>({{ round($overallrating, 1) }})</b>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @if( $rel->courses->type == 1)

                                                @if($rel->courses->discount_price == !NULL)
                                                    <div class="rate text-right">
                                                        <ul>
                                                            @if($gsetting['currency_swipe'] == 1)
                                                                <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $rel->courses['discount_price'] }}</b></a></li>&nbsp;
                                                                <li><a><b><strike><i class="{{ $currency['icon'] }}"></i>{{ $rel->courses['price'] }}</strike></b></a></li>
                                                            @else
                                                                <li><a><b>{{ $rel->courses['discount_price'] }}<i class="{{ $currency['icon'] }}"></i></b></a></li>&nbsp;
                                                                <li><a><b><strike>{{ $rel->courses['price'] }}<i class="{{ $currency['icon'] }}"></i></strike></b></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="rate text-right">
                                                        <ul>
                                                            @if($gsetting['currency_swipe'] == 1)
                                                                <li><a><b><i class="{{ $currency['icon'] }}"></i>{{ $rel->courses['price'] }}</b></a></li>
                                                            @else
                                                                <li><a><b>{{ $rel->courses['price'] }}<i class="{{ $currency['icon'] }}"></i></b></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
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
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                @if(Auth::check())
                    <div class="report-abuse text-center btm-20">
                        <a href="#" data-toggle="modal" data-target="#myModalCourse" title="report"><i class="fa fa-flag rgt-10"></i>{{ __('frontstaticword.Report') }}</a>
                    </div>
                @else
                    <div class="report-abuse text-center btm-20">
                        <a href="{{ route('login') }}" title="report"><i class="fa fa-flag rgt-10"></i>{{ __('frontstaticword.Report') }}</a>
                    </div>
                @endif

                <!--Model start-->
                @auth
                <div class="modal fade" id="myModalCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.Report') }}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="box box-primary">
                          <div class="panel panel-sum">
                            <div class="modal-body">

                            <form id="demo-form2" method="post" action="{{ route('course.report', $course->id) }}"
                                data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">{{ __('frontstaticword.Title') }}:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('frontstaticword.Email') }}:<sup class="redstar">*</sup></label>
                                        <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail">{{ __('frontstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                                        <textarea name="detail" rows="4"  class="form-control" placeholder="Enter Detail" required></textarea>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('frontstaticword.Submit') }}</button>
                                </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endauth
                <!--Model close -->
            </div>

        </div>
    </div>
</section>
<!-- course detail end -->
@endsection


@section('custom-script')


<script>
// Hide the extra content initially, using JS so that if JS is disabled, no problemo:
    $('.read-more-content').addClass('hide_content')
    $('.read-more-show, .read-more-hide').removeClass('hide_content')

    // Set up the toggle effect:
    $('.read-more-show').on('click', function(e) {
      $(this).next('.read-more-content').removeClass('hide_content');
      $(this).addClass('hide_content');
      e.preventDefault();
    });

    // Changes contributed by @diego-rzg
    $('.read-more-hide').on('click', function(e) {
      var p = $(this).parent('.read-more-content');
      p.addClass('hide_content');
      p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
      e.preventDefault();
    });
</script>

<script>
(function($) {
  "use strict";
  $(document).ready(function(){

    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});


    $("#click").click(function(){
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
})(jQuery);
</script>

<script>
    /* it seems javascript..*/
    var topLimit = $('#about-bar-fixed').offset().top;
    var topLimit = $('#bar-fixed').offset().top;
    $(window).scroll(function() {
      //console.log(topLimit <= $(window).scrollTop())
      if (topLimit <= $(window).scrollTop()) {
        $('#about-bar-fixed').addClass('stickIt')
        $('#bar-fixed').addClass('stickIt')
      } else {
        $('#about-bar-fixed').removeClass('stickIt')
        $('#bar-fixed').removeClass('stickIt')
      }
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(this).on("click", ".koh-faq-question", function() {
        $(this).parent().find(".koh-faq-answer").toggle();
        $(this).find(".fa").toggleClass('active');
    });
});
</script>

<script type="text/javascript">
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

}
// FSMS
function toggleAllSections() {
    $("div[id*='collapseTwo']").collapse('toggle');
    $(".courseToggle").toggle();
}
// FSMS
</script>
@endsection


<style type="text/css">
    .read-more-show{
      cursor:pointer;
      color: #0284A2;
    }
    .read-more-hide{
      cursor:pointer;
      color: #0284A2;
    }

    .hide_content{
      display: none;
    }
</style>
