@extends('admin/layouts.master')
@section('title', 'Admin Revenue - Admin')
@section('body')

<section class="content">

  @include('admin.message')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('adminstaticword.AdminRevenue') }}</h3>
       
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Enrolled') }}{{ __('adminstaticword.Courses') }}</th>
                  <th>{{ __('adminstaticword.AdminRevenue') }}</th>
                  <th>{{ __('adminstaticword.Enrolled') }} {{ __('adminstaticword.Date') }}</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                 
                    @foreach($orders as $order)
                      <?php $i++;?>

                      @php
                        $revenue = App\PendingPayout::where('order_id', $order->id)->first();


                        if(isset($revenue->instructor_revenue)){

                          $ull = $revenue->instructor_revenue;

                        }else{
                          $ull = 0;
                        }
                      @endphp


                      <tr>
                        <td><?php echo $i;?></td>
                        <td>{{ $order->courses->title }}</td>
                      

                        <td>
                        @if($gsetting['currency_swipe'] == 1)

                          <i class="fa {{ $order['currency_icon'] }}"></i> 
                          @if($order->total_amount != NULL && $order->total_amount != '')
                          {{ $order->total_amount - $ull }}

                          @endif
                        

                        @else

                        @if($order->total_amount != NULL && $order->total_amount != '')
                          {{ $order->total_amount -  $ull }} 

                          @endif
                        

                         <i class="fa {{ $order['currency_icon'] }}"></i>

                        @endif

                        </td>

                        <td>{{  date('d-m-Y', strtotime($order->created_at)) }}</td>
                       
                    
                      </tr>
                    @endforeach
                 
              </tbody>
            </table>
          </div>
        </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>


</section>

@endsection
