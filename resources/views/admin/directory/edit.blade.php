@extends('admin/layouts.master')
@section('title', 'Edit Directory - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Directory') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post"  action="{{url('directory/'.$show->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
           

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.City') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="heading" id="exampleInputTitle" value="{{$show->city}}">
                </div>
          
               
              </div>
              <br> 

              <div class="row">
               
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea type="text" id="detail" class="form-control" name="detail" id="exampleInputTitle">{{$show->detail}}</textarea>
                </div>
              </div>
              <br> 

              <div class="row">
                
                <div class="col-md-4">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $show->status == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Disable') }}" data-tg-on="{{ __('adminstaticword.Enable') }}" for="status"></label>
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
