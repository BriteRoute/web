@extends('admin.layouts.master')
@section('title', 'Bank Detail - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-6">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.BankDetails') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ action('BankTransferController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}

		                <div class="row">
			                <div  class="col-md-12">
								<label for="">{{ __('adminstaticword.BankEnable') }}: </label>
								<br>
								<li class="tg-list-item">              
						            <input class="tgl tgl-skewed" id="cb3" type="checkbox" name="bank_enable" {{ optional($show)['bank_enable'] == '1' ? 'checked' : '' }} >
						            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cb3"></label>
					            </li>
					            <input type="hidden"  name="free" value="0" for="cb3" id="cb3"> 
							</div>
						</div>
						<br>
		                
		              	<div class="row">
		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="name">{{ __('adminstaticword.AccountHolderName') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ optional($show)->account_holder_name }}" name="account_holder_name" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.AccountHolderName') }}" required autocomplete="off"/>
			                </div>
		                  </div>
		                
		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="bank">{{ __('adminstaticword.BankName') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ optional($show)->bank_name }}" name="bank_name" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.BankName') }}" required autocomplete="off"/>
			                </div>
		                  </div>
		               
		                  
		               
		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="number">{{ __('adminstaticword.AccountNumber') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ optional($show)->account_number }}" name="account_number" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.AccountNumber') }}" required autocomplete="off"/>
			                </div>
		                  </div>

		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="code">{{ __('adminstaticword.IFCSCode') }}</label>
			                    <input value="{{ optional($show)->ifcs_code }}" name="ifcs_code" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.IFCSCode') }}" autocomplete="off"/>
			                </div>
		                  </div>

		                  <div class="col-md-12">
		                  	<div class="form-group">
			                    <label for="number">{{ __('adminstaticword.SwiftCode') }}</label>
			                    <input value="{{ optional($show)->swift_code }}" name="swift_code" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.SwiftCode') }}" autocomplete="off"/>
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




