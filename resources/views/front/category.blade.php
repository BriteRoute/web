@extends('theme.master')
@section('title', "$cats->title")

@section('content')
@include('admin.message')
<!-- categories-tab start-->
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
            @php
                $category = App\Categories::all();
            @endphp
            @foreach($category as $cat)
                @if($cat->status == 1)
                <div class="item categories-tab-dtl">
                    <a href="{{ route('category.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))]) }}" title="tab"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- categories-tab end-->
<!-- category-title start -->
<section id="business-home" class="business-home-main-block">
    <div class="container">
        <h1 class="">{{ $cats->title }}</h1>
    </div>
</section>  
<!-- category-title end -->
<!-- category-slider start -->
<section id="business-home-slider" class="business-home-slider-main-block">
    <div class="container">
        <div id="business-home-slider-two" class="business-home-slider owl-carousel">
            @foreach($courses as $course)
            @if($course->featured == 1 && $course->status == 1)
            <div class="item business-home-slider-block">
                <div class="row">
                    <div class="col-md-5">
                        <div class="business-home-slider-img">
                            @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img data-src="{{ asset('images/course/'.$course->preview_image) }}" class="img-fluid owl-lazy" alt="course"></a>
                            @else
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img data-src="{{ Avatar::create($course->title)->toBase64() }}" class="img-fluid owl-lazy" alt="course"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="categories-popularity-dtl">
                            <ul>
                                <li>{{ __('frontstaticword.FeaturedCourses') }}</li>
                                <li class="heart float-rgt">
                                    @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $course->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                                    <button class="wishlisht-btn heart-category" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $course->id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$course->id}}" />

                                                    <button class="wishlisht-btn heart" title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <div class="heart">
                                            <a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ str_limit($course->title, $limit=50)}}</a></div>
                            <div class="last-updated btm-10">{{ __('frontstaticword.LastUpdated') }} {{ date('jS F Y', strtotime($course->updated_at)) }}</div>
                            <ul>
                                @if($course['level_tags'] == !NULL)
                                <li class="best-seller best-seller-one rgt-5">{{ $course['level_tags'] }}</li>
                                @endif
                                <li class="rgt-5">
                                    @php
                                        $data = App\CourseClass::where('course_id', $course->id)->get();
                                        if(count($data)>0){

                                            echo count($data);
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp 
                                    {{ __('frontstaticword.Classes') }}
                                </li>
                                <li class="rgt-5">{{ __('frontstaticword.AllLevels') }}</li>
                                <li class="rgt-5">
                                    <ul class="rating">
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
                                                <div class="pull-left"><p>{{ __('frontstaticword.NoRating') }}</p></div>
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                                <!-- overall rating -->
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
                                    $reviewsrating = App\ReviewRating::where('course_id', $course->id)->first();
                                @endphp
                                @if(!$reviews->isEmpty())
                                <li class="rgt-5">
                                    <b>{{ round($overallrating, 1) }}</b>
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
                                    @endphp {{ __('frontstaticword.rating') }})
                                </li> 
                            </ul>
                            <p class="btm-20">{{ str_limit($course->short_detail, $limit = 70, $end='...') }}</p>
                            <div class="business-home-slider-btn btm-20">
                                <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}" type="button" class="btn btn-info">{{ __('frontstaticword.Explorecourse') }}</a>
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
<!-- category sliderslider end -->
<!-- sub categories start -->
@if(isset($subcat))
<section id="categories" class="categories-main-block categories-main-block-one">
    <div class="container">
        <h4 class="categories-heading">{{ __('frontstaticword.SubCategories') }}</h4>
        <div class="row">

            @foreach($subcat as $cat)
            @if($cat->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>
                        </a></li>
                        <li><a href="{{ route('subcategory.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))]) }}">{{ $cat->title }}</a></li>
                    </ul>
                </div>  
            </div>
            @endif
            @endforeach
           

        </div>
    </div>
</section>

@elseif(isset($childcat))
<section id="categories" class="categories-main-block categories-main-block-one">
    <div class="container">
        <h4 class="categories-heading">{{ __('frontstaticword.SubCategories') }}</h4>
        <div class="row">

            @foreach($childcat as $cat)
            @if($cat->status == 1)
            <div class="col-lg-3 col-sm-6">
                <div class="categories-block">
                    <ul>
                        <li><a href="#" title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>
                        </a></li>
                        <li><a href="{{ route('childcategory.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))]) }}">{{ $cat->title }}</a></li>
                    </ul>
                </div>  
            </div>
            @endif
            @endforeach

        </div>
    </div>
</section>

@else
<section id="categories" class="categories-main-block categories-main-block-one">
</section>

@endif

<!-- sub categories end -->

<!-- categories start -->
<section id="categories-popularity" class="categories-popularity-main-block category-filters">
    <div class="container">
        <h2 class="btm-40">{{ $cats->title }} {{ __('frontstaticword.Courses') }}</h2>

        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="filter-dropdown catalog-main-block">
                    <ul>

                        @if(isset($subcat))
                        
                        <li class="dropdown language-select dropdown-select-one">
                            <a href="#" data-toggle="dropdown" title="Duration" class="select">{{ __('frontstaticword.Sort') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-one">
                                <li>
                                    <ul>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'a-z' ]) }}" title="A-Z">A-Z {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'z-a' ]) }}" title="Z-A">Z-A {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'newest' ]) }}" title="Newest">{{ __('frontstaticword.Newest') }} </a></li>
                                        <br>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'featured' ]) }}" title="Featured">{{ __('frontstaticword.Featured') }}</a></li>
                                        
                                        <br>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'l-h' ]) }}" title="Featured"> {{ __('frontstaticword.LowtoHigh') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'h-l' ]) }}" title="Featured"> {{ __('frontstaticword.HightoLow') }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown language-select dropdown-select rgt-15 limit-dropdown">
                            <a href="#" data-toggle="dropdown" title="Ratings" class="select">{{ __('frontstaticword.Limit') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul>
                                       
                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '10' ]) }}" title="Highest Rated">10</a></li>
                                        <br>

                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '30' ]) }}" title="Highest Rated">30</a></li>
                                        <br>

                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '50' ]) }}" title="Highest Rated">50</a></li>
                                        <br>

                                        <li><a href="{{ route('category.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '100' ]) }}" title="Highest Rated">100</a></li>
                                        <br>
                                        
                                       
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>

                        @elseif(isset($childcat))


                        <li class="dropdown language-select dropdown-select-one">
                            <a href="#" data-toggle="dropdown" title="Duration" class="select">{{ __('frontstaticword.Sort') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-one">
                                <li>
                                    <ul>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'a-z' ]) }}" title="A-Z">A-Z  {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'z-a' ]) }}" title="Z-A">Z-A {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'newest' ]) }}" title="Newest"> {{ __('frontstaticword.Newest') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' =>str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'featured' ]) }}" title="Featured">{{ __('frontstaticword.Featured') }}</a></li>

                                        <br>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'l-h' ]) }}" title="Featured">{{ __('frontstaticword.LowtoHigh') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'h-l' ]) }}" title="Featured">{{ __('frontstaticword.HightoLow') }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li class="dropdown language-select dropdown-select rgt-15 limit-dropdown">
                            <a href="#" data-toggle="dropdown" title="Ratings" class="select">{{ __('frontstaticword.Limit') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul>
                                       
                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '10' ]) }}" title="Highest Rated">10</a></li>
                                        <br>

                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '30' ]) }}" title="Highest Rated">30</a></li>
                                        <br>

                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '50' ]) }}" title="Highest Rated">50</a></li>
                                        <br>

                                        <li><a href="{{ route('subcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '100' ]) }}" title="Highest Rated">100</a></li>
                                        <br>
                                        
                                       
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>

                        @else


                        <li class="dropdown language-select dropdown-select-one">
                            <a href="#" data-toggle="dropdown" title="Duration" class="select">{{ __('frontstaticword.Sort') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-one">
                                <li>
                                    <ul>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'a-z' ]) }}" title="A-Z">A-Z {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'z-a' ]) }}" title="Z-A">Z-A {{ __('frontstaticword.Sort') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'newest' ]) }}" title="Newest"> {{ __('frontstaticword.Newest') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'featured' ]) }}" title="Featured">{{ __('frontstaticword.Featured') }}</a></li>

                                        <br>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'l-h' ]) }}" title="Featured">{{ __('frontstaticword.LowtoHigh') }}</a></li>
                                        <br>
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'sortby' => 'h-l' ]) }}" title="Featured">{{ __('frontstaticword.HightoLow') }}</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li class="dropdown language-select dropdown-select rgt-15 limit-dropdown">
                            <a href="#" data-toggle="dropdown" title="Ratings" class="select">{{ __('frontstaticword.Limit') }}<i class="fa fa-chevron-down lft-7"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul>
                                       
                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '10' ]) }}" title="Highest Rated">10</a></li>
                                        <br>

                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '30' ]) }}" title="Highest Rated">30</a></li>
                                        <br>

                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '50' ]) }}" title="Highest Rated">50</a></li>
                                        <br>

                                        <li><a href="{{ route('childcategory.page',['id' => $cats->id, 'category' => str_slug(str_replace('-','&',$cats->slug)), 'limit' => '100' ]) }}" title="Highest Rated">100</a></li>
                                        <br>
                                        
                                       
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>




                        @endif




                        
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 ">

                @php
                    $course_count = App\Course::count();
                @endphp

                <div class="text-right">
                    Showing result {{ $filter_count }} of {{ $course_count }}
                </div>

            </div>

        </div>



        <div class="row">

            <div class="col-md-3 col-sm-6">
                
                <div id="accordion">

                    <div class="card">
                        <div class="card-header" data-toggle="collapse" href="#collapseOne" data-closetxt="Stäng block" data-opentxt="Visa innehåll">
                        <a class="card-title">
                          {{ __('frontstaticword.Categories') }}
                        </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="">
                        <div class="card-body">
                            <div class="wrapper-two center-block">
                                @php
                                 $categories = App\Categories::orderBy('position','ASC')->get();
                                @endphp
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach($categories->where('status', '1') as $cate)
                                  <div class="panel panel-default">
                                    <div class="panel-heading active" role="tab" id="headingOnexxx">
                                        <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOnexxx{{ $cate->id }}" aria-expanded="true" aria-controls="collapseOnexxx">
                                            <i class="fa {{ $cate->icon }} rgt-10"></i> <label class="prime-cat" data-url="{{ route('category.page',['id' => $cate->id, 'category' => str_slug(str_replace('-','&',$cate->slug))]) }}">{{ str_limit($cate->title, $limit = 20, $end = '..') }}</label> 
                                        </a>
                                        </h4>
                                    </div>

                                    
                                    <div id="collapseOnexxx{{ $cate->id }}" class="subcate-collapse panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOnexxx">
                                    @foreach($cate->subcategory as $sub)
                                      @if($sub->status ==1)
                                      <div class="panel-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingelevenxxx">
                                              <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseelevenxxx{{ $sub->id }}" aria-expanded="false" aria-controls="collapseelevenxxx">
                                                  <i class="fa {{ $sub->icon }} rgt-10"></i> <label class="sub-cate" data-url="{{ route('subcategory.page',['id' => $sub->id, 'category' => str_slug(str_replace('-','&',$sub->slug))]) }}">{{ str_limit($sub->title, $limit = 15, $end = '..') }}</label>

                                                </a>
                                              </h4>
                                            </div>

                                            <div id="collapseelevenxxx{{ $sub->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingelevenxxx">
                                              @foreach($sub->childcategory as $child)
                                              @if($child->status ==1)
                                              <div class="panel-body sub-cat">
                                                <i class="fa {{ $child->icon }} rgt-10"></i> <label class="child-cate" data-url="{{ route('childcategory.page',['id' => $child->id, 'category' => str_slug(str_replace('-','&',$child->slug))]) }}">{{ $child->title }} </label>
                                              </div>
                                              @endif
                                              @endforeach
                                            </div>
                                            
                                        </div>
                                      </div>
                                      @endif
                                    @endforeach
                                    </div>
                                    
                                  </div>
                                @endforeach
                                </div>
                            </div>
                        
                        </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header collapsed" data-toggle="collapse" href="#collapseTwo" data-closetxt="Stäng block" data-opentxt="Visa innehåll">
                        <a class="card-title">
                          {{ __('frontstaticword.Price') }} 
                        </a>
                        </div>
                        <div id="collapseTwo" class="collapse show" data-parent="">
                        <div class="card-body">
                        <div class="categories-tags">
                            <div class="categories-content-one">
                                <div class="categories-tags-content-one">
                                    <ul>
                                        <li>
                                            <div class="form-check form-check-inline">
                                                <input {{ app('request')->input('type') == 'paid' ? 'checked' : '' }} class="form-check-input type" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="paid">
                                                <label class="form-check-label active" for="inlineCheckbox1">{{ __('frontstaticword.Paid') }}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-inline">
                                                <input {{ app('request')->input('type') == 'free' ? 'checked' : '' }} class="form-check-input type" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="free">
                                                <label class="form-check-label" for="inlineCheckbox2">{{ __('frontstaticword.Free') }}</label>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>




                    <div class="card">
                        <div class="card-header collapsed" data-toggle="collapse" href="#collapseTwo" data-closetxt="Stäng block" data-opentxt="Visa innehåll">
                        <a class="card-title">
                           {{ __('frontstaticword.Languages') }}
                        </a>
                        </div>
                        <div id="collapseTwo" class="collapse show" data-parent="">
                        <div class="card-body">
                        <div class="categories-tags">
                            <div class="categories-content-one">
                                <div class="categories-tags-content-one">
                                    @php
                                    $CourseLanguage = App\CourseLanguage::get();
                                    @endphp
                                    @foreach($CourseLanguage as $lang)
                                    <ul>
                                       
                                        <li>
                                            <div class="form-check form-check-inline">
                                                <input {{ app('request')->input('lang') == '$lang->id' ? 'checked' : '' }}  class="form-check-input lang" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="{{ $lang->id }}">
                                                <label class="form-check-label" for="inlineCheckbox2">{{ $lang->name }}</label>
                                            </div>
                                        </li>
                                        
                                    </ul>

                                    @endforeach
                                </div>
                                
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="students-bought btm-30">
                    @foreach($courses as $course)
                    @if($course->status == 1)
                    <div class="course-bought-block protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$course->id}}">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                    <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ asset('images/course/'.$course->preview_image) }}" alt="course" class="img-fluid"></a>
                                @else
                                    <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ Avatar::create($course->title)->toBase64() }}" alt="course" class="img-fluid"></a>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="categories-popularity-dtl">
                                    <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ $course->title }}</a></div>
                                    <ul>
                                        @if($course['level_tags'] == !NULL)
                                            <li class="best-seller best-seller-one">{{ $course['level_tags'] }}</li>
                                        @endif
                                        <li>
                                            @php
                                                $data = App\CourseClass::where('course_id', $course->id)->get();
                                                if(count($data)>0){

                                                    echo count($data);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp {{ __('frontstaticword.Courses') }}
                                        </li>
                                        <li>
                                             @php
                                                $enroll = App\Order::where('course_id', $course->id)->get();
                                                if(count($enroll)>0){

                                                    echo count($enroll);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp {{ __('frontstaticword.Students') }}
                                        </li>
                                        <li>{{ __('frontstaticword.AllLevels') }}</li>
                                    </ul>
                                    <p>{{  str_limit($course->short_detail, $limit = 125, $end = '..') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="rate text-right">
                                    <ul>
                                        @if($course->type == 1)
                                           
                                            @if($course->discount_price == !NULL) 
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->discount_price }}&nbsp;<s><i class="{{ $currency->icon }}"></i>{{ $course->price }}</s> </li>
                                                @else
                                                    <li class="rate-r">{{ $course->discount_price }}<i class="{{ $currency->icon }}"></i>&nbsp;<s>{{ $course->price }}<i class="{{ $currency->icon }}"></i></s></li>
                                                @endif
                                            @else
                                                @if($gsetting['currency_swipe'] == 1)
                                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->price }}</li>
                                                @else
                                                    <li class="rate-r">{{ $course->price }}<i class="{{ $currency->icon }}"></i></li>
                                                @endif
                                            @endif
                                        @else
                                            <li class="rate-r">{{ __('frontstaticword.Free') }}</li>
                                        @endif
                                    </ul>
                                    <div class="rating">
                                        <ul>
                                          <li>
                                            <!-- star rating -->
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
                                                <div class="pull-left"><p>{{ __('frontstaticword.NoRating') }}</p></div>
                                            @endif
                                          </li>
                                            
                                            <!-- overall rating -->
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
                                                $reviewsrating = App\ReviewRating::where('course_id', $course->id)->first();
                                            @endphp
                                            @if(!$reviews->isEmpty())
                                            <li>
                                                <b>({{ round($overallrating, 1) }})</b>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                    <ul>
                                        <li>
                                            (@php
                                                $data = App\ReviewRating::where('course_id', $course->id)->get();
                                                if(count($data)>0){

                                                    echo count($data);
                                                }
                                                else{

                                                    echo "0";
                                                }
                                            @endphp {{ __('frontstaticword.ratings') }})
                                        </li> 
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if($course['whatlearns']->isNotEmpty())
                            <div id="prime-next-item-description-block{{$course->id}}" class="prime-description-block">
                            <div class="prime-description-under-block">
                                <div class="prime-description-under-block">
                                    <h6 >{{ __('frontstaticword.Whatlearn') }}</h6>
                                    
                                    @foreach($course['whatlearns'] as $wl)
                                    @if($wl->status ==1)
                                        <div class="product-learn-dtl protip-whatlearn">
                                            <ul>
                                                <li><i class="fa fa-check"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                            </div>
                        @endif
                        
                    </div>
                    <hr>
                    @endif
                    @endforeach

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="top-20">{!! $courses->appends(Request::except('page'))->links() !!}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- categories end -->
@endsection



