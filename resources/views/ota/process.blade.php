@extends('admin.layouts.master')
@section('title', 'Update Process - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
	<div class="row">
        <div class="col-xs-12">
        	<div class="box box-primary">
	           	<div class="box-header with-border">
              	<h3 class="box-title">{{ __('adminstaticword.UpdateProcess') }}</h3>
           		</div>

           		
					
	          	<div class="panel-body">
	          		<br>
	          		<div class="well">
	          			<br>

	          			<h5><b>Note: Before Update Take Backup of All Files And Database. Make .zip file and download all file, Go To phpmyadmin and select your database and export it.<br/></b></h5>
						<p>Copy All files and paste to you folder replace file. Only be careful when replace files in public folder, don't copy<code> .env </code>file. Any user customize design and code please do not update.</p>

						<h5><b>Update to Latest Version <br/></b></h5>
						<p>Copy All files of folder and paste to you folder and replace files, only be careful when replace files in public folder, don't copy<code> .env </code>file.Any user customize design and code please do not update.</p>
						<p>After replacing the files successfully <b>login with admin goto yourdomain.com/ota/update</b>. If your domain contain public then goto <b>yourdomain.com/public/ota/update</b>. Read update pre-notes and FAQ properly, then check the agreement box and click on update. After the update completion you will be redirected to yourdomain with a successful update message.</p>
						</p> Once the process is complete you will see a successful message on your home page.

						<p><b>You successfully upgraded to latest version </b></p>
						<br>

						
	          			
		          	</div>
		            
	          	</div>

	      	</div>
      	</div>
  	</div>
</section>
@endsection




