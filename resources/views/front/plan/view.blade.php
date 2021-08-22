@extends('theme.master')
@section('title', 'Instructor Subscription Plan')
@section('content')

@include('admin.message')


<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.InstructorPlan') }}</h1>
    </div>
</section> 

<section id="profile-item" class="profile-item-block">
    <div class="container">
        @if(isset($subscribed))
        <h4 class="student-heading">{{ __('frontstaticword.ActivePlan') }}</h4>
        <div class="row">
            @foreach($subscribed as $subscrib)
            @if($subscrib->plans->status == '1')
            
                <div class="col-lg-3 col-sm-6 col-md-4">
                    <div class="view-block btm-10">
                        <div class="view-img">
                            @if($subscrib->plans['preview_image'] !== NULL && $subscrib->plans['preview_image'] !== '')
                                <img src="{{ asset('images/plan/'.$subscrib->plans->preview_image) }}" class="img-fluid" alt="course">
                            @else
                                <a href=""><img src="{{ Avatar::create($subscrib->plans->title)->toBase64() }}" class="img-fluid" alt="course">
                            @endif
                            </a>
                        </div>
                       
                        <div class="view-dtl">
                            <div class="view-heading btm-10"><a href="">{{ str_limit($subscrib->plans->title, $limit = 35, $end = '...') }}</a></div>

                            <div class="text-right">{{ __('frontstaticword.AllowedCourses') }}: {{ $subscrib->plans->courses_allowed }}</div>

                            <div class="text-right">

                                <div class="">{{ __('frontstaticword.Duration') }}:</div>
                                <ul>


                                @if($subscrib->plans->duration == 'm')

                                    @if($subscrib->plans->discount_price == !NULL)

                                    <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }} / {{ $subscrib->plans->duration }} {{ __('frontstaticword.Month') }}</s></li>

                                    <li><b><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->discount_price }}/ {{ $subscrib->plans->duration }} {{ __('frontstaticword.Month') }}</b></li>

                                    @else

                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }} / {{ $subscrib->plans->duration }} {{ __('frontstaticword.Month') }}</li>

                                    @endif
                                    
                                @else

                                    @if($subscrib->plans->discount_price == !NULL)
                                    <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }} / {{ $subscrib->plans->duration }} {{ __('frontstaticword.Days') }}</s></li>

                                    <li><b><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->discount_price }}/ {{ $subscrib->plans->duration }} {{ __('frontstaticword.Days') }}</b></li>

                                    @else

                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }} / {{ $subscrib->plans->duration }} {{ __('frontstaticword.Days') }}</li>

                                    @endif
                                @endif
                            </ul>

                            </div>
                           
                            @if($subscrib->plans->type == 1)
                            <div class="rate text-right">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp 
                                    @if($subscrib->plans->discount_price == !NULL)

                                        <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }}</s></li>
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->discount_price }}</b></li>
                                    @else
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $subscrib->plans->price }}</b></li>
                                    @endif
                                </ul>
                            </div>
                            @else
                            <div class="rate text-right">
                                <ul>
                                  <li><b>{{ __('frontstaticword.Free') }}</b></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                   
                </div>
            @endif
            @endforeach
        </div>

        @endif
        
    </div>
</section>
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">
        <h4 class="student-heading">{{ __('frontstaticword.AllPlansAvailable') }}</h4>
    	<div class="row">
    		@foreach($plans as $plan)
            @if($plan->status == '1')
        	
                <div class="col-lg-3 col-sm-6 col-md-4">
                    <div class="view-block btm-10">
                        <div class="view-img">
                            @if($plan['preview_image'] !== NULL && $plan['preview_image'] !== '')
                                <a href=""><img src="{{ asset('images/plan/'.$plan->courses->preview_image) }}" class="img-fluid" alt="course">
                            @else
                                <a href=""><img src="{{ Avatar::create($plan->title)->toBase64() }}" class="img-fluid" alt="course">
                            @endif
                            </a>
                        </div>
                       
                        <div class="view-dtl">
                            <div class="view-heading"><a href="">{{ str_limit($plan->title, $limit = 35, $end = '...') }}</a></div>

                            <div class="text-right">{{ __('frontstaticword.AllowedCourses') }}: {{ $plan->courses_allowed }}</div>

                            <div class="text-right">

                            	<div class="">Duration:</div>
                                <ul>


                            	@if($plan->duration == 'm')

                            		@if($plan->discount_price == !NULL)

                                    <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $plan->price }} / {{ $plan->duration }} Month</s></li>

                                    <li><b><i class="{{ $currency->icon }}"></i>{{ $plan->discount_price }}/ {{ $plan->duration }} Month</b></li>

                                    @else

                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $plan->price }} / {{ $plan->duration }} Month</li>

                                    @endif
                                    
                                @else

                                	@if($plan->discount_price == !NULL)
                                    <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $plan->price }} / {{ $plan->duration }} Days</s></li>

                                    <li><b><i class="{{ $currency->icon }}"></i>{{ $plan->discount_price }}/ {{ $plan->duration }} Days</b></li>

                                    @else

                                    <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $plan->price }} / {{ $plan->duration }} Days</li>

                                    @endif
                                @endif
                            </ul>

                            </div>
                           
                            @if($plan->type == 1)
                            <div class="rate text-right">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp 
                                    @if($plan->discount_price == !NULL)

                                        <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $plan->price }}</s></li>
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $plan->discount_price }}</b></li>
                                    @else
                                        <li><b><i class="{{ $currency->icon }}"></i>{{ $plan->price }}</b></li>
                                    @endif
                                </ul>
                            </div>
                            @else
                            <div class="rate text-right">
                                <ul>
                                  <li><b>{{ __('frontstaticword.Free') }}</b></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="planlist-action">
                        <div class="row">
                        	<div class="col-md-12 col-12">
                               
                                @if($plan->type == 1)
                                <div class="plan-enroll-btn btm-10">
                                    <form id="demo-form2" method="post" action="{{ route('plan.checkout') }}"
                                            data-parsley-validate class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            
                                            <input type="hidden" name="plan_id"  value="{{ $plan->id }}" />
                                        
                                         <button type="submit" class="btn btn-primary"  title="Add To Cart">Subscribe Now</button>
                                    </form>
                                </div>
                                @else

                                <div class="plan-enroll-btn btm-10">
                                    <form id="demo-form2" method="post" action="{{ route('free.plan.checkout') }}"
                                            data-parsley-validate class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            
                                            <input type="hidden" name="plan_id"  value="{{ $plan->id }}" />
                                        
                                         <button type="submit" class="btn btn-primary"  title="Add To Cart">Subscribe Now</button>
                                    </form>
                                </div>

                                @endif
                        	</div>
                        	
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
    	</div>
    	
    </div>
</section>
<!-- profile update end -->
@endsection

@section('custom-script')



@endsection
