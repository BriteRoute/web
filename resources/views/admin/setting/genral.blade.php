<form enctype="multipart/form-data" method="POST" action="{{ route('setting.store') }}">
	@csrf

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="exampleInputDetails">{{ __('adminstaticword.TextLogo') }}:</label>
			    <li class="tg-list-item">
			        <input class="tgl tgl-skewed" id="opp" type="checkbox" name="project_logo" {{ $gsetting->logo_type == 'L' ? 'checked' : '' }}>
			        <label class="tgl-btn" data-tg-off="Text" data-tg-on="Logo" for="opp"></label>
			    </li>
			    <input type="hidden" name="free" value="0" for="opp" id="oppp">
		    </div>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-6">
			<div class="row">

				@if ($errors->has('logo'))
				<div class="display-none" id="logo">
                    <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                </div>
                @endif
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputDetails">{{ __('adminstaticword.Logo') }}</label>- <p class="inline info">Size: 300x90</p>
						<br>	
						<input type="file" name="logo" value="{{ $setting->logo }}" id="logo" class="{{ $errors->has('logo') ? ' is-invalid' : '' }} inputfile inputfile-1"/>
				<label for="logo"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.ChooseaLogo') }}</span></label>
				<span class="text-danger invalid-feedback" role="alert"></span>
					</div>
				 	  
				</div>
				<div class="col-md-4">
					<div class="well">
						@if($setting->logo !="")
							<div class="logo-settings">
								<img src="{{ asset('images/logo/'.$setting->logo) }}" alt="{{ $setting->logo }}" class="img-responsive">
							</div>
						@else
							<div class="alert alert-danger">
								{{ __('adminstaticword.Nologofound') }}
							</div>
						@endif
					</div>
				</div>
			</div>
			<br>
		</div>
		<div class="col-md-6">
			<div class="row">

				@if ($errors->has('footer_logo'))
				<div class="display-none" id="footer_logo">
                    <strong class="text-danger">{{ $errors->first('footer_logo') }}</strong>
                </div>
                @endif
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputDetails">{{ __('adminstaticword.footerlogo') }}</label>- <p class="inline info">Size: 300x90</p>
						<br>	
						<input type="file" name="footer_logo" value="{{ $setting->footer_logo }}" id="footer_logo" class="{{ $errors->has('footer_logo') ? ' is-invalid' : '' }} inputfile inputfile-1"/>
						<label for="footer_logo"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.ChooseaLogo') }}</span></label>
						<span class="text-danger invalid-feedback" role="alert"></span>
					</div>
				 	  
				</div>
				<div class="col-md-4">
					<div class="well">
						@if($setting->footer_logo !="")
							<div class="logo-settings">
								<img src="{{ asset('images/logo/'.$setting->footer_logo) }}" alt="{{ $setting->footer_logo }}" class="img-responsive">
							</div>
						@else
							<div class="alert alert-danger">
								{{ __('adminstaticword.Nologofound') }}
							</div>
						@endif
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="row">
				
				@if ($errors->has('favicon'))
                    <strong class="text-danger">{{ $errors->first('favicon') }}</strong>
                @endif
				<div class="col-md-6">
					<label for="exampleInputDetails">{{ __('adminstaticword.Favicon') }}</label>- <p class="inline info">Size: 35x35</p>
					<br>	
					<input type="file" name="favicon" id="favi" class="{{ $errors->has('favicon') ? ' is-invalid' : '' }} inputfile inputfile-1"/>

					<label for="favi"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafavicon') }}</span></label>
				</div>
				<div class="col-md-4">
					<div class="well">
						@if($setting->favicon !="")
							<div class="favicon-settings">
								<img src="{{ asset('images/favicon/'.$setting->favicon) }}" alt="{{ $setting->favicon }}" class="img-responsive">
							</div>
						@else
							<div class="alert alert-danger">
								{{ __('adminstaticword.NoFaviconfound') }}
							</div>
						@endif
					</div>

				</div>
			</div>
			<br>
		</div>
		<div class="col-md-6">
			<div class="row">

				@if ($errors->has('preloader_logo'))
				<div class="display-none" id="preloader_logo">
                    <strong class="text-danger">{{ $errors->first('preloader_logo') }}</strong>
                </div>
                @endif
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputDetails">{{ __('adminstaticword.Preloaderlogo') }}</label>- <p class="inline info">Size: 300x90</p>
						<br>	
						<input type="file" name="preloader_logo" value="{{ $setting->preloader_logo }}" id="preloader_logo" class="{{ $errors->has('preloader_logo') ? ' is-invalid' : '' }} inputfile inputfile-1"/>
						<label for="preloader_logo"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.ChooseaLogo') }}</span></label>
						<span class="text-danger invalid-feedback" role="alert"></span>
					</div>
				 	  
				</div>
				<div class="col-md-4">
					<div class="well">
						@if($setting->preloader_logo !="")
							<div class="favicon-settings">
								<img src="{{ asset('images/logo/'.$setting->preloader_logo) }}" alt="{{ $setting->preloader_logo }}" class="img-responsive">
							</div>
						@else
							<div class="alert alert-danger">
								{{ __('adminstaticword.Nologofound') }}
							</div>
						@endif
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>

	

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="project_title">{{ __('adminstaticword.ProjectTitle') }}:<sup class="redstar">*</sup></label>
			  	<input value="{{ $setting->project_title }}" placeholder="Enter project title" name="project_title" type="text" class="{{ $errors->has('project_title') ? ' is-invalid' : '' }} form-control">
			  	@if ($errors->has('project_title'))
	                <span class="text-danger invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('project_title') }}</strong>
	                </span>
	            @endif
	        </div>
		</div>
		<div class="col-md-6">
			<label for="APP_URL">{{ __('adminstaticword.APPURL') }}:<sup class="redstar">*</sup></label>
		  	<input placeholder="http://localhost/" name="APP_URL" type="text" class="{{ $errors->has('APP_URL') ? ' is-invalid' : '' }} form-control" value="{{ $env_files['APP_URL'] }}" >
		  	@if ($errors->has('APP_URL'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('APP_URL') }}</strong>
                </span>
            @endif
            <br>
		</div>
		
	</div>

	<div class="row">
		
		<div class="col-md-6">
			<label for="phone">{{ __('adminstaticword.Contact') }}:<sup class="redstar">*</sup></label>
            <input value="{{ $setting->default_phone }}" name="default_phone" placeholder="Enter contact no." type="text" class="{{ $errors->has('default_phone') ? ' is-invalid' : '' }} form-control" required>
		</div>
		<div class="col-md-6">
			<label for="wel_email">{{ __('adminstaticword.Email') }}:<sup class="redstar">*</sup></label>
            <input value="{{ $setting->wel_email }}" name="wel_email" placeholder="Enter your email" type="text" class="{{ $errors->has('wel_email') ? ' is-invalid' : '' }} form-control" required>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-6">
            <label for="cpy_txt">{{ __('adminstaticword.CopyrightText') }}:<sup class="redstar">*</sup></label>
            <input value="{{ $setting->cpy_txt }}" name="cpy_txt" placeholder="Enter Copyright Text" type="text" required class="{{ $errors->has('cpy_txt') ? ' is-invalid' : '' }} form-control">
		</div>
		<div class="col-md-6">
			<label for="feature_amount">Amount to feature a course:</label>
			<small>(Instructor can feature its course, by paying this amount)</small>
            <input min="1" class="form-control" name="feature_amount" type="number" value="{{ $setting->feature_amount }}" id="duration"  placeholder="Enter amount to feature course ex: 100" class="{{ $errors->has('feature_amount') ? ' is-invalid' : '' }} form-control">
		</div>
		
	</div>
	<br>

	<div class="row">
		<div class="col-md-12">
			<label for="exampleInputDetails">{{ __('adminstaticword.Address') }}:<sup class="redstar">*</sup></label>
            <textarea name="default_address" rows="2" class="form-control" placeholder="Enter your address" required>{{ $setting->default_address }}</textarea>
		</div>
	</div>
	<br>

	<h4 class="box-title">{{ __('adminstaticword.MapCoordinates') }}</h4>

	<div class="row">
		<div class="col-md-6">
            <label for="map_lat">{{ __('adminstaticword.MapEnable') }}:</label>
            <li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="map_enable" type="checkbox" name="map_enable" {{ $gsetting->map_enable == 'map' ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Image" data-tg-on="Map" for="map_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Map on contact page)</small>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row" style="{{ $setting['map_enable'] == 'image' ? '' : 'display:none' }}" id="sec_one">
				<div class="col-md-6">
					<label for="contact_image">{{ __('adminstaticword.ContactPageImage') }}:</label>
					<br>
		            <input type="file" name="contact_image" value="{{ $setting->contact_image }}" id="contact" class="{{ $errors->has('contact_image') ? ' is-invalid' : '' }} inputfile inputfile-1">

		            <label for="contact"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseaimage') }}</span></label>
				</div>
				<div class="col-md-6">
					@if($setting->contact_image !="")
						<div class="contact-settings">
							<img src="{{ asset('images/contact/'.$setting->contact_image) }}" alt="{{ $setting->contact_image }}" class="img-responsive">
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<br>

	<div class="row" style="{{ $setting['map_enable'] == 'map' ? '' : 'display:none' }}" id="sec1_one">
		<div class="col-md-4">
            <label for="map_lat">{{ __('adminstaticword.MapLatitude') }}:</label>
            <input value="{{ $setting->map_lat }}" name="map_lat" placeholder="Enter Latitude" type="text" class="{{ $errors->has('map_lat') ? ' is-invalid' : '' }} form-control">
		</div>
		<div class="col-md-4">
			<label for="map_long">{{ __('adminstaticword.MapLongitude') }}:</label>
            <input value="{{ $setting->map_long }}" name="map_long" placeholder="Enter Longitude" type="text" class="{{ $errors->has('map_long') ? ' is-invalid' : '' }} form-control">
		</div>
		<div class="col-md-4">
			<label for="map_api">{{ __('adminstaticword.MapApiKey') }}:</label>
            <input value="{{ $setting->map_api }}" name="map_api" placeholder="Enter Map Api" type="text" class="{{ $errors->has('map_api') ? ' is-invalid' : '' }} form-control">
		</div>
	</div>
	
	<hr>

	<h4 class="box-title">{{ __('adminstaticword.PromoBar') }}</h4>

	<div class="row">
		<div class="col-md-6">
            <label for="promo_enable">{{ __('adminstaticword.PromoEnable') }}: </label> (Enable Promobar on site)
            <li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="promo_enable" type="checkbox" name="promo_enable" {{ $gsetting->promo_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="promo_enable"></label>
	        </li>
	        <div>
	            <small></small>
			</div>
		</div>
	</div>
	<br>
	<div class="row" style="{{ $setting['promo_enable'] == 1 ? '' : 'display:none' }}" id="sec2_one">
		<div class="col-md-6">
            <label for="promo_text">{{ __('adminstaticword.PromoText') }}:</label>
            <input value="{{ $setting->promo_text }}" name="promo_text" placeholder="Enter Promo Text" type="text" class="{{ $errors->has('promo_text') ? ' is-invalid' : '' }} form-control">
		</div>
		<div class="col-md-6">
			<label for="promo_link">{{ __('adminstaticword.PromoLink') }}:</label>
            <input value="{{ $setting->promo_link }}" name="promo_link" placeholder="Enter Promo Text Link" type="text" class="{{ $errors->has('promo_link') ? ' is-invalid' : '' }} form-control">
		</div>
	</div>
	<hr>



	<h4 class="box-title">{{ __('adminstaticword.FacebookChatBubble') }}</h4>

	<div class="row">
		<div class="col-md-12">
			 
            <label for="promo_text">{{ __('adminstaticword.FacebookChatBubble') }}:</label>
            <input value="{{ $setting->chat_bubble }}" name="chat_bubble" placeholder="Enter Your Chat Bubble Link" type="text" class="{{ $errors->has('chat_bubble') ? ' is-invalid' : '' }} form-control">

            <small>Facebook Bubble Chat will not work on localhost (eg. xampp & wampp)</small>
			<br>
			<small><a target="__blank" href="https://app.respond.io/">Get URL For Facebook Messenger Chat Bubble</a></small>
		</div>
		
	</div>

	<hr>


	<h4 class="box-title">{{ __('adminstaticword.AppDownload') }}</h4>

	<div class="row">
		<div  class="col-md-2">
			<label for="">{{ __('App Store') }}: </label>
			<br>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="app_download" type="checkbox" name="app_download" {{ $gsetting->app_download == '1' ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="app_download"></label>
            </li>
            <input type="hidden" name="free" value="0" for="app_download" id="app_download"> 
		</div>
		<div  class="col-md-10">

			<label for="promo_text">{{ __('adminstaticword.Link') }}:</label>
            <input value="{{ $setting->app_link }}" name="app_link" placeholder="Enter Link" type="text" class="{{ $errors->has('app_link') ? ' is-invalid' : '' }} form-control">
			
		</div>
		
	</div>

	<br>


	<div class="row">
		<div  class="col-md-2">
			<label for="">{{ __('Play Store') }}: </label>
			<br>
    		<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="play_download" type="checkbox" name="play_download" {{ $setting->play_download == '1' ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="play_download"></label>
            </li>
            <input type="hidden" id="play_download" name="free" value="0" for="play_download" id="play_download"> 
		</div>
		<div  class="col-md-10">

			<label for="promo_text">{{ __('adminstaticword.Link') }}:</label>
            <input value="{{ $setting->play_link }}" name="play_link" placeholder="Enter Link" type="text" class="{{ $errors->has('play_link') ? ' is-invalid' : '' }} form-control">
			
		</div>
		
	</div>


	<hr>

	<h4 class="box-title">{{ __('Donation link') }}</h4>

	<div class="row">
		<div  class="col-md-2">
			<label for="">{{ __('Donation link') }}: </label>
			<br>
    		<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="donation_enable" type="checkbox" name="donation_enable" {{ $setting->donation_enable == '1' ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="donation_enable"></label>
            </li>
            <input type="hidden" id="donation_enable" name="free" value="0" for="donation_enable" id="donation_enable"> 
		</div>
		<div  class="col-md-10">

			<label for="promo_text">{{ __('adminstaticword.Link') }}:</label>
            <input value="{{ $setting->donation_link }}" name="donation_link" placeholder="Enter Link" type="text" class="{{ $errors->has('donation_link') ? ' is-invalid' : '' }} form-control">



			<small>Get Donation link by register on <a target="__blank" href="https://www.paypal.com/in/webapps/mpp/paypal-me"> Paypal.me</a></small>
			
		</div>





		
	</div>


	<hr>
	

	<div class="row">
		<div class="col-md-6">
			<br>
			<div class="row">
				<div  class="col-md-6">
					<label for="">{{ __('adminstaticword.RightClick') }}: </label>
					<br>
					<li class="tg-list-item">              
			            <input class="tgl tgl-skewed" id="cb3" type="checkbox" name="rightclick" {{ $gsetting->rightclick == '0' ? 'checked' : '' }} >
			            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cb3"></label>
		            </li>
		            <input type="hidden"  name="free" value="0" for="cb3" id="cb3"> 
				</div>
				<div  class="col-md-6">
					<label for="">{{ __('adminstaticword.InspectElement') }}: </label>
					<br>
		    		<li class="tg-list-item">              
			            <input class="tgl tgl-skewed" id="cb4" type="checkbox" name="inspect" {{ $setting->inspect == '0' ? 'checked' : '' }} >
			            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cb4"></label>
		            </li>
		            <input type="hidden" id="inspect" name="free" value="0" for="cb4" id="cb4">
				</div>
				
			</div>
		</div>
		<div class="col-md-3">
			<br>
        	<label for="">{{ __('adminstaticword.PreloaderEnable') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="preloader" type="checkbox" name="preloader_enable" {{ $gsetting->preloader_enable == '1' ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="preloader"></label>
            </li>
            <input type="hidden"  name="free" value="0" for="preloader" id="preloader">
        </div>
        <div  class="col-md-3">
        	<br>
            <label>{{ __('adminstaticword.APPDebug') }}:</label>
            <br>
            <li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="debug" type="checkbox" name="APP_DEBUG" {{ env('APP_DEBUG') == true ? "checked" : "" }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="debug"></label>
            </li>
            <input type="hidden"  name="free" value="0" for="debug" id="debug">
		</div>
	</div>
	

	<hr>

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div >
						<label for="">{{ __('adminstaticword.WelcomeEmail') }}: </label>

						<li class="tg-list-item">              
				            <input class="tgl tgl-skewed" id="welmail" type="checkbox" name="w_email_enable" {{ $gsetting->w_email_enable == '1' ? 'checked' : '' }} >
				            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="welmail"></label>
			            </li>
			            <input type="hidden"  name="free" value="0" for="welmail" id="welmail">
			          
					</div>
				</div>
				<div class="col-md-6">
					<div >
						<label for="">{{ __('adminstaticword.VerifyEmail') }}: </label>

						<li class="tg-list-item">              
				            <input class="tgl tgl-skewed" id="verify" type="checkbox" name="verify_enable" {{ $gsetting->verify_enable == '1' ? 'checked' : '' }} >
				            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="verify"></label>
			            </li>
			            <input type="hidden" name="free" value="0" for="verify" id="verify">
			          
					</div>
				</div>
			</div>

			<div>
	            <small>(If you enable it, a welcome email will be sent to user's register email id,<br> make sure you updated your mail setting in Site Setting >> Mail Settings before enable it.)</small>
      			<small class="text-danger">{{ $errors->first('color') }}</small> 
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-3">
	        	<label for="">{{ __('adminstaticword.BecomeAnInstructor') }}: </label>
				<li class="tg-list-item">              
		            <input class="tgl tgl-skewed" id="instructor" type="checkbox" name="instructor_enable" {{ $gsetting->instructor_enable == '1' ? 'checked' : '' }} >
		            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="instructor"></label>
	            </li>
	            <input type="hidden"  name="free" value="0" for="instructor" id="instructor">
	            <div>
		            <small>(Enable Become an instructor option for users)</small>
	      			<small class="text-danger">{{ $errors->first('color') }}</small> 
				</div>
	        </div>
	        <div class="col-md-3">
	        	<label for="">{{ __('adminstaticword.CategoryMenu') }}: </label>
				<li class="tg-list-item">              
		            <input class="tgl tgl-skewed" id="cat_enable" type="checkbox" name="cat_enable" {{ $gsetting->cat_enable == '1' ? 'checked' : '' }} >
		            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cat_enable"></label>
	            </li>
	            <input type="hidden"  name="free" value="0" for="cat_enable" id="cat_enable">
	            <div>
		            <small>(If you enable it, Category menu will show on instructor Dashboard)</small>
	      			<small class="text-danger">{{ $errors->first('color') }}</small> 
				</div>
	        </div>

	    </div>
		
	</div>
	<hr>

    <div class="row">
    	

    	<div class="col-md-3">
	    	<label for="">{{ __('Mobile no. on SignUp') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="mobile_enable" type="checkbox" name="mobile_enable" {{ $gsetting->mobile_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="mobile_enable"></label>
	        </li>
	        <div>
	            <small>(Enable mobile no. on SignUp)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.DeviceControl') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="device_enable" type="checkbox" name="device_enable" {{ $gsetting->device_control == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="device_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Device Control on Courses)</small>
			</div>
    	</div>

    	

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.CookieNotice') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="cookie_enable" type="checkbox" name="cookie_enable" {{ $gsetting->cookie_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cookie_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Cookie Notice on Site)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.IPBlock') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="ipblock_enable" type="checkbox" name="ipblock_enable" {{ $gsetting->ipblock_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="ipblock_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Ip block on portal)</small>
			</div>
    	</div>

    	

    </div>
    <hr>

    <div class="row">

    	
    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.ActivityLog') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="activity_enable" type="checkbox" name="activity_enable" {{ $gsetting->activity_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="activity_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Users Activity Logs on Login/Register)</small>
			</div>
    	</div>
    	

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.Assignment') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="assignment_enable" type="checkbox" name="assignment_enable" {{ $gsetting->assignment_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="assignment_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Assignment on Course)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.Appointment') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="appointment_enable" type="checkbox" name="appointment_enable" {{ $gsetting->appointment_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="appointment_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Appointment on Course)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.CertificateEnable') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="certificate_enable" type="checkbox" name="certificate_enable" {{ $gsetting->certificate_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="certificate_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Certificate on courses)</small>
			</div>
    	</div>

    </div>

    <hr>

    <div class="row">

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.HideIdentity') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="hide_identity" type="checkbox" name="hide_identity" {{ $gsetting->hide_identity == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="hide_identity"></label>
	        </li>
	        <div>
	            <small>(Hide User Indentity from Instructor)</small>
			</div>
    	</div>


    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.CourseHover') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="course_hover" type="checkbox" name="course_hover" {{ $gsetting->course_hover == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="course_hover"></label>
	        </li>
	        <div>
	            <small>(Enable/Disable Hover from home sliders)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('Currency Swipe') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="currency_swipe" type="checkbox" name="currency_swipe" {{ $gsetting->currency_swipe == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Before" data-tg-on="After" for="currency_swipe"></label>
	        </li>
	        <div>
	            <small>(Swipe currency before/after icon)</small>
			</div>
    	</div>

    	<div class="col-md-3">
	    	<label for="">{{ __('Attandance') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="attandance_enable" type="checkbox" name="attandance_enable" {{ $gsetting->attandance_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="attandance_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Attandance on Courses)</small>
			</div>
    	</div>

    	
    </div>

    <hr>


    <h4 class="box-title">{{ __('adminstaticword.LiveMeetings') }}</h4>

    <div class="row">

    	


    	<div class="col-md-3">
	    	<label for="">{{ __('Enable Zoom On Portal') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="zoom_enable" type="checkbox" name="zoom_enable" {{ $gsetting->zoom_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="zoom_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Live zoom meetings on portal)</small>
			</div>
    	</div>


    	<div class="col-md-3">
	    	<label for="">{{ __('Enable Big Blue Meetings') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="bbl_enable" type="checkbox" name="bbl_enable" {{ $gsetting->bbl_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="bbl_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Big Blue meetings on portal)</small>
			</div>
    	</div>

    	

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.GoogleMeet') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="googlemeet_enable" type="checkbox" name="googlemeet_enable" {{ $gsetting->googlemeet_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="googlemeet_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Google Meet on portal)</small>
			</div>
    	</div>

    	

    	<div class="col-md-3">
	    	<label for="">{{ __('adminstaticword.JitsiMeeting') }}: </label>
			<li class="tg-list-item">              
	            <input class="tgl tgl-skewed" id="jitsimeet_enable" type="checkbox" name="jitsimeet_enable" {{ $gsetting->jitsimeet_enable == 1 ? 'checked' : '' }} >
	            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="jitsimeet_enable"></label>
	        </li>
	        <div>
	            <small>(Enable Jitsi Meeting on Portal)</small>
			</div>
    	</div>

    </div>

    <hr>

    <div class="row">
    	
    </div>

    
	<br>
	<br>
	
	<div class="box-footer">
		<button type="Submit" class="btn btn-lg col-md-3 btn-primary btn-md"><i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}</button>
	</div>

</form>
