@extends('admin/layouts.master')
@section('title', 'Private Course - Admin')
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
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-10">
              <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.PrivateCourse') }}</h3>
            </div>
            <div  class="col-md-2">
                <div><h4 class="admin-form-text"><a href="{{url('private-course')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons"><button class="btn btn-xs btn-success abc"> << {{ __('adminstaticword.Back') }}</button> </i></a></h4></div>
            </div>
          </div>
        </div>
         
        <div class="box-body">
          <div class="form-group">
            <form action="{{url('private-course/')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }} 

              

              	<div class="form-group">
					        <label>{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Course') }}: <span class="redstar">*</span></label>
                  <select class="form-control js-example-basic-single" name="course_id"  size="5" row="5" placeholder="{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Course') }}">


                    @foreach ($courses as $cat)
                      @if($cat->status == 1)
                      <option value="{{ $cat->id }}">{{ $cat->title }}
                      </option>
                      @endif

                    @endforeach

                  </select>
				        </div>
                <br>

                <div class="form-group">
                  <label>{{ __('Hide from ') }} {{ __('adminstaticword.Users') }}: <span class="redstar">*</span></label>
                  <select class="form-control js-example-basic-single" name="user_id[]" multiple="multiple" size="5" row="5" placeholder="{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Users') }}">


                    @foreach ($users as $user)
                      @if($user->status == 1)
                      <option value="{{ $user->id }}">{{ $user->fname }}
                      </option>
                      @endif

                    @endforeach

                  </select>
                </div>
                <br>
              

              <div class="row">
                
              
                <div class="col-md-3">
                  @if(Auth::User()->role == "admin")
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">  
                    <input class="tgl tgl-skewed" id="cb3"   type="checkbox"/>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb3"></label>
                  </li>
                  <input type="hidden" name="status" value="0" id="test">
                  @endif
                </div>
                
              </div>
              <br>

             

              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Submit') }}</button>
              </div>

            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section> 

@endsection

@section('scripts')


<script>
(function($) {
"use strict";


  $(function() {
    $('.js-example-basic-single').select2();
  });

  
})(jQuery);
</script>
  
@endsection
