@extends('admin.layouts.master')
@section('title', 'IP Block Settings - Admin')
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
              		<h3 class="box-title">{{ __('adminstaticword.IPBlockSettings') }} </h3>
           		</div>
	          	<div class="panel-body">
	          		<form action="{{ url('admin/ipblock/update') }}" method="POST">
			            @csrf

			            <div class="form-group">

			            	<label for="url">Enter IP Address to block (ex: 172.16.254.1, 506.457.14.512)</label>
			                  
			                <select class="form-control js-example-basic-single" name="ipblock[]" multiple="multiple" size="5">


							@if(is_array($settings['ipblock']) || is_object($settings['ipblock']))

		                      @foreach($settings['ipblock'] as $cat)
								
		                        <option value="{{ $cat }}" {{in_array($cat, $settings['ipblock'] ?: []) ? "selected": ""}} >{{ $cat }}
		                        </option>
		                       

		                      @endforeach
		                    @endif

		                    </select>

		                </div>

		                <div class="box-footer">

				            <button type="submit" class="btn btn-primary">{{ __('adminstaticword.Update') }}</button>

				        </div>
			        </form>
	          	</div>
	      	</div>
      	</div>
  	</div>
</section>
@endsection

@section('scripts')

<script type="text/javascript">
	
</script>

@endsection