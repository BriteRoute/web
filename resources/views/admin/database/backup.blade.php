@extends('admin.layouts.master')
@section('title', 'Database Backup - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')

	<div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.DatabaseBackup') }}</h3>
           		</div>

           		
					
	          	<div class="panel-body">
	          		<div class="well">
	          			<h3 class="box-title">{{ __('MySQL Dump Path') }}</h3>
		          		<form action="{{ action('DatabaseController@update') }}" method="POST" enctype="multipart/form-data">
					                {{ csrf_field() }}
					                {{ method_field('POST') }}
			          		<div class="input-group input-group-sm">
				                <input type="text" name="DUMP_BINARY_PATH" value="{{ $dump }}" class="form-control">
			                    <span class="input-group-btn">
			                      <button type="submit" class="btn btn-primary btn-block">{{ __('adminstaticword.Save') }}!</button>
			                    </span>
			              	</div>

			              	 <small class="text-muted"><i class="fa fa-info-circle"></i> {{ __('adminstaticword.ImportantNote') }}:
                            
	                            <br>

	                            • Usually in all hosting dump path for MYSQL is <b>/usr/bin/</b>
	                            <br>
	                            • If that path not work than contact your hosting provider with subject <b>"What is my MYSQL DUMP Binary path ?"</b>
	                            <br>
	                            • Enter the path without <b>mysqldump</b> in path"</b>
	                            


	                        </small>
			             </form>
	              	<br>
	              


	          		<h5 class="panel-title">{{ __('adminstaticword.GenerateBackup') }} :</h5>
	          		<br>
	          		<div class="panel panel-default">
	          			<div class="panel-body">
			          		<form action="{{ action('DatabaseController@genrate') }}" method="POST" enctype="multipart/form-data">
				                {{ csrf_field() }}
				                {{ method_field('POST') }}
				                
				               
				              	<button type="submit" class="btn btn-default btn-block">{{ __('adminstaticword.GenerateBackup') }}</button>
				              

				          	</form>
				        </div>
		          	</div>


		          	<div class="row">

			            <div class="col-md-8">

				          	<div class="list-backup">
					          	<ul>
			                        <li>
			                            {{ __('It will generate only database backup of your site.') }}
			                        </li>

			                        <li>
			                            <b>{{ __('Download URL is valid only for 1 (minute).') }}</b>
			                        </li>

			                        <li>
			                            Make sure <b>mysql dump is enabled on your server</b> for database backup and before run
			                            this or
			                            run only database backup command make sure you save the mysql dump path in
			                            <b>config/database.php</b>.
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </div>
		          </div>


	          	<div class="well">

		           	<div class="row">

			            <div class="col-md-6">

				           <p class="text-muted"> <b>Download the latest backup</b> </p>

				           

				          	@php

			          			$dir1 = storage_path() . '/app/'.config('app.name');

			          			$files = glob("$dir1/*");
			          		@endphp

				            @foreach (array_reverse($files) as $key=> $file)

				                @if($loop->first)
		                        <li><a href="{{ URL::temporarySignedRoute('database.download', now()->addMinutes(1), ['filename' => basename($file)]) }}"><b>{{ basename($file)  }}
                                    (Latest)</b></a></li>
		                        @else
		                        <li><a href="{{ URL::temporarySignedRoute('database.download', now()->addMinutes(1), ['filename' => basename($file)]) }}">{{ basename($file)  }}</a>
		                        </li>
		                        @endif

				            @endforeach
					    </div>

					     <div class="col-md-6">

					     	 <p class="text-muted"> <b>Delete all backups</b> </p>

					     	 <form action="{{ action('DatabaseController@deletebackup') }}" method="POST" enctype="multipart/form-data">
				                {{ csrf_field() }}
				                {{ method_field('POST') }}
				                
				               
				              	<button type="submit" class="btn btn-default">{{ __('Delete All Backups') }}</button>
				              

				          	</form>
			               
			            </div>
			        </div>

		            
	          	</div>

	      	</div>
      	</div>
  	</div>
</section>
@endsection


<style type="text/css">
	.list-backup ul li {
		list-style: inside!Important;

	}
</style>




