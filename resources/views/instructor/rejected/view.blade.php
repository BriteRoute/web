@extends('admin.layouts.master')
@section('title', 'View Course Review - Admin')
@section('body')
 
<section class="content">
  <div class="row">
    <div class="col-md-12">
    	<div class="box box-primary">
       	<div class="box-header with-border">
      	<h3 class="box-title">{{ __('adminstaticword.CourseReview') }} -> {{ $course->title }}</h3>
   		</div>
    	<div class="panel-body">

    		<div class="view-instructor">
          <div class="instructor-detail">
          	<ul>
          		<li>

                @if($course->preview_image != null || $course->preview_image !='')
                  <img src="{{ asset('images/course/'.$course->preview_image) }}" class="img-circle"/>
                @else
                  <img src="{{ Avatar::create($course->title)->toBase64() }}" alt="course" class="img-responsive">
                @endif
              </li>
              <li><b>{{ __('adminstaticword.Course') }}</b>: {{ $course->title }}</li>
          		<li><b>{{ __('adminstaticword.User') }}</b>: {{ $course->user->fname }} {{ $course->user->lname }}</li>
          		
          		<li><b>{{ __('adminstaticword.Title') }}</b>: {{ $course->title }}</li>
          		<li><b>{{ __('adminstaticword.Detail') }}</b>: {!! $course->detail !!}</li>

          	</ul>
          </div>
    		</div>


          <div class="view-instructor">
          <div class="instructor-detail">
           
              <li><b>{{ __('Course Rejected Reason') }}</b>:<br> {!! $course->reject_txt !!}</li>

            </ul>
          </div>
        </div>


        
      </div>
  	</div>
  </div>
</section>
@endsection



