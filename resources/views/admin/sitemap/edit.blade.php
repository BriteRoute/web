@extends('admin.layouts.master')
@section('title', 'Create SiteMap - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-6">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.SiteMap') }}</h3>
           		</div>

           		
					
	          	<div class="panel-body">
	          		<h5 class="panel-title">{{ __('adminstaticword.GenerateSitemap') }} :</h5>
	          		<br>
	          		<div class="panel panel-default">
	          			<div class="panel-body">
			          		<form action="{{ action('SiteMapController@sitemap') }}" method="POST" enctype="multipart/form-data">
				                {{ csrf_field() }}
				                {{ method_field('POST') }}
				                
				               
				              	<button type="submit" class="btn btn-default btn-block">{{ __('adminstaticword.GenerateSitemap') }}</button>
				              

				          	</form>
				        </div>
		          	</div>


		          	@php
	          			$path = 'sitemap.xml';
	          		@endphp

	          		@if(file_exists(public_path().'/'.$path))

		          
		          	<h5 class="panel-title">{{ __('adminstaticword.DownloadSitemap') }} :</h5>
		          	<br>
	          		<div class="panel panel-default">
          				<div class="panel-body">
				           	<form action="{{ action('SiteMapController@download') }}" method="POST" enctype="multipart/form-data">
				                {{ csrf_field() }}
				                {{ method_field('POST') }}
				              
				              	
				              	<button type="submit" class="btn btn-default btn-block">{{ __('adminstaticword.DownloadSitemap') }}</button>
				          	</form>
			      		</div>
			  		</div>


			  		@endif


		            
	          	</div>

	      	</div>
      	</div>
  	</div>
</section>
@endsection




