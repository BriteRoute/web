@extends('admin/layouts.master')
@section('title', 'Payment - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('adminstaticword.PaytoInstructor') }}</h3>
        </div>
        <div class="box-body">

          <div class="view-order">
            <div class="row">
              <div class="col-md-12">
                <b>{{ __('adminstaticword.Instructor') }} </b>:  {{ $user->fname }}
                <br>
                <b>{{ __('adminstaticword.TotalInstructorRevenue') }}</b>:  {{ $total }}
                <br>
                
              </div>
            </div>
            <br>
          </div>
          
        @if($user->prefer_pay_method == "paypal")
          <form method="post" action="{{ route('admin.paypal', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>{{ __('adminstaticword.PayPalEmail') }}</b>:  {{ $user->paypal_email }}
              <br>
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">{{ __('adminstaticword.PayWithPaypal') }}</button>
          </form>
        @endif


        @if($user->prefer_pay_method == "banktransfer")
          <form method="post" action="{{ route('admin.banktransfer', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>{{ __('adminstaticword.BankTransfer') }}</b>: 

              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>{{ __('adminstaticword.AccountHolderName') }}:</b>&nbsp;{{ $user['bank_acc_name'] }}</li>
                <li class="list-group-item"><b>{{ __('adminstaticword.BankName') }}:</b>&nbsp;{{ $user['bank_name'] }}</li>
                <li class="list-group-item"><b>{{ __('adminstaticword.IFCSCode') }}</b>:&nbsp;{{ $user[' ifsc_code'] }}</li>
                <li class="list-group-item"><b>{{ __('adminstaticword.AccountNumber') }}:</b>&nbsp;{{ $user['bank_acc_no'] }}</li>
              </ul>
                 
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">{{ __('adminstaticword.PaytoInstructor') }}</button>
          </form>
        @endif


        @if($user->prefer_pay_method == "paytm")
          <form method="post" action="{{ route('admin.paytm', $user->id) }}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}

              <input type="hidden" value="{{ $total }}" name="total" class="form-control">
              
              <div class="display-none">
              @foreach($allchecked as $checked)
               <label >
                  <input type="hidden" name="checked[]" value="{{ $checked }}">
                  {{ $checked }}
               </label>
              @endforeach
              </div>
             
              <b>{{ __('adminstaticword.PaytmMobileNo') }}</b>:  {{ $user->paytm_mobile }}
              <p>{{ __('adminstaticword.DoManualpaymentpaytm') }}</p>
              <br>
              <br>
               
            <button type="submit" class="btn btn-md col-md-3 btn-secondary">{{ __('adminstaticword.PayWithPaytm') }}</button>
          </form>
        @endif
          
         
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection


@section('scripts')
  

  
@endsection
