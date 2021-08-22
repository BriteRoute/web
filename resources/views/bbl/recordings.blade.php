@extends('admin/layouts.master')
@section('title', 'List all Recordings')
@section('body')
<section class="content">
  @include('admin.message')

  <div class="box">
	<div class="box-header with-border">
		<div class="box-title">
			List All Recordings 
		</div>

	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered">
			<thead>
				<th>
					#
				</th>
				<th>
					Meeting ID
				</th>
				<th>
					Meeting Name 
				</th>
				<th>
					Get Recording 
				</th>
				
			</thead>

			<tbody>
				<?php $i=0;?>

				@if(isset($all_recordings['recording']))
				@foreach($all_recordings['recording'] as $meeting)
				<?php $i++;?>
					<tr>
						<td><?php echo $i;?></td>
						<td><b>{{ $meeting->meetingID }}</b></td>
						<td><b>{{ $meeting->name }}</b></td>
						

						<td>

							 <a href="{{ $meeting->playback->format->url }}" target="_blank" class="btn btn-primary">Play Recording </a>
						</td>
						
						


					</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>

</section>

@endsection