@extends('admin/layouts.master')
@section('title', 'List all Recordings')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title">
			 {{ __('List All Recordings') }}

		</div>
		 <a class="btn btn-info btn-sm" href="{{url('meeting-recordings/create')}}">
              <i class="glyphicon glyphicon">+</i> {{ __('adminstaticword.Add') }}</a>

	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered">
			<thead>
				<th>
					#
				</th>
				
				<th>
					{{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.Name') }}  
				</th>
				<th>
					{{ __('adminstaticword.Edit') }} 
				</th>
				<th>
					{{ __('adminstaticword.Meeting') }} {{ __('adminstaticword.URL') }} 
				</th>
				
			</thead>

			<tbody>
				<?php $i=0;?>

				@foreach($recordings as $recording)
				<?php $i++;?>
					<tr>
						<td><?php echo $i;?></td>
						<td><b>{{ $recording->title }}</b></td>

						 <th><a class="btn btn-success btn-sm" href="{{url('meeting-recordings/'.$recording->id)}}">
                  			<i class="glyphicon glyphicon-pencil"></i></a></th>

						<td>

							 <a href="{{ $recording->url }}" target="_blank" class="btn btn-primary"> {{ __('adminstaticword.View') }}  {{ __('Recording') }}  </a>
						</td>
					</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
</div>

</section>

@endsection