@extends('admin/layouts.master')
@section('title', 'Add Directory - Admin')
@section('body')


<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Directory') }}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('directory/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
                      
           
              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.City') }}:<sup class="redstar">*</sup></label>
                  <input class="form-control" type="text" name="city" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.City') }}">
                </div>
                {{-- <div class="col-md-6">
                  <label for="exampleInputSlug">{{ __('adminstaticword.SubHeading') }}:<sup class="redstar">*</sup></label>
                  <input type="slug" class="form-control" name="sub_heading" id="exampleInputPassword1" placeholder="Please Enter Your Sub Heading">
                </div> --}}
              </div>
              <br>

              <div class="row">
               
                <div class="col-md-12">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="detail" id="detail" rows="1" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Detail') }}"></textarea>
                </div>
              </div>
              <br>

             

              <div class="row">
                <div class="col-md-4">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <br>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                    <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Disable') }}" data-tg-on="{{ __('adminstaticword.Enable') }}" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>

                
              </div>
              <br>
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

