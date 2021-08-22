@extends('admin/layouts.master')
@section('title', 'Edit Meeting Recordings - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.MeetingRecordings') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form" method="post"  action="{{url('meeting-recordings/'.$recording->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
           

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{$recording->title}}">
                </div>
          
                <div class="col-md-6">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.URL') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="url" id="exampleInputTitle" value="{{$recording->url}}">
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
