@extends('admin/layouts.master')
@section('title', 'Add Blog - Admin')
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
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.AddBlog') }}</h3>
        </div>
        <div class="panel-body">
          <form id="demo-form2" method="post" action="{{action('BlogController@store')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <input  type="hidden" class="form-control" name="user_id" value="{{ Auth::User()->id }}" >

            <div class="row">
              <div class="col-md-6">
                <label for="date">{{ __('adminstaticword.Date') }}:<sup class="redstar">*</sup></label>
                <div class="input-group date">
                  <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" type="text" id="datepicker" name="date" placeholder="{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Date') }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <label for="heading">{{ __('adminstaticword.Heading') }}:<sup class="redstar">*</sup></label>
                <input class="form-control" type="text" name="heading" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Heading') }}" required>
              </div>
            </div>
            <br>


            <div class="row">
              <div class="col-md-6">
                <label for="text">{{ __('adminstaticword.ButtonText') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="text" id="text" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ButtonText') }}">
              </div>

              <div class="col-md-6">
                  <label for="exampleInputSlug">{{ __('adminstaticword.Slug') }}: <sup class="redstar">*</sup></label>
                  <input pattern="[/^\S*$/]+"  type="text" class="form-control" name="slug" id="exampleInputPassword1" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Slug') }}" value="{{ (old('slug')) }}" required>
                </div>
               
            </div>
              
            <br>

            <div class="row">
              <div class="col-md-12">
                <label for="detail">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="detail" rows="5"  class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Detail') }}"></textarea>
              </div>
            </div>
            <br> 

            @if(Auth::user()->role == 'admin')

            <div class="row">

              <div class="col-md-6">
                
                <label for="image">{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                <input type="file" name="image" id="image" required>
              </div>

              <div class="col-md-3">
                <label for="exampleInputDetails">{{ __('adminstaticword.Approved') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="approved" type="checkbox" name="approved" >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="approved"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="approved" id="approved">
              </div>
               <div class="col-md-3">
                <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>
                
            </div>

            @endif


            <br>
          
            <div class="box-footer">
              <button type="submit" value="Add Blog" class="btn btn-lg col-md-3 btn-primary">+ {{ __('adminstaticword.AddBlog') }}</button>
            </div>
          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 

@endsection


