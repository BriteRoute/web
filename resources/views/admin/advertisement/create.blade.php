@extends('admin/layouts.master')
@section('title', 'Add Advertisement - Admin')
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
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Advertisement') }}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('advertisement/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
                      
           
             

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                  
                  <input type="file" class="form-control" name="image1" id="exampleInputTitle">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('adminstaticword.RecommnadedSize') }} (1375 x 409px)</small>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.EnterURL') }}:<sup class="redstar">*</sup></label>
                  <input type="title" class="form-control" name="url1" id="exampleInputTitle" placeholder="{{ __('adminstaticword.EnterURL') }}" >

                </div>
              </div>
              <br>

              <div class="row">


                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Position') }}:<sup class="redstar">*</sup></label>
                  <select class="form-control js-example-basic-single" name="position">
                     <option value="none" selected disabled hidden> 
                      {{ __('adminstaticword.SelectanOption') }}
                    </option>

                    <option value="belowslider">Below Slider</option>

                    <option value="belowrecent">Below Recent Courses</option>

                    <option value="belowbundle">Below Bundle Courses</option>

                    <option value="belowtestimonial">Below Testimonial</option>
                    
                  </select>
                </div>

                <div class="col-md-6">
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

