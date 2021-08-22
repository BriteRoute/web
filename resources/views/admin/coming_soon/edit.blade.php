@extends('admin.layouts.master')
@section('title', 'Coming Soon - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
      <div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.ComingSoon') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('ComingSoonController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
						
		                <div class="row">
		                  <div class="col-md-6">
		                    <label for="bg_image">{{ __('adminstaticword.BackgroundImage') }}<sup class="redstar">*</sup></label>
		                    <input type="file" name="bg_image" id="bg_image">
		                    <br>
		                    <img src="{{ url('/images/comingsoon/'.optional($comingsoon)->bg_image) }}" class="img-responsive"/>
		                    
		                  </div>
		                  <div class="col-md-6">
		                    <label for="heading">{{ __('adminstaticword.Heading') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->heading }}" name="heading" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Heading') }}" required/>
		                    <br>
		                    <label for="btn_text">{{ __('adminstaticword.ButtonText') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->btn_text }}" name="btn_text" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ButtonText') }}" required/>

		                  </div>
		              	</div>
		              	<br>
		              	<div class="row">
		                  <div class="col-md-3">
		                    <label for="count_one">{{ __('adminstaticword.CounterOne') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->count_one }}" name="count_one" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterOne') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_two">{{ __('adminstaticword.CounterTwo') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->count_two }}" name="count_two" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterTwo') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_three">{{ __('adminstaticword.CounterThree') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->count_three }}" name="count_three" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterThree') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="count_four">{{ __('adminstaticword.CounterFour') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->count_four }}" name="count_four" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterFour') }}" required/>
		                  </div>
		              	</div>
		              	<br>

		              	<div class="row">
		                  <div class="col-md-3">
		                    <label for="text_one">{{ __('adminstaticword.CounterOne') }} {{ __('adminstaticword.Text') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->text_one }}" name="text_one" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterOne') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_two">{{ __('adminstaticword.CounterTwo') }} {{ __('adminstaticword.Text') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->text_two }}" name="text_two" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterTwo') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_three">{{ __('adminstaticword.CounterThree') }} {{ __('adminstaticword.Text') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->text_three }}" name="text_three" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterThree') }}" required/>
		                  </div>
		                  <div class="col-md-3">
		                    <label for="text_four">{{ __('adminstaticword.CounterFour') }} {{ __('adminstaticword.Text') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ optional($comingsoon)->text_four }}" name="text_four" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.CounterFour') }}" required/>
		                  </div>
		              	</div>
		              	<br>



		              	<div class="row">
		                  <div class="col-md-12">

			            	<label for="url">Enter IP Address to allowed while Maintanace Mode is Enabled (ex: 172.16.254.1, 506.457.14.512)</label>
			                  
			                <select class="form-control js-example-basic-single" name="allowed_ip[]" multiple="multiple" size="5">


							@if(is_array(optional($comingsoon)->allowed_ip) || is_object(optional($comingsoon)->allowed_ip)) 

		                      @foreach(optional($comingsoon)->allowed_ip as $cat)
								
		                        <option value="{{ $cat }}" {{in_array($cat, $comingsoon['allowed_ip'] ?: []) ? "selected": ""}} >{{ $cat }}
		                        </option>
		                       

		                      @endforeach
		                    @endif

		                    </select>

		                  </div>
		            	</div>
		            	<br>
		            	<br>

		                <div class="row">

			                <div class="col-md-3">
						    	<label for="">{{ __('Enable Maintanace Mode') }}: </label>
								<li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="enable" type="checkbox" name="enable" {{ optional($comingsoon)->enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Disable') }}" data-tg-on="{{ __('adminstaticword.Enable') }}" for="enable"></label>
						        </li>
						        <div>
						            <small>({{ __('adminstaticword.Enable') }} {{ __('Enable Maintanace Mode') }})</small>
								</div>
					    	</div>
					    </div>
				    	<br>
				    	<br>
						
						<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>
		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


