@extends('admin/layouts.master')
@section('title', 'Twilio Settings - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">  {{ __('Twilio SMS Channel Settings') }}</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{ route('twilio.update') }}" method="POST">
                @csrf

                 <br>
              <div class="row">
                  <div class="col-md-12">
                       <div class="form-group">
                          <label for="aamar_pay">{{ __('Twilio Enable') }}</label>
                          <li class="tg-list-item">
                              <input class="tgl tgl-skewed" id="aamar_pay" type="checkbox" name="twilio_enable" {{ $settings->twilio_enable == '1' ? 'checked' : '' }} />
                              <label class="tgl-btn" data-tg-off="NO" data-tg-on="YES" for="aamar_pay"></label>
                          </li>
                      </div>
                  </div>

                  <div class="col-md-12">
                        <div class="form-group">
                            <label>TWILIO SID: <sup class="redstar">*</sup></label>
                            <input name="TWILIO_SID" type="text" value="{{ env('TWILIO_SID') }}" class="form-control">
                        </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>TWILIO AUTH TOKEN: <sup class="redstar">*</sup></label>
                        <input name="TWILIO_AUTH_TOKEN" type="text" value="{{ env('TWILIO_AUTH_TOKEN') }}" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label>TWILIO NUMBER:<sup class="redstar">*</sup></label>
                        <input name="TWILIO_NUMBER" type="text" value="{{ env('TWILIO_NUMBER') }}" class="form-control">
                    </div>
                 </div>

               </div>

               <br>



                 <div class="box-footer">
                   
                       <button value="" type="submit"  class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
                   
                 </div>
              </div>
            </form>

          
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
