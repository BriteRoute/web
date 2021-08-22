@extends('admin.layouts.master')
@section('title', 'Widget Setting - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.WidgetSetting') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{action('WidgetController@update')}}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}


		                <div class="row">
			                <div class="col-md-3">
						    	<label for="">{{ __('Enable Widget') }}: </label>
								<li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="widget_enable" type="checkbox" name="widget_enable" {{ optional($show)->widget_enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="widget_enable"></label>
						        </li>
						        <div>
						            <small>(Enable widget on footer)</small>
								</div>
					    	</div>
					    </div>
					    <br>
					    <br>


		                
		              	<div class="row">
		                  <div class="col-md-4">
		                    <label for="heading">{{ __('adminstaticword.WidgetOne') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show ? $show->widget_one : '' }}" autofocus name="widget_one" type="text" class="form-control" placeholder="Enter widget" required/>


		                    <br>


					    	<label for="">{{ __('Enable About Us') }}: </label>
							<li class="tg-list-item">              
					            <input class="tgl tgl-skewed" id="about_enable" type="checkbox" name="about_enable" {{ optional($show)->about_enable == 1 ? 'checked' : '' }} >
					            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="about_enable"></label>
					        </li>
					        <div>
					            <small>({{ __('Enable About us page on footer widget') }})</small>
							</div>

							<br>

							<label for="">{{ __('Enable Contact Us') }}: </label>
							<li class="tg-list-item">              
					            <input class="tgl tgl-skewed" id="contact_enable" type="checkbox" name="contact_enable" {{ optional($show)->contact_enable == 1 ? 'checked' : '' }} >
					            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="contact_enable"></label>
					        </li>
					        <div>
					            <small>({{ __('Enable Contact us page on footer widget') }})</small>
							</div>
    	
		                  </div>

	                      <div class="col-md-4">
	                        <label for="heading">{{ __('adminstaticword.WidgetTwo') }}<sup class="redstar">*</sup></label>
	                        <input value="{{ optional($show)->widget_two }}" autofocus name="widget_two" type="text" class="form-control" placeholder="Enter widget" required/>

	                        <br>

	                        <label for="">{{ __('Enable Career Us') }}: </label>
							<li class="tg-list-item">              
					            <input class="tgl tgl-skewed" id="career_enable" type="checkbox" name="career_enable" {{  optional($show)->career_enable == 1 ? 'checked' : '' }} >
					            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="career_enable"></label>
					        </li>
					        <div>
					            <small>({{ __('Enable Career us page on footer widget') }})</small>
							</div>

							<br>

							<label for="">{{ __('Enable Blog') }}: </label>
							<li class="tg-list-item">              
					            <input class="tgl tgl-skewed" id="blog_enable" type="checkbox" name="blog_enable" {{ optional($show)->blog_enable == 1 ? 'checked' : '' }} >
					            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="blog_enable"></label>
					        </li>
					        <div>
					            <small>({{ __('Enable Blog on footer widget') }})</small>
							</div>

							<br>

							<label for="">{{ __('Enable Help & Support') }}: </label>
							<li class="tg-list-item">              
					            <input class="tgl tgl-skewed" id="help_enable" type="checkbox" name="help_enable" {{ optional($show)->help_enable == 1 ? 'checked' : '' }} >
					            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="help_enable"></label>
					        </li>
					        <div>
					            <small>({{ __('Enable Help & Support page on footer widget') }})</small>
							</div>

							<br>
	                      </div>

	                      <div class="col-md-4">
	                        <label for="heading">{{ __('adminstaticword.WidgetThree') }}<sup class="redstar">*</sup></label>
	                        <input value="{{ optional($show)->widget_three }}" autofocus name="widget_three" type="text" class="form-control" placeholder="Enter widget" required/>
	                      </div>
			            </div>
			            <br>
						
						<div class="box-footer">
			            	<button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
			        	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection
