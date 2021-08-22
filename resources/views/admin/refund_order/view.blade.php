@extends('admin/layouts.master')
@section('title', 'View Refund Request - Admin')
@section('body')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.OrderId') }} - {!! $refunds->order->order_id !!}</h3>
        </div>
        <div class="box-body">

          <div class="view-instructor">
                  <div class="instructor-detail">
                    <ul>
                      <li><img src="{{ asset('images/course/'.$refunds->courses->preview_image) }}" class="img-circle"/></li>
                      <li>{{ __('adminstaticword.User') }}: {{ $refunds->user->fname }} {{ $refunds->user->lname }}</li>
                      <li>{{ __('adminstaticword.OrderId') }}: {{ $refunds->order->order_id }}</li>
                      <li>{{ __('adminstaticword.Course') }}: {{ $refunds->courses->title }}</li>
                      <li>{{ __('adminstaticword.PaymentMethod') }}: {{ $refunds->payment_method }}</li>
                      <li>{{ __('adminstaticword.TotalAmount') }}: <i class="{{ $refunds['currency_icon'] }}"></i>{{ $refunds->total_amount }}</li>
                      <li>{{ __('adminstaticword.Reason') }}: {{ $refunds->reason }}</li>
                      <li>{{ __('adminstaticword.Detail') }}: {{ $refunds->detail }}</li>
                      

                    </ul>
                  </div>
            </div>

            @if($refunds->bank_id == !NULL)
            @php

            $user_detail = App\UserBankDetail::where('id', $refunds->bank_id)->first()

            @endphp

            <h3 class="box-title"> {{ __('adminstaticword.BankDetail') }}</h3>

            <div class="view-instructor">
              <div class="instructor-detail">
                <ul>
                  <li>{{ __('adminstaticword.User') }}: {{ $user_detail->user->fname }} </li>
                  <li>{{ __('adminstaticword.AccountHolderName') }}: {{ $user_detail->account_holder_name }} </li>
                  <li>{{ __('adminstaticword.BankName') }}: {{ $user_detail->bank_name }}</li>
                  <li>{{ __('adminstaticword.IFCSCode') }}: {{ $user_detail->ifcs_code }}</li>
                  <li>{{ __('adminstaticword.AccountNumber') }}: {{ $user_detail->account_number }}</li>

                </ul>
              </div>
            </div>


            @endif


          <div class="form-group">              
            <form id="demo-form2" method="post" action="{{url('refundorder/'.$refunds->id)}}" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data">
              {{ csrf_field() }}
              {{method_field('PATCH')}}


              @if( $refunds->status==0)

              <div class="row">
               
                <div class="col-md-12">
                   <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb10" type="checkbox" {{ $refunds->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Pending" data-tg-on="Accept" for="cb10"></label>
                  </li>
                  <input type="hidden" name="status" value="{{ $refunds->status }}" id="j">
                </div>
                
              </div>

              
              <br>

            

              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.ProceedRefund') }}</button>
              </div>
              @endif
            </form>
          </div>
       
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 
@endsection

@section('scripts')

 <script>
tinymce.init({
  selector: '#editor1,#editor2,.editor',
  height: 350,
  menubar: 'edit view insert format tools table tc',
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table paste wordcount'
  ],
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script>
@endsection
