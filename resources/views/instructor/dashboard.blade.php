@extends('admin.layouts.master')
@section('title', 'Dashboard - Instructor')
@section('body')

@if(Auth::User()->role == "instructor")

<section class="content-header">
  <h1>
    {{ __('adminstaticword.Dashboard') }}
    <small>{{ __('adminstaticword.Instructor') }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{ __('adminstaticword.Home') }}</a></li>
    <li class="active">{{ __('adminstaticword.Dashboard') }}</li>
  </ol>
</section>
<section class="content">
	<!-- Main row -->
  <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
            	@php
            		$course = App\Course::where('user_id', Auth::User()->id)->get();
            		if(count($course)>0){

            			echo count($course);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p>{{ __('adminstaticword.Course') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-book"></i>
          </div>
          <a href="{{url('course')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->

        <div class="small-box bg-green">
          <div class="inner">
            <h3>
             
            	@php
            		$cat = App\Order::where('instructor_id', Auth::User()->id)->get();
            		if(count($cat)>0){

            			echo count($cat);
            		}
            		else{

            			echo "0";
            		}
            	@endphp

            </h3>
            <p> {{ __('adminstaticword.User') }} {{ __('adminstaticword.Enrolled') }}</p>
          </div>
          <div class="icon">
          	<i class="flaticon-followers"></i>
          </div>
          <a href="{{url('userenroll')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
            	@php
            		$question = App\Question::where('instructor_id', Auth::User()->id)->get();
            		if(count($question)>0){

            			echo count($question);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p> {{ __('adminstaticword.Total') }} {{ __('adminstaticword.Question') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-questions"></i>
          </div>
          <a href="{{url('instructorquestion')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
            	@php
            		$answer = App\Answer::all();
            		if(count($answer)>0){

            			echo count($answer);
            		}
            		else{

            			echo "0";
            		}
            	@endphp
            </h3>
            <p> {{ __('adminstaticword.Total') }} {{ __('adminstaticword.Answer') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-online-business"></i>
          </div>
          <a href="{{url('instructoranswer')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
              @php
                $answer = App\Course::where('user_id', Auth::User()->id)->where('status', '1')->where('featured', '1')->get();
                if(count($answer)>0){

                  echo count($answer);
                }
                else{

                  echo "0";
                }
              @endphp
            </h3>
            <p> {{ __('adminstaticword.Featured') }} {{ __('adminstaticword.Courses') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-online-business"></i>
          </div>
          <a href="{{url('featurecourse')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3>
              @php
                $answer = App\Blog::where('user_id', Auth::User()->id)->where('status', '1')->get();
                if(count($answer)>0){

                  echo count($answer);
                }
                else{

                  echo "0";
                }
              @endphp
            </h3>
            <p> {{ __('adminstaticword.Blog') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-online-business"></i>
          </div>
          <a href="{{url('blog')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      @if(isset($zoom_enable) && $zoom_enable == 1)
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              @php
                $answer = App\Meeting::where('user_id', Auth::User()->id)->get();
                if(count($answer)>0){

                  echo count($answer);
                }
                else{

                  echo "0";
                }
              @endphp
            </h3>
            <p> {{ __('adminstaticword.ZoomMeeting') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-online-business"></i>
          </div>
          <a href="{{route('zoom.index')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif
      <!-- ./col -->
      @if(isset($gsetting) && $gsetting->bbl_enable == 1)
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              @php
                $answer = App\BBL::where('instructor_id', Auth::User()->id)->where('is_ended', '0')->get();
                if(count($answer)>0){

                  echo count($answer);
                }
                else{

                  echo "0";
                }
              @endphp
            </h3>
            <p> {{ __('adminstaticword.BigBlueMeeting') }}</p>
          </div>
          <div class="icon">
            <i class="flaticon-online-business"></i>
          </div>
          <a href="{{route('bbl.all.meeting')}}" class="small-box-footer"> {{ __('adminstaticword.Moreinfo') }}<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif

      <!-- ./col -->
  </div>
  <!-- /.row -->


  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-body">
          {!! $userEnrolled->container() !!}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-body">
          {!! $payout->container() !!}
        </div>
      </div>
    </div>
  </div>

	
</section>

@endif

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

{!! $userEnrolled->script() !!}
{!! $payout->script() !!}
@endsection