@extends('admin.layouts.master')
@section('title', 'API Setting - Admin')
@section('body')
 
<section class="content">
   	@include('admin.message')
  	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              		<h3 class="box-title">{{ __('adminstaticword.APISetting') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ route('api.update') }}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('POST') }}
						
						<div class="row">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.STRIPEPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="s_sec1" type="checkbox" name="stripe_check" {{ $gsetting->stripe_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="s_sec1"></label>
		                        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->stripe_enable==1 ? '' : 'display:none' }}" id="s_sec">
		                          <div class="col-md-6">
				                    <label for="STRIPE_KEY">{{ __('adminstaticword.StripeKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['STRIPE_KEY'] }}" autofocus name="STRIPE_KEY" type="text" class="form-control" placeholder="Enter Stripe Key"/>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="s_secretkey">{{ __('adminstaticword.StripeSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['STRIPE_SECRET'] }}" autofocus name="STRIPE_SECRET" type="text" class="form-control" placeholder="Enter Stripe Secret Key"/>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

		              	<div class="row">
							<div class="col-md-12">
		                        <label for="pay_enable">{{ __('adminstaticword.PAYPALPAYMENT') }}</label> 
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="pay_sec1" type="checkbox" name="paypal_check" {{ $gsetting->paypal_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="pay_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ $gsetting->paypal_enable==1 ? '' : 'display:none' }}" id="pay_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">{{ __('adminstaticword.PaypalClientID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" autofocus name="PAYPAL_CLIENT_ID" type="text" class="form-control" placeholder="Enter Paypal Client ID"/>
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="pay_sid">{{ __('adminstaticword.PaypalSecretID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYPAL_SECRET'] }}" autofocus name="PAYPAL_SECRET" type="text" class="form-control" placeholder="Enter Paypal Secret ID"/>
					                    <br>
					                </div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">{{ __('adminstaticword.PaypalMode') }}<sup class="redstar">*</sup></label>
				                    	<input value="{{ $env_files['PAYPAL_MODE'] }}" autofocus name="PAYPAL_MODE" type="text" class="form-control" placeholder="Enter Paypal Mode"/>
				                    	<small class="text-muted"><i class="fa fa-question-circle"></i> For Test use <b>"sandbox"</b> and for Live use <b>"live"</b></small>
				                  	</div>

				              	</div>
		                    </div>
		                </div>
						<br>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="pay_enable">{{ __('adminstaticword.INSTAMOJOPAYMENT') }}</label> 
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="insta_sec1" type="checkbox" name="instamojo_check" {{ $gsetting->instamojo_enable==1 ? 'checked' : '' }} />
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="insta_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ $gsetting->instamojo_enable==1 ? '' : 'display:none' }}" id="insta_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">{{ __('adminstaticword.InstaMojoApiKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['IM_API_KEY'] }}" autofocus name="IM_API_KEY" type="text" class="form-control" placeholder="Enter InstaMojo Api Key"/>
					                    <br>
					                </div>

					                <div class="col-md-6">
					                    <label for="pay_sid">{{ __('adminstaticword.InstaMojoAuthToken') }} <sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['IM_AUTH_TOKEN'] }}" autofocus name="IM_AUTH_TOKEN" type="text" class="form-control" placeholder="Enter InstaMojo Auth Token"/>
					                    <br>
					                </div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">{{ __('adminstaticword.InstaMojoURL') }}<sup class="redstar">*</sup></label>
				                    	<input value="{{ $env_files['IM_URL'] }}" autofocus name="IM_URL" type="text" class="form-control" placeholder="Enter InstaMojo Url"/>
				                    	<small class="text-muted"><i class="fa fa-question-circle"></i> For Test use <b>https://test.instamojo.com/api/1.1/</b> <br>
				                    	<i class="fa fa-question-circle"></i> For Live use <b>https://www.instamojo.com/api/1.1/</b></small>
				                  	</div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">InstaMojo Refund URL<sup class="redstar">*</sup></label>
				                    	<input value="{{ $env_files['IM_REFUND_URL'] }}" autofocus name="IM_REFUND_URL" type="text" class="form-control" placeholder="Enter InstaMojo Url"/>
				                    	<small class="text-muted"><i class="fa fa-question-circle"></i> For Test use <b>https://test.instamojo.com/api/1.1/refunds/</b> <br>
				                    	<i class="fa fa-question-circle"></i> For Live use <b>https://instamojo.com/api/1.1/refunds/</b></small>
				                  	</div>
				              	</div>
		                    </div>
		                </div>
						<br>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="razorpay_enable">{{ __('adminstaticword.RAZORPAYPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="razor_sec1" type="checkbox" name="razor_check" {{ $gsetting->razorpay_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="razor_sec1"></label>
		                        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->razorpay_enable==1 ? '' : 'display:none' }}" id="razor_sec">
		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.RazorpayKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['RAZORPAY_KEY'] }}" autofocus name="RAZORPAY_KEY" type="text" class="form-control" placeholder="Enter Razorpay Key"/>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.RazorpaySecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['RAZORPAY_SECRET'] }}" autofocus name="RAZORPAY_SECRET" type="text" class="form-control" placeholder="Enter Razorpay Secret Key"/>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

		              	<div class="row">
							<div class="col-md-12">
		                        <label for="paystack_enable">{{ __('adminstaticword.PAYSTACKPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="paystack_sec1" type="checkbox" name="paystack_check" {{ $gsetting->paystack_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="paystack_sec1"></label>
		                        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->paystack_enable==1 ? '' : 'display:none' }}" id="paystack_sec">
		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.PayStackPublicKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_PUBLIC_KEY'] }}" autofocus name="PAYSTACK_PUBLIC_KEY" type="text" class="form-control" placeholder="Enter Paystack Public Key"/>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PayStackSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_SECRET_KEY'] }}" autofocus name="PAYSTACK_SECRET_KEY" type="text" class="form-control" placeholder="Enter Paystack Secret Key"/>
				                    <br>
				                  </div>

				              
		                          <div class="col-md-6">
				                    <label for="RAZORPAY_KEY">{{ __('adminstaticword.PayStackPaymentUrl') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_PAYMENT_URL'] }}" autofocus name="PAYSTACK_PAYMENT_URL" type="text" class="form-control" placeholder="Enter Paystack Payment URL"/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> use <b>https://api.paystack.co</b> </small>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PayStackMerchantEmail') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYSTACK_MERCHANT_EMAIL'] }}" autofocus name="PAYSTACK_MERCHANT_EMAIL" type="text" class="form-control" placeholder="Enter Paystack Merchant Email"/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> use <b>Paystack email</b> </small>
				                    <br>
				                    <br>

				                  </div>
				                  


				                  <div class="col-md-6">
				                    <label for="RAZORPAY_SECRET">{{ __('adminstaticword.PaystackCallbackURL') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ url('callback') }}" autofocus type="text" class="form-control" placeholder="" disabled/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> use <b>this callback url in Paystack account</b> </small>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.PAYTMPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="paytm_sec1" type="checkbox" name="paytm_check" {{ $gsetting->paytm_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="paytm_sec1"></label>
		                        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->paytm_enable==1 ? '' : 'display:none' }}" id="paytm_sec">

		                          <div class="col-md-6">
		                          	<div class="form-group">
					                    <label for="PAYTM_ENVIRONMENT">{{ __('adminstaticword.PaytmEnviroment') }}<sup class="redstar">*</sup></label>
					                    <small class="text-muted"><i class="fa fa-question-circle"></i> For Test use <b>"local"</b> and for Live use <b>"production"</b></small>
					                    <input value="{{ $env_files['PAYTM_ENVIRONMENT'] }}" autofocus name="PAYTM_ENVIRONMENT" type="text" class="form-control" placeholder="Enter Paytm Enviroment"/>
					                    
				                    </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_ID">{{ __('adminstaticword.PaytmMerchantID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_ID'] }}" autofocus name="PAYTM_MERCHANT_ID" type="text" class="form-control" placeholder="Enter Paytm Merchant Id"/>

					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_KEY">{{ __('adminstaticword.PaytmMerchantKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_KEY'] }}" autofocus name="PAYTM_MERCHANT_KEY" type="text" class="form-control" placeholder="Enter Paytm Merchant Key"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_MERCHANT_WEBSITE">{{ __('adminstaticword.PaytmMerchantWebsite') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_MERCHANT_WEBSITE'] }}" autofocus name="PAYTM_MERCHANT_WEBSITE" type="text" class="form-control" placeholder="Enter Paytm Merchant Website"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_CHANNEL">{{ __('adminstaticword.PaytmChannel') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_CHANNEL'] }}" autofocus name="PAYTM_CHANNEL" type="text" class="form-control" placeholder="Enter Paytm Channel"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_INDUSTRY_TYPE">{{ __('adminstaticword.PaytmIndustryType') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['PAYTM_INDUSTRY_TYPE'] }}" autofocus name="PAYTM_INDUSTRY_TYPE" type="text" class="form-control" placeholder="Enter Paytm Industry Type"/>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="s_enable">{{ __('adminstaticword.ReCaptcha') }}</label>
		                        <li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="captcha_sec1" type="checkbox" name="captcha_check" {{ $gsetting->captcha_enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="captcha_sec1"></label>
						        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->captcha_enable==1 ? '' : 'display:none' }}" id="captcha_sec">

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_CHANNEL">{{ __('adminstaticword.CaptchaSiteKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['NOCAPTCHA_SITEKEY'] }}" autofocus name="NOCAPTCHA_SITEKEY" type="text" class="form-control" placeholder="Enter Captcha Site Key"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="PAYTM_INDUSTRY_TYPE">{{ __('adminstaticword.CaptchaSecretKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['NOCAPTCHA_SECRET'] }}" autofocus name="NOCAPTCHA_SECRET" type="text" class="form-control" placeholder="Enter Captcha Secret Key"/>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="aws_enable">{{ __('adminstaticword.AWSSettings') }}</label>
		                        <li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="aws_sec1" type="checkbox" name="aws_check" {{ $gsetting->aws_enable == 1 ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="aws_sec1"></label>
						        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->aws_enable==1 ? '' : 'display:none' }}" id="aws_sec">

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_ACCESS_KEY_ID">{{ __('adminstaticword.AWSAccessKeyID') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_ACCESS_KEY_ID'] }}" autofocus name="AWS_ACCESS_KEY_ID" type="text" class="form-control" placeholder="Enter AWS Access Key Id"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_SECRET_ACCESS_KEY">{{ __('adminstaticword.AWSSecretAccessKey') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_SECRET_ACCESS_KEY'] }}" autofocus name="AWS_SECRET_ACCESS_KEY" type="text" class="form-control" placeholder="Enter AWS Secret Access Key"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_DEFAULT_REGION">{{ __('adminstaticword.AWSDefaultRegion') }}<sup class="redstar">*</sup></label>
					                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="eg:ap-south-1"></i>
					                    <input value="{{ $env_files['AWS_DEFAULT_REGION'] }}" autofocus name="AWS_DEFAULT_REGION" type="text" class="form-control" placeholder="Enter AWS Default Region"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_BUCKET">{{ __('adminstaticword.AWSBucketName') }}<sup class="redstar">*</sup></label>
					                    <input value="{{ $env_files['AWS_BUCKET'] }}" autofocus name="AWS_BUCKET" type="text" class="form-control" placeholder="Enter AWS Bucket Name"/>
					                </div>
				                  </div>

				                  <div class="col-md-6">
				                  	<div class="form-group">
					                    <label for="AWS_URL">{{ __('adminstaticword.AWSURL') }}<sup class="redstar">*</sup></label>
					                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="eg:https://bucket-name.s3.Region.amazonaws.com/"></i>
					                    <input value="{{ $env_files['AWS_URL'] }}" autofocus name="AWS_URL" type="text" class="form-control" placeholder="Enter AWS URL eg:https://bucket-name.s3.Region.amazonaws.com/"/>

					                    <small class="text-muted"><i class="fa fa-question-circle"></i>  eg: https://bucket-name.s3.Region.amazonaws.com/</small>
					                </div>
				                  </div>

				              	</div>
		                    </div>
		                </div>
						<br>


						<div class="row">
                            <div class="col-md-12">
                                <label for="enable_omise">{{ __('Omise Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_omise" type="checkbox" name="enable_omise"
                                        {{ $gsetting->enable_omise == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="enable_omise"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->enable_omise == 1 ? '' : 'display:none' }}"
                                    id="omise_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="OMISE_PUBLIC_KEY">{{ __('OMISE PUBLIC KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('OMISE_PUBLIC_KEY') }}" autofocus
                                                name="OMISE_PUBLIC_KEY" type="text" class="form-control"
                                                placeholder="Enter omise app public key" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="OMISE_SECRET_KEY">{{ __('Omise Secret Key') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('OMISE_SECRET_KEY') }}" autofocus
                                                name="OMISE_SECRET_KEY" type="text" class="form-control"
                                                placeholder="Enter omise secret key" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="OMISE_API_VERSION">{{ __('OMISE API VERSION') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('OMISE_API_VERSION') }}" autofocus
                                                name="OMISE_API_VERSION" type="text" class="form-control"
                                                placeholder="Enter omise api version" />
                                            <small class="text-muted">
                                                • Check API VERSION <a
                                                    href="https://dashboard.omise.co/api-version/edit">HERE</a>
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('PayUBiz/Money Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_payu" type="checkbox" name="enable_payu"
                                        {{ $gsetting->enable_payu == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="enable_payu"></label>
                                </li>


                                <br>
                                <div class="row" style="{{ $gsetting->enable_payu == 1 ? '' : 'display:none' }}"
                                    id="payu_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYU_DEFAULT">{{ __('PAYU DEFAULT') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYU_DEFAULT') }}" autofocus name="PAYU_DEFAULT"
                                                type="text" class="form-control" placeholder="Choose Payu Enviroment" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Choose
                                                <b>"payubiz"</b> or <b>"payumoney"</b> option</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYU_METHOD">{{ __('PAYU METHOD') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYU_METHOD') }}" autofocus name="PAYU_METHOD"
                                                type="text" class="form-control"
                                                placeholder="Choose PAYU METHOD Enviroment" />

                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For Test use
                                                <b>"test"</b> and for Live use <b>"secure"</b> method</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYU_MERCHANT_KEY">{{ __('PAYU MERCHANT KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYU_MERCHANT_KEY') }}" autofocus
                                                name="PAYU_MERCHANT_KEY" type="text" class="form-control"
                                                placeholder="Enter PAYU MERCHANT KEY" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Enter Payu
                                                Merchant key.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYU_MERCHANT_SALT">{{ __('PAYU MERCHANT SALT') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYU_MERCHANT_SALT') }}" autofocus
                                                name="PAYU_MERCHANT_SALT" type="text" class="form-control"
                                                placeholder="Enter PAYU MERCHANT SALT" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Enter Payu
                                                Merchant salt key.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYU_AUTH_HEADER">{{ __('PAYU AUTH HEADER') }}</label>
                                            <input value="{{ env('PAYU_AUTH_HEADER') }}" autofocus
                                                name="PAYU_AUTH_HEADER" type="text" class="form-control"
                                                placeholder="Enter PAYU AUTH HEADER" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Required if
                                                method is <b>Payumoney</b></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payu_money">{{ __('PayU Money Account ?') }}<sup
                                                    class="redstar">*</sup></label>
                                            <li class="tg-list-item">
                                                <input class="tgl tgl-skewed" id="payu_money" type="checkbox"
                                                    name="payu_money"
                                                    {{ env('PAYU_MONEY_TRUE') == true ? 'checked' : '' }} />
                                                <label class="tgl-btn" data-tg-off="NO" data-tg-on="YES"
                                                    for="payu_money"></label>
                                            </li>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Moli Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_moli" type="checkbox" name="enable_moli"
                                        {{ $gsetting->enable_moli == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="enable_moli"></label>
                                </li>


                                <br>
                                <div class="row" style="{{ $gsetting->enable_moli == 1 ? '' : 'display:none' }}"
                                    id="moli_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="MOLLIE_KEY">{{ __('MOLI API KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('MOLLIE_KEY') }}" autofocus name="MOLLIE_KEY"
                                                type="text" class="form-control" placeholder="Enter Moli Api Key" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Enter Moli
                                                Api Key</small>
                                            <br>
                                            <small class="text-muted">
                                                <b>Supported Moli Currency</b> : <a title="Moli Supported Currency List"
                                                    href="https://docs.mollie.com/payments/multicurrency">https://docs.mollie.com/payments/multicurrency</a>
                                            </small>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Cashfree Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_cashfree" type="checkbox"
                                        name="enable_cashfree" {{ $gsetting->enable_cashfree == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="enable_cashfree"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->enable_cashfree == 1 ? '' : 'display:none' }}"
                                    id="cf_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CASHFREE_APP_ID">{{ __('CASHFREE APP ID') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('CASHFREE_APP_ID') }}" autofocus name="CASHFREE_APP_ID"
                                                type="text" class="form-control" placeholder="Enter cashfree app id" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please enter
                                                Cashfree <b>APP ID</b></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CASHFREE_SECRET_KEY">{{ __('CASHFREE SECRET KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('CASHFREE_SECRET_KEY') }}" autofocus
                                                name="CASHFREE_SECRET_KEY" type="text" class="form-control"
                                                placeholder="Enter CASHFREE SECRET KEY " />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Please enter
                                                Cashfree <b>Secret Key</b></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CASHFREE_END_POINT">{{ __('CASHFREE END POINT') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('CASHFREE_END_POINT') }}" autofocus
                                                name="CASHFREE_END_POINT" type="text" class="form-control"
                                                placeholder="Enter Cashfree end point Url" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i>
                                                • For <b>Live</b> use : https://api.cashfree.com
                                                <b>|</b>
                                                • For <b>Test</b> use : https://test.cashfree.com
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Skrill Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_skrill" type="checkbox"
                                        name="enable_skrill" {{ $gsetting->enable_skrill == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="enable_skrill"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->enable_skrill == 1 ? '' : 'display:none' }}"
                                    id="sk_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="SKRILL_MERCHANT_EMAIL">{{ __('SKRILL MERCHANT EMAIL') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('SKRILL_MERCHANT_EMAIL') }}" autofocus
                                                name="SKRILL_MERCHANT_EMAIL" type="text" class="form-control"
                                                placeholder="Enter skrill merchant email" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For
                                                <b>test</b> use <b>demoqco@sun-fish.com</b></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="SKRILL_API_PASSWORD">{{ __('SKRILL API PASSWORD') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('SKRILL_API_PASSWORD') }}" autofocus
                                                name="SKRILL_API_PASSWORD" type="text" class="form-control"
                                                placeholder="Enter skrill api password" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For
                                                <b>test</b> use <b>skrill</b></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="SKRILL_LOGO_URL">{{ __('SKRILL APP LOGO URL') }}</label>
                                            <input value="{{ env('SKRILL_LOGO_URL') }}" autofocus name="SKRILL_LOGO_URL"
                                                type="url" class="form-control" placeholder="Enter app logo url" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i>Enter your
                                                site logo url here.</small>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="enable_rave">{{ __('FlutterRave Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_rave" type="checkbox" name="enable_rave"
                                        {{ $gsetting->enable_rave == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="enable_rave"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->enable_rave == 1 ? '' : 'display:none' }}"
                                    id="rave_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_PUBLIC_KEY">{{ __('RAVE PUBLIC KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_PUBLIC_KEY') }}" autofocus name="RAVE_PUBLIC_KEY"
                                                type="text" class="form-control"
                                                placeholder="Enter rave public email" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Public Key:
                                                Your Rave publicKey. Sign up on <a
                                                    href="https://rave.flutterwave.com/">https://rave.flutterwave.com/</a>
                                                to get one from your settings page</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_SECRET_KEY">{{ __('RAVE SECRET KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_SECRET_KEY') }}" autofocus name="RAVE_SECRET_KEY"
                                                type="text" class="form-control" placeholder="Enter rave secret key" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Secret Key:
                                                Your Rave secretKey. Sign up on <a
                                                    href="https://rave.flutterwave.com/">https://rave.flutterwave.com/</a>
                                                to get one from your settings page</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_ENVIRONMENT">{{ __('RAVE ENVIRONMENT') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_ENVIRONMENT') }}" autofocus
                                                name="RAVE_ENVIRONMENT" type="text" class="form-control"
                                                placeholder="Enter rave app enviroment" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Environment:
                                                This can either be <b>'staging'</b> or <b>'live'</b></small>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_PREFIX">{{ __('RAVE Transcation Prefix') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_PREFIX') }}" autofocus name="RAVE_PREFIX"
                                                type="text" class="form-control"
                                                placeholder="Enter rave transcation prefix" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Prefix: This
                                                is added to the front of your <b>Transaction reference
                                                    numbers</b>.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_COUNTRY">{{ __('RAVE country code') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_COUNTRY') }}" autofocus name="RAVE_COUNTRY"
                                                type="text" class="form-control"
                                                placeholder="Enter rave country code" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Enter rave
                                                country code <b>eg : IN</b>.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="RAVE_LOGO">{{ __('RAVE Buisness APP Logo') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('RAVE_LOGO') }}" autofocus name="RAVE_LOGO" type="text"
                                                class="form-control" placeholder="Enter rave app logo url" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Logo: Enter
                                                the <b>URL</b> of your company/business logo.</small>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Payhere Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="enable_payhere" type="checkbox"
                                        name="enable_payhere" {{ $gsetting->enable_payhere == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="enable_payhere"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->enable_payhere == 1 ? '' : 'display:none' }}"
                                    id="payhere_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYHERE_MERCHANT_ID">{{ __('PAYHERE MERCHANT ID') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYHERE_MERCHANT_ID') }}" autofocus
                                                name="PAYHERE_MERCHANT_ID" type="text" class="form-control"
                                                placeholder="Enter payhere merchant id" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYHERE_BUISNESS_APP_CODE">{{ __('PAYHERE BUISNESS APP CODE') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('PAYHERE_BUISNESS_APP_CODE') }}" autofocus
                                                name="PAYHERE_BUISNESS_APP_CODE" type="text" class="form-control"
                                                placeholder="Enter payhere buisness app code" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYHERE_APP_SECRET">{{ __('PAYHERE APP SECRET') }}</label>
                                            <input value="{{ env('PAYHERE_APP_SECRET') }}" autofocus name="PAYHERE_APP_SECRET"
                                                type="text" class="form-control" placeholder="Enter app logo url" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PAYHERE_MODE">{{ __('PAYHERE MODE') }}</label>
                                            <input value="{{ env('PAYHERE_MODE') }}" autofocus name="PAYHERE_MODE"
                                                type="text" class="form-control" placeholder="Enter payhere mode" />
                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For Test use <b>"sandbox"</b> and for Live use <b>"live"</b></small>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Iyzipay Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="iyzico_enable" type="checkbox"
                                        name="iyzico_enable" {{ $gsetting->iyzico_enable == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="iyzico_enable"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->iyzico_enable == 1 ? '' : 'display:none' }}"
                                    id="iyzico_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="IYZIPAY_BASE_URL">{{ __('IYZIPAY BASE URL') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('IYZIPAY_BASE_URL') }}" autofocus
                                                name="IYZIPAY_BASE_URL" type="text" class="form-control"
                                                placeholder="Enter Iyzipay base url" />

                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For Sandbox use <b>https://sandbox-api.iyzipay.com</b> <br>
				                    		<i class="fa fa-question-circle"></i> For Live use <b>https://api.iyzipay.com</b></small>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="IYZIPAY_API_KEY">{{ __('IYZIPAY API KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('IYZIPAY_API_KEY') }}" autofocus
                                                name="IYZIPAY_API_KEY" type="text" class="form-control"
                                                placeholder="Enter iyzipay api key" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="IYZIPAY_SECRET_KEY">{{ __('IYZIPAY SECRET KEY') }}</label>
                                            <input value="{{ env('IYZIPAY_SECRET_KEY') }}" autofocus name="IYZIPAY_SECRET_KEY"
                                                type="text" class="form-control" placeholder="Enter Iyzipay secret key" />
                                            
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('SSLCommerze Payment Setting') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="ssl_enable" type="checkbox"
                                        name="ssl_enable" {{ $gsetting->ssl_enable == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="ssl_enable"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->ssl_enable == 1 ? '' : 'display:none' }}"
                                    id="ssl_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="API_DOMAIN_URL">{{ __('SSL API DOMAIN URL') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('API_DOMAIN_URL') }}" autofocus
                                                name="API_DOMAIN_URL" type="text" class="form-control"
                                                placeholder="Enter Iyzipay base url" />

                                            <small class="text-muted"><i class="fa fa-question-circle"></i> For Sandbox use <b>https://sandbox.sslcommerz.com</b> <br>
				                    		<i class="fa fa-question-circle"></i> For Live use <b>https://securepay.sslcommerz.com</b></small>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enable LOCALHOST:</label>
                                            <input name="IS_LOCALHOST" id="IS_LOCALHOST"
                                            {{ env('IS_LOCALHOST') == true ? "checked"  :"" }} type="checkbox"
                                            class="tgl tgl-skewed">
                                            <label class="tgl-btn" data-tg-off="False" data-tg-on="True"
                                            for="IS_LOCALHOST"></label>
                                            <small class="txt-desc">(Enable it to when it's when sandbox mode is true.) </small>
                                        </div>
                                        <br>
                                        <br>

                                        <div class="form-group display-none">
                                            <label for="">SANDBOX MODE:</label>
                                            <input name="SANDBOX_MODE" id="SANDBOX_MODE"
                                            {{ env('SANDBOX_MODE') == true ? "checked"  :"" }} type="checkbox"
                                            class="tgl tgl-skewed">
                                            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable"
                                            for="SANDBOX_MODE"></label>
                                            <small class="txt-desc">(Enable or disable sandbox by toggle it.) </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="STORE_ID">{{ __('SSL STORE ID') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('STORE_ID') }}" autofocus
                                                name="STORE_ID" type="text" class="form-control"
                                                placeholder="Enter iyzipay api key" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="STORE_PASSWORD">{{ __('SSL STORE PASSWORD') }}</label>
                                            <input value="{{ env('STORE_PASSWORD') }}" autofocus name="STORE_PASSWORD"
                                                type="text" class="form-control" placeholder="Enter Iyzipay secret key" />
                                            
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Youtube API Keys') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="youtube_enable" type="checkbox"
                                        name="youtube_enable" {{ $gsetting->youtube_enable == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="youtube_enable"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->youtube_enable == 1 ? '' : 'display:none' }}" id="youtube_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="YOUTUBE_API_KEY">{{ __('Youtube API Keys') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('YOUTUBE_API_KEY') }}" autofocus
                                                name="YOUTUBE_API_KEY" type="text" class="form-control"
                                                placeholder="Enter Iyzipay base url" />
                                           
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <br>



                        <div class="row">
                            <div class="col-md-12">
                                <label for="s_enable">{{ __('Vimeo API Keys') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="vimeo_enable" type="checkbox"
                                        name="vimeo_enable" {{ $gsetting->vimeo_enable == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="vimeo_enable"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->vimeo_enable == 1 ? '' : 'display:none' }}"
                                    id="vimeo_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="VIMEO_CLIENT">{{ __('VIMEO_CLIENT') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('VIMEO_CLIENT') }}" autofocus
                                                name="VIMEO_CLIENT" type="text" class="form-control"
                                                placeholder="Enter vimeo client" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="VIMEO_SECRET">{{ __('VIMEO SECRET') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('VIMEO_SECRET') }}" autofocus
                                                name="VIMEO_SECRET" type="text" class="form-control"
                                                placeholder="Enter vimeo secret" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="VIMEO_ACCESS">{{ __('VIMEO ACCESS') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('VIMEO_ACCESS') }}" autofocus
                                                name="VIMEO_ACCESS" type="text" class="form-control"
                                                placeholder="Enter vimeo access key" />
                                            
                                        </div>
                                    </div>

                                   



                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="aamarpay_enable">{{ __('AAMAR PAY API KEYS') }}</label>
                                <li class="tg-list-item">
                                    <input class="tgl tgl-skewed" id="aamarpay_enable" type="checkbox"
                                        name="aamarpay_enable" {{ $gsetting->aamarpay_enable == 1 ? 'checked' : '' }} />
                                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON"
                                        for="aamarpay_enable"></label>
                                </li>
                                <br>
                                <div class="row" style="{{ $gsetting->aamarpay_enable == 1 ? '' : 'display:none' }}"
                                    id="aamarpay_sec">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AAMARPAY_STORE_ID">{{ __('AAMARPAY STORE ID') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('AAMARPAY_STORE_ID') }}" autofocus
                                                name="AAMARPAY_STORE_ID" type="text" class="form-control"
                                                placeholder="Enter Aamarpay store ID" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AAMARPAY_KEY">{{ __('AAMARPAY SIGNATURE KEY') }}<sup
                                                    class="redstar">*</sup></label>
                                            <input value="{{ env('AAMARPAY_KEY') }}" autofocus
                                                name="AAMARPAY_KEY" type="text" class="form-control"
                                                placeholder="Enter Aamarpay key" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                      
                                        <div class="form-group">
                                            <label for="aamar_pay">{{ __('AAMARPAY SANDBOX ?') }}</label>
                                            <li class="tg-list-item">
                                                <input class="tgl tgl-skewed" id="aamar_pay" type="checkbox" name="AAMARPAY_SANDBOX" {{ env('AAMARPAY_SANDBOX') == true ? 'checked' : '' }} />
                                                <label class="tgl-btn" data-tg-off="NO" data-tg-on="YES" for="aamar_pay"></label>
                                            </li>
                                        </div>
                                    </div>

                                   



                                </div>
                            </div>
                        </div>

                        <br>


                        <div class="row">
							<div class="col-md-12">
		                        <label for="braintree_enable">BrainTree PAYMENT</label> 
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="brain_sec1" type="checkbox" name="braintree_check" {{ $gsetting->braintree_enable==1 ? 'checked' : '' }} />
		                          <label style="width: 100px;"class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="brain_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ $gsetting->braintree_enable==1 ? '' : 'display:none' }}" id="brain_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">BrainTree Env<sup style="color:red;">*</sup></label>
					                    <input value="{{ $env_files['BRAINTREE_ENV'] }}" autofocus name="BRAINTREE_ENV" type="text" class="form-control" placeholder="Enter BrainTree Env"/>
					                </div>
					                <div class="col-md-6">
					                    <label for="pay_sid">BrainTree Merchant ID <sup style="color:red;">*</sup></label>
					                    <input value="{{ $env_files['BRAINTREE_MERCHANT_ID'] }}" autofocus name="BRAINTREE_MERCHANT_ID" type="text" class="form-control" placeholder="Enter BrainTree Merchant ID"/>
					                    <br>
					                </div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">BrainTree Public Key<sup style="color:red;">*</sup></label>
				                    	<input value="{{ $env_files['BRAINTREE_PUBLIC_KEY'] }}" autofocus name="BRAINTREE_PUBLIC_KEY" type="text" class="form-control" placeholder="Enter BrainTree Public Key"/>
				                  	</div>

				                  	<div class="col-md-6">
				                    	<label for="pay_mode">BrainTree Private Key<sup style="color:red;">*</sup></label>
				                    	<input value="{{ $env_files['BRAINTREE_PRIVATE_KEY'] }}" autofocus name="BRAINTREE_PRIVATE_KEY" type="text" class="form-control" placeholder="Enter BrainTree Private Key"/>
				                  	</div>

				              	</div>
		                    </div>
		                </div>
						<br>
						<br>

						<div class="row">
							<div class="col-md-12">
		                        <label for="gtm_enable">GOOGLE TAG MANAGER</label> 
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="gtm_sec1" type="checkbox" name="GOOGLE_TAG_MANAGER_ENABLED" {{ env('GOOGLE_TAG_MANAGER_ENABLED')=='true' ? 'checked' : '' }} />
		                          <label style="width: 100px;"class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="gtm_sec1"></label>
		                        </li>
		                         <br>
		                        <div class="row" style="{{ env('GOOGLE_TAG_MANAGER_ENABLED')=='true' ? '' : 'display:none' }}" id="gtm_sec">
					                <div class="col-md-6">
					                    <label for="pay_cid">GOOGLE TAG MANAGER ID<sup style="color:red;">*</sup></label>
					                    <input value="{{ $env_files['GOOGLE_TAG_MANAGER_ID'] }}" autofocus name="GOOGLE_TAG_MANAGER_ID" type="text" class="form-control" placeholder="Enter GTM ID"/>
					                </div>
					               

				              	</div>
		                    </div>
		                </div>
						<br>
						<br>


						  <div class="row">
							<div class="col-md-12">
		                        <label for="payflexi_enable">{{ __('adminstaticword.PAYFLEXIPAYMENT') }}</label>
		                        <li class="tg-list-item">
		                          <input class="tgl tgl-skewed" id="payflexi_sec1" type="checkbox" name="payflexi_check" {{ $gsetting->payflexi_enable==1 ? 'checked' : '' }}/>
		                          <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="payflexi_sec1"></label>
		                        </li>
		                        

		                        <br>
		                        <div class="row" style="{{ $gsetting->payflexi_enable==1 ? '' : 'display:none' }}" id="payflexi_sec">
		                          <div class="col-md-6">
				                    <label for="PAYFLEXI_KEY">{{ __('adminstaticword.PayFlexiPublicKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYFLEXI_PUBLIC_KEY'] }}" autofocus name="PAYFLEXI_PUBLIC_KEY" type="text" class="form-control" placeholder="Enter PayFlexi Public Key"/>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Public Key: Your PayFlexi publicKey. Sign up on <a href="https://merchant.payflexi.co/">https://merchant.payflexi.co/</a>to get one from your settings page</small>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="PAYFLEXI_SECRET">{{ __('adminstaticword.PayFlexiSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYFLEXI_SECRET_KEY'] }}" autofocus name="PAYFLEXI_SECRET_KEY" type="text" class="form-control" placeholder="Enter PayFlexi Secret Key"/>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Secret Key: Your PayFlexi secretKey. Sign up on <a href="https://merchant.payflexi.co/">https://merchant.payflexi.co/</a>to get one from your settings page</small>
				                    <br>
				                  </div>

                                  <div class="col-md-6">
				                    <label for="PAYFLEXI_PAYMENT_GATEWAY">{{ __('adminstaticword.PayFlexiSecretKey') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYFLEXI_PAYMENT_GATEWAY'] }}" autofocus name="PAYFLEXI_PAYMENT_GATEWAY" type="text" class="form-control" placeholder="Enter Supported PayFlexi Gateway"/>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Mode:This can either be <b>'stripe'</b> or <b>'paystack'</b>. We are adding more gateways soon</small>
				                    <br>
				                  </div>

		                          <div class="col-md-6">
				                    <label for="PAYFLEXI_MODE">{{ __('adminstaticword.PayFlexiMode') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ $env_files['PAYFLEXI_MODE'] }}" autofocus name="PAYFLEXI_MODE" type="text" class="form-control" placeholder="Enter PayFlexi Mode"/>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> Mode:This can either be <b>'test'</b> or <b>'live'</b>. Add your keys based on the mode</small>
				                    <br>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="PAYFLEXI_WEBHOOK_URL">{{ __('adminstaticword.PayFlexiWebhookURL') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ route('payflexi.webhook') }}" autofocus type="text" class="form-control" placeholder="" disabled/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> use <b>this webhook url in PayFlexi Merchant settings page</b> </small>
				                  </div>

				                  <div class="col-md-6">
				                    <label for="PAYFLEXI_WEBHOOK_URL">{{ __('adminstaticword.PayFlexiCallbackURL') }}<sup class="redstar">*</sup></label>
				                    <input value="{{ route('payflexi.callback') }}" autofocus type="text" class="form-control" placeholder="" disabled/>
				                    <small class="text-muted"><i class="fa fa-question-circle"></i> use <b>this callback url in PayFlexi Merchant settings page</b> </small>
				                  </div>
				              	</div>
		                    </div>
		                </div>
						<br>
                        <br>


                        @if(Module::has('Esewa') && Module::find('Esewa')->isEnabled())
				            @include('esewa::admin.api_settings')
				        @endif
                       


						
						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
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

      $('#s_sec1').change(function(){
        if($('#s_sec1').is(':checked')){
        	$('#s_sec').show('fast');
        }else{
        	$('#s_sec').hide('fast');
        }

      });


      $('#pay_sec1').change(function(){
        if($('#pay_sec1').is(':checked')){
        	$('#pay_sec').show('fast');
        }else{
        	$('#pay_sec').hide('fast');
        }

      });
      $('#payu_sec1').change(function(){
        if($('#payu_sec1').is(':checked')){
        	$('#payu_sec').show('fast');
        }else{
        	$('#payu_sec').hide('fast');
        }

      });
      $('#insta_sec1').change(function(){
        if($('#insta_sec1').is(':checked')){
        	$('#insta_sec').show('fast');
        }else{
        	$('#insta_sec').hide('fast');
        }

      });

      $('#brain_sec1').change(function(){
        if($('#brain_sec1').is(':checked')){
        	$('#brain_sec').show('fast');
        }else{
        	$('#brain_sec').hide('fast');
        }

      });

      $('#razor_sec1').change(function(){
        if($('#razor_sec1').is(':checked')){
        	$('#razor_sec').show('fast');
        }else{
        	$('#razor_sec').hide('fast');
        }

      });

      $('#paystack_sec1').change(function(){
        if($('#paystack_sec1').is(':checked')){
        	$('#paystack_sec').show('fast');
        }else{
        	$('#paystack_sec').hide('fast');
        }

      });

      $('#paytm_sec1').change(function(){
        if($('#paytm_sec1').is(':checked')){
        	$('#paytm_sec').show('fast');
        }else{
        	$('#paytm_sec').hide('fast');
        }

      });

      $('#captcha_sec1').change(function(){
        if($('#captcha_sec1').is(':checked')){
        	$('#captcha_sec').show('fast');
        }else{
        	$('#captcha_sec').hide('fast');
        }

      });

      	$('#aws_sec1').change(function(){
	        if($('#aws_sec1').is(':checked')){
	        	$('#aws_sec').show('fast');
	        }else{
	        	$('#aws_sec').hide('fast');
	        }

	    });


      	$('#enable_omise').change(function () {
            if ($('#enable_omise').is(':checked')) {
                $('#omise_sec').show('fast');
            } else {
                $('#omise_sec').hide('fast');
            }

        });

       	$('#enable_payu').change(function () {
            if ($('#enable_payu').is(':checked')) {
                $('#payu_sec').show('fast');
            } else {
                $('#payu_sec').hide('fast');
            }

        });

        $('#enable_moli').change(function () {
            if ($('#enable_moli').is(':checked')) {
                $('#moli_sec').show('fast');
            } else {
                $('#moli_sec').hide('fast');
            }

        });

        $('#enable_cashfree').change(function () {
            if ($('#enable_cashfree').is(':checked')) {
                $('#cf_sec').show('fast');
            } else {
                $('#cf_sec').hide('fast');
            }

        });

        $('#enable_skrill').change(function () {
            if ($('#enable_skrill').is(':checked')) {
                $('#sk_sec').show('fast');
            } else {
                $('#sk_sec').hide('fast');
            }

        });

        $('#enable_rave').change(function () {
            if ($('#enable_rave').is(':checked')) {
                $('#rave_sec').show('fast');
            } else {
                $('#rave_sec').hide('fast');
            }
        });


        $('#enable_payhere').change(function () {
            if ($('#enable_payhere').is(':checked')) {
                $('#payhere_sec').show('fast');
            } else {
                $('#payhere_sec').hide('fast');
            }
        });


        $('#iyzico_enable').change(function () {
            if ($('#iyzico_enable').is(':checked')) {
                $('#iyzico_sec').show('fast');
            } else {
                $('#iyzico_sec').hide('fast');
            }
        });

        $('#ssl_enable').change(function () {
            if ($('#ssl_enable').is(':checked')) {
                $('#ssl_sec').show('fast');
            } else {
                $('#ssl_sec').hide('fast');
            }
        });


        $('#youtube_enable').change(function () {
            if ($('#youtube_enable').is(':checked')) {
                $('#youtube_sec').show('fast');
            } else {
                $('#youtube_sec').hide('fast');
            }
        });


        $('#vimeo_enable').change(function () {
            if ($('#vimeo_enable').is(':checked')) {
                $('#vimeo_sec').show('fast');
            } else {
                $('#vimeo_sec').hide('fast');
            }
        });

        $('#aamarpay_enable').change(function () {
            if ($('#aamarpay_enable').is(':checked')) {
                $('#aamarpay_sec').show('fast');
            } else {
                $('#aamarpay_sec').hide('fast');
            }
        });

        $('#gtm_sec1').change(function () {
            if ($('#gtm_sec1').is(':checked')) {
                $('#gtm_sec').show('fast');
            } else {
                $('#gtm_sec').hide('fast');
            }
        });


        $('#payflexi_sec1').change(function(){
	        if($('#payflexi_sec1').is(':checked')){
	        	$('#payflexi_sec').show('fast');
	        }else{
	        	$('#payflexi_sec').hide('fast');
	        }
	    });


  });

})(jQuery);

</script>


<script src="{{ Module::asset('esewa:js/esewa.js') }}"></script>

@endsection


