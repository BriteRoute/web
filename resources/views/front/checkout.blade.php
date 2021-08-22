@extends('theme.master')
@section('title', 'Checkout')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('frontstaticword.Checkout') }}</h1>
    </div>
</section> 
<!-- about-home end -->
<section id="checkout-block" class="checkout-main-block">
	<div class="container">
		<div class="cart-items btm-30">
	        <div class="row">
	        	<div class="col-lg-4 col-sm-4">
	        		<h4 class="cart-heading">{{ __('frontstaticword.YourItems') }}
            		(@php
                        $item = App\Cart::where('user_id', Auth::User()->id)->get();
                        if(count($item)>0){

                            echo count($item);
                        }
                        else{

                            echo "0";
                        }
                    @endphp)
	            	</h4>
	            	<hr>
	            	<div class="checkout-items">
	            		@foreach($carts as $cart)
			            	<div class="row btm-10">
			            		<div class="col-lg-3 col-4">
			            			<div class="checkout-course-img">
			            				@if($cart->course_id != NULL)
				            				@if($cart->courses['preview_image'] !== NULL && $cart->courses['preview_image'] !== '')
				            					<a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}"><img src="{{ asset('images/course/'. $cart->courses->preview_image) }}" class="img-fluid" alt="course"></a>
				            				@else
												<a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}"><img src="{{ Avatar::create($cart->courses->title)->toBase64() }}" class="img-fluid" alt="course"></a>
				            				@endif
			            				@else
			            					@if($cart->bundle['preview_image'] !== NULL && $cart->bundle['preview_image'] !== '')
			                                	<img src="{{ asset('images/bundle/'. $cart->bundle->preview_image) }}" class="img-fluid" alt="blog">
			                                @else
			                                	<img src="{{ Avatar::create($cart->bundle->title)->toBase64() }}" class="img-fluid" alt="blog">
			                                @endif
		                                @endif
			            			</div>
			            		</div>
			            		<div class="col-lg-9 col-8">
			            			<ul>
			            				@if($cart->course_id != NULL)
			            					<li class="checkout-course-title"><a href="{{ route('user.course.show',['id' => $cart->courses->id, 'slug' => $cart->courses->slug ]) }}">{{ str_limit($cart->courses->title, $limit =35 , $end = '...') }}</a></li>
			            				@else
			            					<li class="checkout-course-title"><a href="{{ route('user.course.show',['id' => $cart->bundle->id, 'slug' => $cart->bundle->slug ]) }}">{{ str_limit($cart->bundle->title, $limit =35 , $end = '...') }}</a></li>
			            				@endif
			            				<li class="checkout-course-user">By {{ $cart->user->fname }}</li>
			            				@php
		                                    $currency = App\Currency::first();
		                                @endphp 
		                                @if($cart->offer_price == !NULL)
		                                	@if($gsetting['currency_swipe'] == 1)
			            						<li class="checkout-course-price"><b><i class="{{ $currency->icon }}"></i>{{ $cart->offer_price }}</b>  <s><i class="{{ $currency->icon }}"></i>{{ $cart->price }}</s></li>
			            					@else
			            						<li class="checkout-course-price"><b>{{ $cart->offer_price }}<i class="{{ $currency->icon }}"></i></b>  <s>{{ $cart->price }}<i class="{{ $currency->icon }}"></i></s></li>
			            					@endif
			            				@else
			            					@if($gsetting['currency_swipe'] == 1)
			            						<li class="checkout-course-price"><b><i class="{{ $currency->icon }}"></i>{{ $cart->price }}</b></li>
			            					@else
			            						<li class="checkout-course-price"><b>{{ $cart->price }}<i class="{{ $currency->icon }}"></i></b></li>
			            					@endif
			            				@endif
			            			</ul>
			            		</div>
			            	</div>
	            		@endforeach
	            	</div>
                </div>
	            <div class="col-lg-8 col-sm-8">
	            	<div class="checkout-pricelist">
		            	<ul>
		            		@if($gsetting['currency_swipe'] == 1)
		            			<li><h1 class="checkout-total">{{ __('frontstaticword.Total') }}: <i class="{{ $currency->icon }}"></i>{{ $cart_total }}</h1></li>
		            			<li><div class="checkout-price"><s><i class="{{ $currency->icon }}"></i>{{ $price_total }}</s></div></li>
		            		@else
		            			<li><h1 class="checkout-total">{{ __('frontstaticword.Total') }}: {{ $cart_total }}<i class="{{ $currency->icon }}"></i></h1></li>
		            			<li><div class="checkout-price"><s>{{ $price_total }}<i class="{{ $currency->icon }}"></i></s></div></li>

		            		@endif
		            		<li><div class="checkout-percent">{{ round($offer_percent, 0) }}% Off</div></li>

		            		@php
		            			if($cart_total != '' || $cart_total != 0){
		            				$mainpay = round($cart_total,2);
		            			}else{
		            				$mainpay = round($cart_total,2);
		            			}
		            		@endphp
		            		
		            	</ul>
	            	</div>
	            	@php  			
        				$secureamount = Crypt::encrypt($mainpay);
        			@endphp
	            	<div class="payment-gateways">
	            		<div id="accordion" class="second-accordion">
	            		 	
	            		 
	            			@if(isset($cart->bundle->is_subscription_enabled) && $cart->bundle->is_subscription_enabled == '1')

	            			@if($gsetting->stripe_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingThree">
							        <div class="panel-title">
							            <label for='r13'>
							              <input type='radio' id='r13' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							              <img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseThree" class="panel-collapse collapse in">
							        <div class="card-body">
								      
									    <div class="creditCardForm">
										  
										    <div class="payment">
										        <form accept-charset="UTF-8" action="{{route('stripe.pay')}}" method="POST"autocomplete="off">
										    		{{ csrf_field() }}
										            <div class="form-group owner">
										                <label for="owner">Owner</label>
										                <input type="text" class="form-control" id="owner" required>
										            </div>
										            <div class="form-group CVV">
										                <label for="cvv">CVV</label>
										                <input type="text" class="form-control" id="cvv" name="ccv" required>
										            </div>
										            <div class="form-group" id="card-number-field">
										                <label for="cardNumber">Card Number</label>
										                <input type="text" class="form-control" id="cardNumber" name="card_no" required>
										            </div>
										            <div class="form-group" id="expiration-date">
										                <label>Expiration Date</label>
										                <select name="expiry_month" required> 
										                    <option value="01">January</option>
										                    <option value="02">February </option>
										                    <option value="03">March</option>
										                    <option value="04">April</option>
										                    <option value="05">May</option>
										                    <option value="06">June</option>
										                    <option value="07">July</option>
										                    <option value="08">August</option>
										                    <option value="09">September</option>
										                    <option value="10">October</option>
										                    <option value="11">November</option>
										                    <option value="12">December</option>
										                </select>
										                <select name="expiry_year" required>
										                    <option value="19">2019</option>
										                    <option value="20">2020</option>
										                    <option value="21">2021</option>
										                    <option value="22">2022</option>
										                    <option value="23">2023</option>
										                    <option value="24">2024</option>
										                    <option value="25">2025</option>
										                    <option value="26">2026</option>
										                    <option value="27">2027</option>
										                    <option value="28">2028</option>
										                    <option value="29">2029</option>
										                    <option value="30">2030</option>
										                    <option value="31">2031</option>
										                    <option value="32">2032</option>
										                </select>
										            </div>
										            <div class="form-group" id="credit_cards">
										                <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
										                <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
										                <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
										            </div>

										            <input type="hidden" name="amount"  value="{{ $mainpay }}" />

										            <button class='form-control btn btn-default' type='submit'>{{ __('frontstaticword.Proceed') }}</button>
										        </form>
										    </div>
										</div>
							        </div>
							    </div>
							</div>
							@endif
						

							@else


							@if($gsetting->stripe_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingThree">
							        <div class="panel-title">
							            <label for='r13'>
							              <input type='radio' id='r13' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							              <img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseThree" class="panel-collapse collapse in">
							        <div class="card-body">
								      
									    <div class="creditCardForm">
										  
										    <div class="payment">
										        <form accept-charset="UTF-8" action="{{route('stripe.pay')}}" method="POST"autocomplete="off">
										    		{{ csrf_field() }}
										            <div class="form-group owner">
										                <label for="owner">Owner</label>
										                <input type="text" class="form-control" id="owner" required>
										            </div>
										            <div class="form-group CVV">
										                <label for="cvv">CVV</label>
										                <input type="text" class="form-control" id="cvv" name="ccv" required>
										            </div>
										            <div class="form-group" id="card-number-field">
										                <label for="cardNumber">Card Number</label>
										                <input type="text" class="form-control" id="cardNumber" name="card_no" required>
										            </div>
										            <div class="form-group" id="expiration-date">
										                <label>Expiration Date</label>
										                <select name="expiry_month" required> 
										                    <option value="01">January</option>
										                    <option value="02">February </option>
										                    <option value="03">March</option>
										                    <option value="04">April</option>
										                    <option value="05">May</option>
										                    <option value="06">June</option>
										                    <option value="07">July</option>
										                    <option value="08">August</option>
										                    <option value="09">September</option>
										                    <option value="10">October</option>
										                    <option value="11">November</option>
										                    <option value="12">December</option>
										                </select>
										                <select name="expiry_year" required>
										                    <option value="19">2019</option>
										                    <option value="20">2020</option>
										                    <option value="21">2021</option>
										                    <option value="22">2022</option>
										                    <option value="23">2023</option>
										                    <option value="24">2024</option>
										                    <option value="25">2025</option>
										                    <option value="26">2026</option>
										                    <option value="27">2027</option>
										                    <option value="28">2028</option>
										                    <option value="29">2029</option>
										                    <option value="30">2030</option>
										                    <option value="31">2031</option>
										                    <option value="32">2032</option>
										                </select>
										            </div>
										            <div class="form-group" id="credit_cards">
										                <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
										                <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
										                <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
										            </div>

										            <input type="hidden" name="amount"  value="{{ $mainpay }}" />

										            <button class='form-control btn btn-default' type='submit'>{{ __('frontstaticword.Proceed') }}</button>
										        </form>
										    </div>
										</div>
							        </div>
							    </div>
							</div>
							@endif


	            			@if($gsetting->paypal_enable == 1)
						    <div class="card">
	                            <div class="card-header" id="headingOne">
							        <div class="panel-title">
							            <label for='r11'>
								            <input type='radio' id='r11' name='occupation' value='Working' required />
								            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
								              
								            <img src="{{ url('images/payment/paypal2.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseOne" class="panel-collapse collapse in">
							        <div class="card-body">
		                            
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('payWithpaypal') }}" method="POST" autocomplete="off">
		                            			@csrf
		                            			
		                         				<input type="hidden" name="amount" value="{{ $secureamount  }}"/>
		                            			<button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
		                            		</form>
		                            		
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif


							@if($gsetting->instamojo_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingTwo">
							        <div class="panel-title">
							            <label for='r12'>
								            <input type='radio' id='r12' name='occupation' value='Working' required />
								            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a>

							            	<img src="{{ url('images/payment/instamojo.png') }}" class="img-fluid-img" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseTwo" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">

		                            		<form action="{{ url('pay') }}" method="POST" name="laravel_instamojo" autocomplete="off">
											    {{ csrf_field() }}
											    
											     <div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Name</strong>
											                <input type="text" name="name" class="form-control" value="{{ Auth::user()->fname }}" placeholder="Enter Name" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Mobile Number</strong>
											                <input type="text" name="mobile_number" class="form-control" value="{{ Auth::user()->mobile }}" placeholder="Enter Mobile Number" required autocomplete="off">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Email Id</strong>
											                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Enter Email id" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <input type="hidden" name="amount" class="form-control" placeholder="" value="{{ $mainpay }}" readonly="">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
											        </div>
											    </div>
											     
											</form>
		                            		
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif

							

							@if($gsetting->enable_omise == 1 && $currency->currency == 'THB')

							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='omise'>
											<input type='radio' id='omise' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#omise_panel"></a>

											<img src="{{ url('images/payment/omise.svg') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="omise_panel" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											<form id="checkoutForm" method="POST" action="{{ route('pay.via.omise') }}">
												@csrf
												<input type="hidden" name="amount" value="{{ $mainpay }}" />
												<script type="text/javascript" src="https://cdn.omise.co/omise.js"
													data-key="{{ env('OMISE_PUBLIC_KEY') }}"
													data-amount="{{ $mainpay*100 }}"
													data-frame-label="{{ config('app.name') }}"
													data-image="{{ url('images/logo/'.$gsetting->logo) }}"
													data-currency="{{ $currency->currency }}"
													data-default-payment-method="credit_card">
												</script>
											</form>


										</div>
									</div>
								</div>
							</div>
							@endif


							@if($gsetting->razorpay_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingSix">
							        <div class="panel-title">
							            <label for='r16'>
							              <input type='radio' id='r16' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"></a>
							              <img src="{{ url('images/payment/razorpay.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							            
							        </div>
						    	</div>
							    <div id="collapseSix" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('dopayment') }}" method="POST">
		                            			@csrf
		                            			
		                         				<input type="hidden" name="amount" value="{{ $secureamount  }}"/>
		                         				

		                         				@php
												    $set = App\Setting::first();
												    $currency = App\Currency::first();
												@endphp

		                         				<script
												    src="https://checkout.razorpay.com/v1/checkout.js"
												    data-key="{{ env('RAZORPAY_KEY') }}"
												    data-amount= "{{ $mainpay*100 }}"
												    data-currency="{{ $currency->currency }}"
												    data-order_id=""
												    data-buttontext="Proceed"
												    data-name="{{ $set->project_title }}"
												    data-description=""
												    data-image="{{ asset('images/logo/'.$set->logo) }}"
												    data-prefill.name="XYZ"
												    data-prefill.email="info@example.com"
												    data-theme.color="#F44A4A"
												></script>
		                            		</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif


							@if($gsetting->paystack_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingSeven">
							        <div class="panel-title">
							            <label for='r14'>
							              <input type='radio' id='r14' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"></a>
							              <img src="{{ url('images/payment/paystack.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							        </div>
						    	</div>
							    <div id="collapseSeven" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="POST" action="{{ route('paywithpaystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
										        <div class="row">
										          <div class="col-md-8 col-md-offset-2">

										          	<input type="hidden" name="quantity" value="1">
										            
										            <input type="hidden" name="email" value="{{Auth::User()->email}}"> 
										            <input type="hidden" name="amount" value="{{ $mainpay*100 }}">
										            <input type="hidden" name="currency" value="{{ $currency->currency }}">
										            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > 
										            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
										            <input type="hidden" name="key" value="{{ env('PAYSTACK_SECRET_KEY') }}"> 
										            {{ csrf_field() }} 

										             <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

										            <p>
										              <button class="btn btn-primary " type="submit" value="Pay Now">{{ __('frontstaticword.Proceed') }}</button>
										            </p>
										          </div>
										        </div>
											</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif


							@if($gsetting->paytm_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingFour">
							        <div class="panel-title">
							            <label for='r17'>
							              <input type='radio' id='r17' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"></a>
							              <img src="{{ url('images/payment/paytm.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							        </div>
						    	</div>
							    <div id="collapseFour" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="post" action="{{ url('/paywithpayment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
		                            			@csrf

										            <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>

										          
												    <div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Name</strong>
											                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{Auth::User()->fname}}" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Mobile Number</strong>
											                <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" value="{{Auth::User()->mobile}}" required autocomplete="off">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Email Id</strong>
											                <input type="email" name="email" class="form-control" value="{{Auth::User()->email}}" placeholder="Enter Email id" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <input type="hidden" name="amount" class="form-control" placeholder="" value="{{ $mainpay }}" readonly="">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
											        </div>
											    </div>
										          
											</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif

							@php
								$banktransfer = App\BankTransfer::first();
							@endphp
							@if(isset($banktransfer))
							@if($banktransfer->bank_enable == '1')
							<div class="card">
	                            <div class="card-header" id="headingEight">
							        <div class="panel-title">
							            <label for='r18'>
							              <input type='radio' id='r18' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight"></a>
							              &emsp;<b>{{ __('frontstaticword.banktransfer') }}</b>
							            </label>
							        </div>
						    	</div>
							    <div id="collapseEight" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="POST" action="{{ url('process/banktransfer') }}" accept-charset="UTF-8" class="form-horizontal" role="form" enctype="multipart/form-data">
		                            			@csrf
										        <div class="row">
										          <div class="col-md-8 col-md-offset-2">

										          	<input type="file" name="proof" required />
										          	<br>
										            <small>({{ __('frontstaticword.PleaseDocument') }})</small>
										            
									            	<input type="hidden" name="amount" value="{{ $mainpay }}"/>

										            <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>

										            <input type="hidden" name="fname" value="{{Auth::User()->fname}}"/>

										             <input type="hidden" name="mobile" value="{{Auth::User()->mobile}}"/>

										            <input type="hidden" name="email" value="{{Auth::User()->email}}"/>


										            <p>
										              <button class="btn btn-primary " type="submit" value="Pay Now">{{ __('frontstaticword.Proceed') }}</button>
										            </p>
										          </div>
										        </div>
											</form>

											<div class="card">
											  <div class="card-header">
											    <h5 class="card-title">{{ __('frontstaticword.banktransferdetail') }}</h5>
											  </div>
											  @php
											  	$bankdetail = App\BankTransfer::first();
											  @endphp
											  <ul class="list-group list-group-flush">
											    <li class="list-group-item"><b>{{ __('frontstaticword.Accountholdername') }}:</b>&nbsp;{{ $bankdetail['account_holder_name'] }}</li>
											    <li class="list-group-item"><b>{{ __('frontstaticword.BankName') }}:</b>&nbsp;{{ $bankdetail['bank_name'] }}</li>
											    <li class="list-group-item"><b>{{ __('frontstaticword.BankAcccountNumber') }}:</b>&nbsp;{{ $bankdetail['account_number'] }}</li>
											    @if(isset($bankdetail['ifcs_code']))
											    <li class="list-group-item"><b>{{ __('frontstaticword.IFCSCode') }}</b>:&nbsp;{{ $bankdetail['ifcs_code'] }}</li>
											    @endif
											    @if(isset($bankdetail['swift_code']))
											    <li class="list-group-item"><b>{{ __('frontstaticword.SwiftCode') }}</b>:&nbsp;{{ $bankdetail['swift_code'] }}</li>
											    @endif
											  </ul>
											</div>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif
							@endif

							@if($gsetting->enable_payu == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='ppay'>
											<input type='radio' id='ppay' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#payupay"></a>

											<img src="{{ url('images/payment/payumoney.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="payupay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">
											<form action="{{ route('paywithpayu') }}" method="POST" autocomplete="off">
												@csrf

												<input type="hidden" name="amount" value="{{ $secureamount  }}" />

												<div class="form-group">
													<label>Email : <span class="text-red">*</span></label>
													<input required="" name="email" type="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="enter email">
												</div>

												<div class="form-group">
													<label>Phone : <span class="text-red">*</span></label>
													<input required="" name="phone" type="text" class="form-control" value="{{ Auth::user()->mobile }}" placeholder="enter valid phone no">
												</div>

												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif

							@if($gsetting->enable_cashfree == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='cpay'>
											<input type='radio' id='cpay' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#cashfree_pay"></a>

											<img src="{{ url('images/payment/cashfree.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="cashfree_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">
											<form action="{{ route('cashfree.pay') }}" method="POST" autocomplete="off">
												@csrf

												<input type="hidden" name="amount" value="{{ $secureamount  }}" />

												<div class="form-group">
													<label>Email : <span class="text-red">*</span></label>
													<input required="" name="email" type="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="enter email">
												</div>

												<div class="form-group">
													<label>Phone : <span class="text-red">*</span></label>
													<input required="" name="phone" type="text" class="form-control" value="{{ Auth::user()->mobile }}" placeholder="enter valid phone no">
												</div>

												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif

							@if($gsetting->enable_moli == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='mpay'>
											<input type='radio' id='mpay' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#moli_pay"></a>

											<img src="{{ url('images/payment/moli.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="moli_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">
											<form action="{{ route('moli.pay') }}" method="POST" autocomplete="off">
												@csrf

												<input type="hidden" name="amount" value="{{ $secureamount  }}" />

												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif

							@if($gsetting->enable_skrill == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='skpay'>
											<input type='radio' id='skpay' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#sk_pay"></a>

											<img src="{{ url('images/payment/skrill.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="sk_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">
											<form action="{{ route('skrill.pay') }}" method="POST" autocomplete="off">
												@csrf

												<input name="pay_to_email" type="hidden" value="{{ env('SKRILL_MERCHANT_EMAIL') }}">

												<input type="hidden" name="amount" value="{{ $secureamount  }}" />

												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif

							@if($gsetting->enable_rave == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='rpay'>
											<input type='radio' id='rpay' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#rave_pay"></a>

											<img src="{{ url('images/payment/rave.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="rave_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											@php
											$array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
											array('metaname' => 'size', 'metavalue' => 'small'));

											$currency = App\Currency::first();
											@endphp

											<form method="POST" action="{{ route('rave.pay') }}" id="paymentForm">
												{{ csrf_field() }}
												<input type="hidden" name="amount"
													value="{{ Crypt::decrypt($secureamount) }}" />
												<!-- Replace the value with your transaction amount -->
												<input type="hidden" name="payment_method" value="both" />
												<!-- Can be card, account, both -->
												<input type="hidden" name="description"
													value="Payment for digital content" />
												<!-- Replace the value with your transaction description -->
												<input type="hidden" name="country" value="{{ env('RAVE_COUNTRY') }}" />
												<!-- Replace the value with your transaction country -->
												<input type="hidden" name="currency"
													value="{{ $currency->currency }}" />
												<!-- Replace the value with your transaction currency -->
												<input required="" class="form-control" type="hidden" name="email"
													value="{{ Auth::user()->email }}" />
												<input type="hidden" name="firstname"
													value="{{ Auth::user()->fname }}" />
												<!-- Replace the value with your customer firstname -->
												<input type="hidden" name="lastname"
													value="{{ Auth::user()->lname }}" />
												<!-- Replace the value with your customer lastname -->
												<input type="hidden" name="metadata" value="{{ json_encode($array) }}">
												<!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
												<input type="hidden" name="phonenumber"
													value="{{ Auth::user()->mobile }}" />
												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif

							@php
	                            $order_id = uniqid();
	                        @endphp

							@if($gsetting->enable_payhere == 1)
							<div class="card">
								<div class="card-header" id="headingten">
									<div class="panel-title">
										<label for='payhere'>
											<input type='radio' id='payhere' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#payhere_pay"></a>


											<img src="{{ url('images/payment/payhere.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="payhere_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											@if(env('PAYHERE_MODE') == 'sandbox')
												@php
												$action = 'https://sandbox.payhere.lk/pay/checkout';
												@endphp
											@else
												@php
												$action = 'https://www.payhere.lk/pay/checkout';
												@endphp

											@endif

											<form method="post" action="{{ $action }}" >  

									            <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">    <!-- Replace your Merchant ID -->
									            <input type="hidden" name="return_url" value="{{route ( 'payhere.returnUrl' )}}">
									            <input type="hidden" name="cancel_url" value="{{route ( 'payhere.cancelUrl' )}}">
									            <input type="hidden" name="notify_url" value="{{route ( 'payhere.notifyUrl' )}}">  

									            <input hidden type="text" name="order_id" value="{{ $order_id }}">
									            <input hidden type="text" name="items" value="{{ $order_id }}">
									            <input hidden type="text" name="currency" value="LKR">
									            <input hidden type="text" name="amount" value="{{ Crypt::decrypt($secureamount) }}"> 

									            
									            <input hidden type="text" name="first_name" value="{{ Auth::user()->fname }}">
									            <input hidden type="text" name="last_name" value="{{ Auth::user()->lname }}">
									            <input hidden type="text" name="email" value="{{ Auth::user()->email }}">
									            <input hidden type="text" name="phone" value="{{ isset(Auth::user()['mobile']) }}">
									            <input hidden type="text" name="address" value=" {{ isset(Auth::user()['address']) }}">
									            <input type="hidden" name="city" value="{{ isset(Auth::user()->state['name']) }}">
									            <input type="hidden" name="country" value="{{ isset(Auth::user()->country['name']) }}">

									        

                            					<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}
												</button>
									        </form> 

											

										</div>
									</div>
								</div>
							</div>
							@endif



							@php
	                            $conversation_id = uniqid();
	                        @endphp

	                        @if($gsetting->iyzico_enable == 1)

							<div class="card">
								<div class="card-header" id="headinggodvf">
									<div class="panel-title">
										<label for='izyy'>
											<input type='radio' id='izyy' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#izyy_pay"></a>


											<img src="{{ url('images/payment/iyzico.png') }}" class="img-fluid" alt="iyzipay">
										</label>
									</div>
								</div>
								<div id="izyy_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											<form action="{{ route('izy.pay') }}" method="POST" autocomplete="off">
												@csrf



												<div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Email</strong>
											                <input type="text" name="email" class="form-control" value="email@email.com"  placeholder="email@email.com" required autocomplete="off">

											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Mobile Number</strong>
											                <input type="text" name="mobile" class="form-control" value="+905350000000" placeholder="+905350000000" required autocomplete="off">
											            </div>
											        </div>

											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>Identity number</strong>
											                <input type="text" name="identity_number" class="form-control" value="74300864791" placeholder="74300864791" required autocomplete="off">

											                <small class="text-muted"><i class="fa fa-question-circle"></i>TCKN for Turkish merchants, passport number for foreign merchants</small>
											            </div>
											        </div>
											    </div>

												<input type="hidden" name="conversation_id" value="{{ $conversation_id  }}" />
												<input type="hidden" name="amount" value="{{ $secureamount  }}" />
												<input type="hidden" name="language" value="{{ $secureamount  }}" />
												<input type="hidden" name="currency" value="{{ $currency->currency  }}" />
												<input type="hidden" name="fname" value="{{ Auth::user()->fname }}" />
												<input type="hidden" name="lname" value="{{ Auth::user()->lname }}" />
												<input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}" />

												<input type="hidden" name="address" value="{{ Auth::user()->address }}" />
												<input type="hidden" name="city" value="{{ isset(Auth::user()->city['name']) }}" />
												<input type="hidden" name="state" value="{{ isset(Auth::user()->state['name']) }}" />
												<input type="hidden" name="country" value="{{ isset(Auth::user()->country['name']) }}" />
												<input type="hidden" name="pincode" value="{{ Auth::user()->pin_code }}" />

												<input type="hidden" name="language" value="{{ Session::get('changed_language') }}" />
												

												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>
											

										</div>
									</div>
								</div>
							</div>

							@endif


							@if($gsetting->ssl_enable == 1)
							<div class="card">
								<div class="card-header" id="headingssl">
									<div class="panel-title">
										<label for='ssl'>
											<input type='radio' id='ssl' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#ssl_pay"></a>


											<img src="{{ url('images/payment/ssl.png') }}" class="img-fluid" alt="sslpay">
										</label>
									</div>
								</div>
								<div id="ssl_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											<form action="{{ route('payvia.sslcommerze') }}" method="POST">
					                          @csrf
					                          <input type="hidden" name="amount" value="{{ $secureamount }}">
					                          <button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}
												</button>
					                        </form>
											

										</div>
									</div>
								</div>
							</div>
							@endif



							@php
							$manualpay = App\ManualPayment::where('status', '1')->get();
							@endphp


							@foreach($manualpay as $manual)
							<div class="card">
							    <div class="card-header" id="headingManual{{ $manual->id }}">
							      <h2 class="mb-0">
							        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseManual{{ $manual->id }}" aria-expanded="false" aria-controls="collapseOne">
							          <b>{{ $manual->name  }}</b>
							        </button>
							      </h2>
							    </div>

							    <div id="collapseManual{{ $manual->id }}" class="collapse" aria-labelledby="headingManual" data-parent="#accordionExample">
							      <div class="card-body">


							        <div class="payment-proceed-btn">
								        <form action="{{ route('manualpay.checkout') }}" method="POST" enctype="multipart/form-data">
			                              	@csrf
			                              	<input type="hidden" name="payment_name" value="{{ $manual->name }}">
			                              	<input type="hidden" name="amount" value="{{ $secureamount }}">

				                            <div class="form-group">
				                                <input type="file" name="proof" required />
									          	<br>
									            <small>({{ __('frontstaticword.PleaseDocument') }})</small>

				                            </div>

			                               	<button class="btn btn-primary " type="submit" value="Pay Now">{{ __('frontstaticword.Proceed') }}</button>
			                            </form>
			                        </div>
			                        <br>
			                        <br>


			                        <div class="row">
                                
		                                <div class="col-md-12">
		                                  {!! $manual->detail !!}
		                                </div>

		                            </div>
		                             
		                            @if($manual->image != '' && file_exists(public_path().'/images/manualpayment/'.$manual->image) )

		                                <div class="card card-1">
		                                  <div class="text-center card-body">
		                                   
		                                  <img width="300px" height="300px" class="img-fluid" src="{{ url('images/manualpayment/'.$manual->image) }}" alt="{{ $manual->image }}">
		                                  </div>
		                                </div>

		                            @endif

			                        

							      </div>
							    </div>
							</div>

							@endforeach

							

							@if($gsetting->aamarpay_enable == 1)
							<div class="card">
								<div class="card-header" id="headingaamar">
									<div class="panel-title">
										<label for='aamar'>
											<input type='radio' id='aamar' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#aamar_pay"></a>


											<img src="{{ url('images/payment/aamarpay.png') }}" class="img-fluid" alt="aamarpay">
										</label>
									</div>
								</div>
								<div id="aamar_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">


											@php
											$user_name = Auth::user()->fname;
											$user_email = Auth::user()->email;
											$user_mobile = Auth::user()->email;
											@endphp

											<div class="aamar-pay-btn">
												{!! 
												aamarpay_post_button([
												    'cus_name'  => $user_name, // Customer name
												    'cus_email' => $user_email, // Customer email
												    'cus_phone' => $user_mobile // Customer Phone
												], $mainpay, 'Proceed', 'btn btn-sm btn-primary') 
												!!}
											</div>

											
											

										</div>
									</div>
								</div>
							</div>

							@endif


							


							@if($gsetting->braintree_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingFive">
							        <div class="panel-title">
							            <label for='r15'>
							              <input type='radio' id='r15' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"></a>
							              <img src="{{ url('images/payment/braintree.png') }}" style="margin-left: 15px;" height="30px" width="90px" class="img-fluid-img" alt="course"> 
							            </label>
							            
							        </div>
						    	</div>
							    <div id="collapseFive" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">

	                            		<h3 class="plan-dtl-heading">Checkout With Braintree</h3>
               
		                            		

		                            	<form method="post" id="payment-form" action="{{ url('/checkout') }}">
						                    @csrf
						                    <section>
						                        <label for="amount">
						                            {{-- <span class="input-label">Amount</span> --}}
						                            <div class="input-wrapper amount-wrapper">
						                                <input type='hidden' id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="{{ $mainpay }}">
						                            </div>
						                        </label>

						                        <div class="bt-drop-in-wrapper">
						                            <div id="bt-dropin"></div>
						                        </div>
						                    </section>

						                    <input id="nonce" name="payment_method_nonce" type="hidden" />
						                    <button class="btn btn-primary" type="submit"><span>{{ __('frontstaticword.Proceed') }}</span></button>
						                </form>

	                            		</div>
							        </div>
							    </div>
							</div>

							@endif


						
					        @if(Module::has('Wallet') && Module::find('Wallet')->isEnabled())
					            @include('wallet::front.wallet.checkout_form')
					        @endif


					        @if(Module::has('MPesa') && Module::find('MPesa')->isEnabled())
					            @include('mpesa::front.checkout_form')
					        @endif

					        @if($gsetting->payflexi_enable == 1)
							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='payflexi'>
											<input type='radio' id='payflexi' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#payflexi_pay"></a>

											<img src="{{ url('images/payment/payflexi.png') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="payflexi_pay" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											@php
											$array = array('title' => 'Online Course');
											$currency = App\Currency::first();
											@endphp

											<form method="POST" action="{{ route('payflexi.pay') }}" id="paymentForm">
												{{ csrf_field() }}
												<input type="hidden" name="key" value="{{ env('PAYFLEXI_SECRET_KEY') }}"> 
												<input type="hidden" name="amount" value="{{ Crypt::decrypt($secureamount) }}" />
												<input type="hidden" name="gateway" value="{{ env('PAYFLEXI_PAYMENT_GATEWAY') }}" />
												<input type="hidden" name="currency" value="{{ $currency->currency }}" />
												<input type="hidden" name="email" value="{{ Auth::user()->email }}" />
												<input type="hidden" name="name" value="{{ Auth::user()->fname . ' ' . Auth::user()->lname }}" />
												<input type="hidden" name="meta" value="{{ json_encode($array) }}">
												<input type="hidden" name="phone" value="{{ Auth::user()->mobile }}" />
												<button class="btn btn-primary" title="checkout"
													type="submit">{{ __('frontstaticword.Proceed') }}</button>
											</form>

										</div>
									</div>
								</div>
							</div>
							@endif


							@if(Module::has('Esewa') && Module::find('Esewa')->isEnabled())
					            @include('esewa::front.checkout_form')
					        @endif
					    

							
							@endif



                        </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
</section>

@endsection

@section('custom-script')

<script src="{{ url('js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{ url('js/script.js') }}"></script>

<script src="{{ url('js/jquery.min.js') }}"></script>  



@if($gsetting->braintree_enable == 1) 

	@php
		$gateway = new Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $token = $gateway->ClientToken()->generate();

	@endphp

	<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
	 
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          else{
	          $('.bt-btn').hide();
	          $('.braintree').show();
	        }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>

@endif


@endsection
