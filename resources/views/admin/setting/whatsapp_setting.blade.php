@extends('admin.layouts.master')
@section('title', 'Whatsapp Button Settings - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-6">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.WhatsappChatButton') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('WhatsappButtonController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('POST') }}

		                <div class="row">
			                <div  class="col-md-12">
								<label for="">{{ __('adminstaticword.EnableWhatsappChatButton') }}: </label>
								<br>
								<li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="cb3" type="checkbox" name="wapp_enable" {{ $setting['wapp_enable'] == '1' ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cb3"></label>
					            </li>
					            <input type="hidden"  name="free" value="0" for="cb3" id="cb3"> 
							</div>
						</div>
						<br>
		                
		              	<div class="row">

		              	  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="bank">{{ __('adminstaticword.WhatasppPhoneNo') }} (with country code):</label>
			                    <input value="{{ $setting['wapp_phone'] }}" name="wapp_phone" type="text" class="form-control" placeholder="Whatsapp Phone Number" required autocomplete="off"/>
			                </div>
		                  </div>
		                 
		                
		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="bank">{{ __('adminstaticword.WhatasppPopUpMsg') }}:</label>
			                    <input value="{{ $setting['wapp_popup_msg'] }}" name="wapp_popup_msg" type="text" class="form-control" placeholder="PopUp Message" required autocomplete="off"/>
			                </div>
		                  </div>
		               
		                  
		               
		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="number">{{ __('adminstaticword.HeaderTitle') }}:</label>
			                    <input value="{{ $setting['wapp_title'] }}" name="wapp_title" type="text" class="form-control" placeholder="Header Title" required autocomplete="off"/>
			                </div>
		                  </div>

		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="">{{ __('adminstaticword.ButtonPosition') }}: </label>
								<br>
								<li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="cb4" type="checkbox" name="wapp_position" {{ $setting['wapp_position'] == 'left' ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Right" data-tg-on="Left" for="cb4"></label>
					            </li>
					            <input type="hidden"  name="free" value="0" for="cb4" id="cb4">
			                </div>
		                  </div>

		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="number">{{ __('adminstaticword.whatsappcolor') }}:</label>
			                     <input type="text" name="wapp_color" value="{{ $setting['wapp_color'] }}" class="form-control my-colorpicker1"  placeholder="Choose color">
			                </div>
		                  </div>

		                </div>


		              	<br>
						<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection


@section('scripts')

<script>
  $(function() {
    $('.my-colorpicker1').colorpicker();
  })
</script>

@endsection