@section('custom-script')

<script type="text/javascript">
    
     var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
      for(i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if(sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
      }
    };

    
    $('.type').on('click',function(){
        if($(this).is(':checked')){
            var type  = $(this).val();

        var exist = window.location.href;
      var url = new URL(exist);
      var query_string = url.search;
      var search_params = new URLSearchParams(query_string);
      search_params.set('type', type);
      url.search = search_params.toString();
      var new_url = url.toString();
      window.history.pushState('page2', 'Title', new_url);

        }else{
         var element = '&type='+getUrlParameter('type');
        var exist = window.location.href;
        var new_url = exist.replace(element, '');
        window.history.pushState('page2', 'Title', new_url);  
        }

        location.reload();
        
    });


    $('.lang').on('click',function(){
        if($(this).is(':checked')){
            var type  = $(this).val();

        var exist = window.location.href;
      var url = new URL(exist);
      var query_string = url.search;
      var search_params = new URLSearchParams(query_string);
      search_params.set('lang', type);
      url.search = search_params.toString();
      var new_url = url.toString();
      window.history.pushState('page2', 'Title', new_url);

        }else{
         var element = '&lang='+getUrlParameter('lang');
        var exist = window.location.href;
        var new_url = exist.replace(element, '');
        window.history.pushState('page2', 'Title', new_url);  
        }

        location.reload();
        
    });
</script>


@endsection
