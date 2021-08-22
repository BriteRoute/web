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


        <form action="{{url('coursereview/'.$course->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <input type="hidden" value="{{ $course->course_id }}" name="course_id" class="form-control">

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Accept') }}:</label>
                <br>
                <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="appoint_accept" type="checkbox" name="status" {{ $course->status == 1 ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Reject" data-tg-on="Accept" for="appoint_accept"></label>
                </li>
              </div>
            </div>
            <br>

            <div class="row" style="{{ $course->status == '0' ? '' : 'display:none' }}" id="sec1_one">
              <div class="col-md-12">
                <label for="exampleInputDetails">{{ __('adminstaticword.ReasonforRejection') }}:</label>
                <textarea id="detail" name="reject_txt" rows="1" class="form-control" placeholder="Enter class detail">{{ $course['reject_txt'] }}</textarea>
              </div>
            </div>
            <br>


            <button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>

        </form>
      </div>
  	</div>
  </div>
</section>
@endsection


@section('script')


<script>
(function($) {
  "use strict";

  $(function(){

      $('#appoint_accept').change(function(){
        if($('#appoint_accept').is(':checked')){
          $('#sec_one').show('fast');
          $('#sec1_one').hide('fast');
        }else{
          $('#sec_one').hide('fast');
          $('#sec1_one').show('fast');
        }

      });
   
  });
})(jQuery);
</script>

@endsection
