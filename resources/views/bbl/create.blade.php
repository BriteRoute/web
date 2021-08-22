@extends('admin/layouts.master')
@section('title', 'Create a new meeting')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
  	<div class="box-header with-border">
  		<div class="box-title">
  			{{ __('adminstaticword.Createanewmeeting') }}
  		</div>
  	</div>

  	<div class="box-body">
  		<form action="{{ route('bbl.store') }}" method="POST">
  			@csrf


      <div class="form-group">
        <label for="exampleInputDetails">{{ __('adminstaticword.LinkByCourse') }}:</label>
          <li class="tg-list-item">
              <input class="tgl tgl-skewed" id="link_by" type="checkbox" name="link_by" >
              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="link_by"></label>
          </li>
        <input type="hidden" name="free" value="0" for="opp" id="link_by">
      </div>

      <div class="form-group display-none" id="sec1_one" >
        <label>{{ __('adminstaticword.Courses') }}:<span class="redstar">*</span></label>
        <select name="course_id" id="course_id" class="form-control js-example-basic-single">
          @php
            $course = App\Course::where('status', '1')->where('user_id', Auth::user()->id)->get();
          @endphp
          @foreach($course as $cor)
            <option value="{{$cor->id}}">{{$cor->title}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Presenter {{ __('adminstaticword.Name') }}: <sup class="redstar">*</sup></label>
        <input value="{{ old('presen_name') }}" type="text" name="presen_name" class="form-control" required="" placeholder="enter presenter name">
      </div>
			
			<div class="form-group">
				<label>{{ __('adminstaticword.MeetingID') }}: <sup class="redstar">*</sup></label>
				<input value="{{ old('meetingid') }}" type="text" name="meetingid" class="form-control" required="" placeholder="enter meeting id">
			</div>

			<div class="form-group">
				<label> {{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.Name') }}: <sup class="redstar">*</sup></label>
				<input value="{{ old('meetingname') }}" type="text" name="meetingname" class="form-control" required="" placeholder="enter meeting name">
			</div>

      <div class="form-group">
        <label>{{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.Detail') }}: <sup class="redstar">*</sup></label>
        <textarea id="detail" rows="5" cols="30" name="detail" class="form-control" placeholder="enter meeting detail">{{ old('detail') }}</textarea>
      </div>

			<div class="form-group">
				<label>{{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.Duration') }}: <sup class="redstar">*</sup></label>
				<input value="{{ old('duration') }}" type="text" name="duration" class="form-control" required="" placeholder="enter meeting duration eg. 40">
				<small class="text-muted">It will be count in minutes</small>
			</div>

      <div class="form-group">
            <label>
              {{ __('adminstaticword.StartTime') }}:<sup class="redstar">*</sup>
            </label>

            <div class='input-group date' id='datetimepicker1'>
              <input value="{{ old('start_time') }}" name="start_time" type='text' class="form-control" required />
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
      </div>

			<div class="form-group">
              <div class="eyeCy">
                <label>Moderator {{ __('adminstaticword.Password') }}:</label>

                <input required id="modpw" value="" type="password" name="modpw" class="form-control" placeholder="enter moderator password">
                <span toggle="#modpw" class="fa fa-fw fa-eye field-icon toggle-password"></span>
  
              </div>
            </div>

            <div class="form-group">
              <div class="eyeCy">
                <label>Attandee {{ __('adminstaticword.Password') }}: <small class="text-muted">(<b>Tip !</b> Share your attendee password to students using social handling networks.)</small></label>

                <input required id="attendeepw" value="" type="password" name="attendeepw" class="form-control" placeholder="enter attandee password">
                <span toggle="#attendeepw" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	               <small class="text-muted">Should be diffrent from <b>Moderator</b> password</small>
                 <br>
                 
              </div>
            </div>

            <div class="form-group">
            	<label>Set Welcome Message:</label>
            	<input value="{{ old('welcomemsg') }}" type="text" class="form-control" name="welcomemsg" placeholder="enter welcome message">
            </div>

            <div class="form-group">
            	<label>Set Max Participants:</label>
            	<input value="{{ old('setMaxParticipants') }}" type="number" min="-1" class="form-control" name="setMaxParticipants" placeholder="enter maximum participant no., leave blank if want unlimited participant"/>
            </div>

            <div class="form-group">
            	<label>Set Mute on Start:</label>
            	<input class="tgl tgl-skewed" name="setMuteOnStart" id="setMuteOnStart" type="checkbox"/>
		    	    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="setMuteOnStart"></label>
            </div>

            <div class="form-group">
              <label>Allow Record:</label>
              <input class="tgl tgl-skewed" name="allow_record" id="allow_record" type="checkbox"/>
              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="allow_record"></label>
            </div>

          

            <div class="form-group">
            	<button type="submit" class="btn btn-md btn-primary">
            		+ {{ __('adminstaticword.CreateMeeting') }}
            	</button>
            </div>


  		</form>
  	</div>
  </div>
</section>

@endsection
@section('script')
	<script>
      
    $('#datetimepicker1').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
    });

	</script>

  <script>
  (function($) {
    "use strict";

    $(function(){

        $('#link_by').change(function(){
          if($('#link_by').is(':checked')){
            $('#sec1_one').show('fast');
          }else{
            $('#sec1_one').hide('fast');
          }

        });
     
    });
  })(jQuery);
  </script>
@endsection