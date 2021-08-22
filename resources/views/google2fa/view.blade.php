@extends('theme.master')
@section('title', '2FA')
@section('content')

@include('admin.message')
@include('sweetalert::alert')

<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">Two Factor Authentication</h1>
    </div>
</section> 
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">

        <div class="row">
           
            <div class="col-xl-12 col-lg-12">

            	       <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                        @if($QR_Image == '')

                         
						<form action="{{ route('generate2faSecret') }}" method="POST">
							@csrf
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									{{ __('frontstaticword.GenerateSecretKeytoEnable2FA') }}
								</button>
							</div>

						</form>

                        @endif

                        @if($QR_Image != '' )

                        1. Scan this QR code with your Google Authenticator App. <code></code>
                        <br/>

                        <br/>

						<div>
                        	<img src="{!! $QR_Image !!}">
                    	</div>
                        @endif

                        <br/><br/>

                    	
                        @if(Auth::user()->google2fa_secret != '' && Auth::user()->google2fa_enable == 0 )
                        2. Enter the pin from Google Authenticator app:<br/><br/>
						<form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>

                            <div class="col-md-6">
                                <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                            </div>
                        </div>

                       



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>


                     @endif

                     @if(Auth::user()->google2fa_enable == 1)

                     <div class="alert alert-success">
                                2FA is currently <strong>enabled</strong> on your account.
                            </div>
                            <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>

                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="control-label">Current Password</label>
                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-primary ">Disable 2FA</button>
                            </form>


                            @endif
						


                
            </div>
        </div>
    </div>
</section>
<!-- profile update end -->
@endsection

@section('custom-script')


@endsection
