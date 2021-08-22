@extends('admin.layouts.master')
@section('title', 'Edit Blog - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
      <div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.UpdateBlog') }}</h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{route('blog.update',$show->id)}}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}

		                <div class="row">
		              	  <div class="col-md-6">
		                    <label for="image">{{ __('adminstaticword.Date') }}<sup class="redstar">*</sup></label>
		                    <div class="input-group date">
				                <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                </div>
		                    	<input name="date" value="{{ $show->date }}" id="datepicker" autofocus required type="text" class="form-control" placeholder="{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Date') }}"/>
		                    </div>
		                  </div>
		                  <div class="col-md-6 display-none">
		                    <label for="heading">{{ __('adminstaticword.User') }}<sup class="redstar">*</sup></label>
		                    <select name="user_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
			                    <option  value="{{ $show->user_id }}">{{  $show->user->fname }}</option>
			                </select>
			              </div>

			                <div class="col-md-6">
		                    <label for="heading">{{ __('adminstaticword.Heading') }}<sup class="redstar">*</sup></label>
		                    <input value="{{ $show->heading }}" autofocus required name="heading" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Heading') }}"/>
		                  </div>
		              	</div>
		              	<br>

		              	<div class="row">
		                
		                  <div class="col-md-6">
		                    <label for="text">{{ __('adminstaticword.ButtonText') }}</label>
		                    <input value="{{ $show->text }}" autofocus name="text" type="text" class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ButtonText') }}"/>
		                  </div>

		                   <div class="col-md-6">
			                  <label for="exampleInputSlug">{{ __('adminstaticword.Slug') }}: <sup class="redstar">*</sup></label>
			                  <input pattern="[/^\S*$/]+" type="text" class="form-control" name="slug" id="exampleInputPassword1" value="{{ $show->slug}}" required>
			                </div>
		              	</div>
		              	<br>
		              	<div class="row">
		                  <div class="col-md-12">
		                    <label for="detail">{{ __('adminstaticword.Detail') }}<sup class="redstar">*</sup></label>
		                    <textarea id="detail" name="detail" rows="5"  class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Detail') }}">{{ $show->detail }}</textarea>
		                  </div>
		                 
		              	</div>
		              	<br>

		              	@if(Auth::user()->role == 'admin')

		              	<div class="row">

		              		<div class="col-md-4">
			                    <label for="image">{{ __('adminstaticword.Image') }}<sup class="redstar">*</sup></label>
			                    <input type="file" name="image"  id="image"><br><img src="{{ url('/images/blog/'.$show->image) }}" class="img-responsive" />
			                </div>

		              		<div class="col-md-4">
				                <label for="exampleInputTit1e">{{ __('adminstaticword.Approved') }}:</label>
				                <li class="tg-list-item">              
				                    <input class="tgl tgl-skewed" id="approved" type="checkbox" name="approved" {{ $show->approved == '1' ? 'checked' : '' }} >
				                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="approved"></label>
				                </li>
				                <input type="hidden"  name="free" value="0" for="approved" id="approved">
		              		</div>
		              		<div class="col-md-4">
		              			<label for="exampleInput">{{ __('adminstaticword.Status') }}:</label>
				                <li class="tg-list-item">              
				                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $show->status == '1' ? 'checked' : '' }} >
				                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
				                </li>
				                <input type="hidden"  name="free" value="0" for="status" id="status">
		              		</div>
		              	</div>
		              	<br>

		              	@endif
						
						<div class="box-footer">
		              		<button value="" type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
		              	</div>

		          	</form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection

