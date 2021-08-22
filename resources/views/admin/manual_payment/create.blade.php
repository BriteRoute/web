@extends('admin/layouts.master')
@section('title', 'Add Manual Payment Gateway - Admin')
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
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.ManualPaymentGateway') }}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('manualpayment/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
                      
           
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                  <input class="form-control" type="text" name="name" placeholder="">
                </div>
               
              </div>
              <br>

              <div class="row">
               
                <div class="col-md-8 col-md-offset-2">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="detail" rows="1" class="form-control" id="detail" placeholder="Enter Details"></textarea>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <label for="exampleInputSlug"> {{ __('adminstaticword.Image') }}</label>
                  <br>
                  <input type="file" name="image" id="image" class="form-control"/>
                 
                </div>
              </div>
              <br>

              <div class="row">

                <div class="col-md-4 col-md-offset-2">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <br>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>

               
              </div>
              <br>
      
              <div class="box-footer">
                <button type="submit" value="Add Slider" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>
         
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

