<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2019.
**********************************************************************************************************  -->
<!-- 
Template Name: eClass
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->
<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku', 'fa'); //make a list of rtl languages
?>

<html lang="en" @if (in_array($language,$rtl)) dir="rtl" @endif>
<!-- <![endif]-->
<!-- head -->
<head>
<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->

<style>
  * { font-family: DejaVu Sans, sans-serif; }

.invoiceheading {
  font-size:30px; 
  margin-bottom: 40px;
}
  
.invoice-col {
  text-align: -webkit-left !important;
}
.table {
  width: 100% !important;
  max-width: 100% !important;
  margin-bottom: 1rem;
  background-color: transparent;
}
.view-order {
  margin-bottom: 20px;
  color: #29303B !important;
}

</style>



<!-- end theme styles -->
</head>


<!-- end head -->
<!-- body start-->
<body>
<!-- terms end-->
<!-- about-home start -->
<section id="wishlist-home" class="invoice-home-main-block">
    <div class="container-fluid">
        <div class="invoiceheading">{{ __('frontstaticword.Invoice') }}</div>
    </div>
</section> 
<!-- about-home end -->
<section id="purchase-block" class="Invoice-main-block">
    <div class="container-fluid">
        <div class="panel-body">
      
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="page-header">
              @php
                  $setting = App\setting::first();
              @endphp
              <div class="download-logo">
                @if($setting['logo_type'] == 'L')
                    <img src="{{ asset('images/logo/'.$setting['logo']) }}" class="img-fluid" alt="logo">
                @else()
                    <a href="{{ url('/') }}"><b><div class="logotext">{{ $setting['project_title'] }}</div></b></a>
                @endif
              </div>
              <br>
              <small class="purchase-date">{{ __('frontstaticword.Puchasedon') }}: {{ date('jS F Y', strtotime($orders['created_at'])) }}</small>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="view-order">
          <table class="table table-striped">
            <thead>
              <tr>
              <th class="col-sm-4 invoice-col">
                From:
                @if($orders->course_id != NULL)
                 
                    <strong>{{ $orders->courses->user['fname'] }}</strong><br>
                    
                   
                    {{ __('frontstaticword.address') }}: {{ $orders->courses->user['address'] }}<br>
                      @if($orders->courses->user->state_id == !NULL)
                        {{ $orders->courses->user->state['name'] }},
                      @endif
                      @if($orders->courses->user->country_id == !NULL)
                        {{ $orders->courses->user->country['name'] }}
                      @endif
                      <br>

                    {{ __('frontstaticword.Phone') }}: {{ $orders->courses->user['mobile'] }}<br>
                    {{ __('frontstaticword.Email') }}: {{ $orders->courses->user['email'] }}
                  
                @else
                 
                    <strong>{{ $orders->bundle->user['fname'] }}</strong><br>
                    
                   
                    {{ __('frontstaticword.address') }}: {{ $orders->bundle->user['address'] }}<br>
                      @if($orders->bundle->user->state_id == !NULL)
                        {{ $orders->bundle->user->state['name'] }},
                      @endif
                      @if($orders->bundle->user->state_id == !NULL)
                        {{ $orders->bundle->user->country['name'] }}
                      @endif
                      <br>

                    {{ __('frontstaticword.Phone') }}: {{ $orders->bundle->user['mobile'] }}<br>
                    {{ __('frontstaticword.Email') }}: {{ $orders->bundle->user['email'] }}
                
                  @endif
              </th>
              <!-- /.col -->
              <th class="col-sm-4 invoice-col">
                To:
                
                  <strong>{{ $orders->user['fname'] }}</strong><br>
                  {{ __('frontstaticword.address') }}: {{ $orders->user['address'] }}<br>
                    @if($orders->user->state_id == !NULL)
                      {{ $orders->user->state['name'] }},
                    @endif
                    @if($orders->user->country_id == !NULL)
                      {{ $orders->user->country['name'] }}
                    @endif
                    <br>
                  {{ __('frontstaticword.Phone') }}: {{ $orders->user['mobile'] }}<br>
                  {{ __('frontstaticword.Email') }}: {{ $orders->user['email'] }}
                
              </th>
              <!-- /.col -->
              <th class="col-sm-4 invoice-col">
                <b>{{ __('frontstaticword.OrderID') }}:</b> {{ $orders['order_id'] }}<br>
                <b>{{ __('frontstaticword.TransactionID') }}:</b> {{ $orders['transaction_id'] }}<br>
                <b>{{ __('frontstaticword.PaymentMode') }}:</b> {{ $orders['payment_method'] }}<br>
                <b>{{ __('frontstaticword.Currency') }}:</b> {{ $orders['currency'] }}</br>
                <b>{{ __('frontstaticword.PaymentStatus') }}:</b> 
                @if($orders->status ==1)
                  {{ __('frontstaticword.Recieved') }}
                @else 
                  {{ __('frontstaticword.Pending') }}
                @endif
              </th>
            </tr>
            </thead>
          </table>
             
        </div>
        <!-- /.row -->
        <div class="order-table table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="invoice-col">{{ __('frontstaticword.Courses') }}</th>
                <th class="invoice-col">{{ __('frontstaticword.Instructor') }}</th>
                <th class="invoice-col">{{ __('frontstaticword.Currency') }}</th>
                @if($orders->coupon_discount != 0)
                <th class="text-center invoice-col">Coupon Discount</th>
                @endif
                <th class="txt-rgt invoice-col">{{ __('frontstaticword.Total') }}</th>
              </tr>
            </thead>
            <tbody >
              <tr class="view-order">
                @if($orders->course_id != NULL)
                  <td>{{ $orders->courses['title'] }}</td>
                  <td>{{ $orders->courses->user['email'] }}</td>
                @else
                  <td>{{ $orders->bundle['title'] }}</td>
                  <td>{{ $orders->bundle->user['email'] }}</td>
                @endif

                <td>{{ $orders['currency'] }}</td>

                @if($orders->coupon_discount != 0)
                <td class="text-center">
                  (-)&nbsp;<i class="{{ $orders['currency_icon'] }}"></i>{{ $orders['coupon_discount'] }}
                </td>
                @endif

                <td class="txt-rgt">
                  @if($orders->coupon_discount == !NULL)
                    <i class="fa {{ $orders['currency_icon'] }}"></i>{{ $orders['total_amount'] - $orders['coupon_discount'] }}
                  @else
                    <i class="fa {{ $orders['currency_icon'] }}"></i>{{ $orders['total_amount'] }}
                  @endif
                </td>
               
              </tr>
            </tbody>
          </table>

           @if($orders->bundle_id != NULL)

          @foreach($bundle_order->course_id as $bundle_course)
              @php
                $coursess = App\Course::where('id', $bundle_course)->first();
              @endphp

              <div class="purchase-table table-responsive">
                <table class="table">

              <tbody>
                <tr>
                  <td>
                    <div class="purchase-history-course-img">
                    
                        @if($coursess['preview_image'] !== NULL && $coursess['preview_image'] !== '')
                            <a href="{{ route('course.content',['id' => $orders->bundle->id, 'slug' => $orders->bundle->slug ]) }}"><img src="{{ asset('images/course/'. $coursess->preview_image) }}" class="img-fluid" alt="course"></a>
                          @else
                            <a href="{{ route('course.content',['id' => $orders->bundle->id, 'slug' => $orders->bundle->slug ]) }}"><img src="{{ Avatar::create($coursess->title)->toBase64() }}" class="img-fluid" alt="course"></a>
                          @endif

                    </div>
                    <div class="purchase-history-course-title">
                      <a href="{{ route('course.content',['id' => $orders->bundle->id, 'slug' => $orders->bundle->slug ]) }}">{{ $coursess->title }}</a>
                    </div>
                  </td>
                </tr>
              </tbody>
                </table>
              </div>
          @endforeach

        @endif
        </div>
      </div>

    </div>
    </div>
</section>
<!-- footer start -->

<!-- footer end -->
<!-- jquery -->
<script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
<script src="{{ url('js/bootstrap.bundle.js') }}"></script> <!-- bootstrap js -->
<!-- end jquery -->
</body>
<!-- body end -->
</html> 



