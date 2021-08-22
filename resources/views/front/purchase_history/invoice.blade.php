@extends('theme.master')
@section('title', 'Invoice')
@section('content')

@include('admin.message')


<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('frontstaticword.Invoice') }}</h1>
    </div>
</section> 
<!-- about-home end -->
<section id="purchase-block" class="purchase-main-block">
	<div class="container">
		<div class="panel-body">
					
			<div id="printableArea">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="page-header">
              @php
                  $setting = App\setting::first();
              @endphp
              <div class="invoice-logo">
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
          <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From:
                @if($orders->course_id != NULL)
                  <address>
                    <strong>{{ $orders->courses->user['fname'] }}</strong><br>
                    
                   
                    {{ __('frontstaticword.address') }}: {{ $orders->courses->user['address'] }}<br>
                      @if($orders->courses->user['state_id'] == !NULL)
                        {{ $orders->courses->user->state['name'] }},
                      @endif
                      @if($orders->courses->user['country_id'] == !NULL)
                        {{ $orders->courses->user->country['name'] }}
                      @endif
                      <br>

                    {{ __('frontstaticword.Phone') }}: {{ $orders->courses->user['mobile'] }}<br>
                    {{ __('frontstaticword.Email') }}: {{ $orders->courses->user['email'] }}
                  </address>
                @else
                  <address>
                    <strong>{{ $orders->bundle->user['fname'] }}</strong><br>
                    
                   
                    {{ __('frontstaticword.address') }}: {{ $orders->bundle->user['address'] }}<br>
                      @if($orders->bundle->user->state_id == !NULL)
                        {{ $orders->bundle->user->state['name'] }},
                      @endif
                      @if($orders->bundle->user->country_id == !NULL)
                        {{ $orders->bundle->user->country['name'] }}
                      @endif
                      <br>

                    {{ __('frontstaticword.Phone') }}: {{ $orders->bundle->user['mobile'] }}<br>
                    {{ __('frontstaticword.Email') }}: {{ $orders->bundle->user['email'] }}
                  </address>
                  @endif
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To:
                <address>
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
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                
                <br>
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
                </br>
                <b>{{ __('frontstaticword.Enrollon') }}:</b> {{ date('jS F Y', strtotime($orders['created_at'])) }}</br>
                <b>
                  @if($orders->enroll_expire != NULL)
                    {{ __('frontstaticword.EnrollEnd') }}:</b> {{ date('jS F Y', strtotime($orders['enroll_expire'])) }}</br>
                  @endif
              </div>
              <!-- /.col -->
          </div>
        </div>
        <!-- /.row -->
        <div class="order-table table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>{{ __('frontstaticword.Courses') }}</th>
                <th>{{ __('frontstaticword.Instructor') }}</th>
                <th>{{ __('frontstaticword.Currency') }}</th>
                @if($orders->coupon_discount != 0)
                <th class="text-center">Coupon Discount</th>
                @endif
                <th class="txt-rgt">{{ __('frontstaticword.Total') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @if($orders->course_id != NULL)
                  <td>{{ $orders->courses['title'] }}</td>
                  <td>{{ $orders->courses->user['email'] }}</td>
                @else
                  <td>{{ $orders->bundle['title'] }}</td>
                  <td>{{ $orders->bundle->user['email'] }}</td>
                @endif

                
                <td>{{ $orders['currency'] }}</td>

                @if($orders->coupon_discount != 0)
                  @if($gsetting['currency_swipe'] == 1)
                    <td class="text-center">
                      (-)&nbsp;<i class="{{ $orders['currency_icon'] }}"></i>{{ $orders['coupon_discount'] }}
                    </td>
                  @else
                    <td class="text-center">
                      (-)&nbsp;{{ $orders['coupon_discount'] }}<i class="{{ $orders['currency_icon'] }}"></i>
                    </td>
                  @endif
                @endif

                <td class="txt-rgt">
                  @if($orders->coupon_discount == !NULL)
                    @if($gsetting['currency_swipe'] == 1)
                      <i class="fa {{ $orders['currency_icon'] }}"></i>{{ $orders['total_amount'] - $orders['coupon_discount'] }}
                    @else
                      {{ $orders['total_amount'] - $orders['coupon_discount'] }}<i class="fa {{ $orders['currency_icon'] }}"></i>
                    @endif
                  @else
                    @if($gsetting['currency_swipe'] == 1)
                      <i class="fa {{ $orders['currency_icon'] }}"></i>{{ $orders['total_amount'] }}
                    @else
                      {{ $orders['total_amount'] }}<i class="fa {{ $orders['currency_icon'] }}"></i>
                    @endif
                  @endif
                </td>
               
              </tr>
            </tbody>
          </table>
        </div>

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
                            <a href="{{ route('course.content',['id' => $coursess->id, 'slug' => $coursess->slug ]) }}"><img src="{{ asset('images/course/'. $coursess->preview_image) }}" class="img-fluid" alt="course"></a>
                          @else
                            <a href="{{ route('course.content',['id' => $coursess->id, 'slug' => $coursess->slug ]) }}"><img src="{{ Avatar::create($coursess->title)->toBase64() }}" class="img-fluid" alt="course"></a>
                          @endif

                    </div>
                    <div class="purchase-history-course-title">
                      <a href="{{ route('course.content',['id' => $coursess->id, 'slug' => $coursess->slug ]) }}">{{ $coursess->title }}</a>
                    </div>
                  </td>
                </tr>
              </tbody>
                </table>
              </div>
          @endforeach

        @endif
      </div>
			<div class="print-btn">
			  <input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="Print" />
      </div>

       <div class="print-btn">
          <a href="{{route('invoice.download',$orders->id)}}" target="_blank" class="btn btn-secondary">{{ __('frontstaticword.Download') }}</a>
        </div>

    </div>
	</div>
</section>

@endsection

@section('custom-script')

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	 }
</script>
@endsection
