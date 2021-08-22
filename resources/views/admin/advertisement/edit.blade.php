@extends('admin/layouts.master')
@section('title', 'Edit Advertisement - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Advertisement') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('advertisement/'.$advs->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
           

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                  
                  <input type="file" class="form-control" name="image1" id="exampleInputTitle">

                  <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('adminstaticword.RecommnadedSize') }} (1375 x 409px)</small>
                  <br>
                  <br>
                  <img src="{{ url('/images/advertisement/'.$advs->image1) }}"/>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.EnterURL') }}:<sup class="redstar">*</sup></label>
                  <input type="title" class="form-control" name="url1" id="exampleInputTitle" value="{{ $advs->url1 }}" placeholder="{{ __('adminstaticword.EnterURL') }}" >

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

                    <option {{ $advs->position == 'belowslider' ? 'selected' : ''}} value="belowslider">Below Slider</option>

                    <option {{ $advs->position == 'belowrecent' ? 'selected' : ''}} value="belowrecent">Below Recent Courses</option>

                    <option {{ $advs->position == 'belowbundle' ? 'selected' : ''}} value="belowbundle">Below Bundle Courses</option>

                    <option {{ $advs->position == 'belowtestimonial' ? 'selected' : ''}} value="belowtestimonial">Below Testimonial</option>
                    
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <br>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $advs->status == '1' ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>

               
              </div>
              <br>
      

         
           
              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-2 btn-primary">+ {{ __('adminstaticword.Save') }}</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col -->
  </div>
</section>

@endsection
