@extends('admin/layouts.master')
@section('title', 'Edit Slider - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Slider') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post"  action="{{url('slider/'.$cate->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
           

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Heading') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="heading" id="exampleInputTitle" value="{{$cate->heading}}">
                </div>
          
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.SubHeading') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="sub_heading" id="exampleInputTitle" value="{{$cate->sub_heading}}">
                </div>
              </div>
              <br> 

              <div class="row">
                <div class="col-md-6 display-none">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.SearchText') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="search_text" id="exampleInputTitle" value="0">
                </div>
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="detail" id="exampleInputTitle" value="{{$cate->detail}}">
                </div>
              </div>
              <br> 

              <div class="row">
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                  <br>
                  <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('adminstaticword.Recommendedsize') }} (1375 x 409px)</small>
                    <input type="file" name="image"  id="image"><img src="{{ url('/images/slider/'.$cate->image) }}"/>

                  </br>
                </div>
                <div class="col-md-3">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:<sup class="redstar">*</sup></label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Disable') }}" data-tg-on="{{ __('adminstaticword.Enable') }}" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>


                <div class="col-md-3">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.TextPosition') }}:<sup class="redstar">*</sup></label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="left" type="checkbox" name="left" {{ $cate->left == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Left') }}" data-tg-on="{{ __('adminstaticword.Right') }}" for="left"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="left" id="left">
                </div>

                <div class="col-md-3">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.SearchonSlider') }}:<sup class="redstar">*</sup></label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="search_enable" type="checkbox" name="search_enable" {{ $cate->search_enable == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Disable') }}" data-tg-on="{{ __('adminstaticword.Enable') }}" for="search_enable"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="search_enable" id="search_enable">
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
