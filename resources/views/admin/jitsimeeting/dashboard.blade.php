@extends('admin/layouts.master')
@section('title', 'Your Jitsi Meetings')
@section('body')
<section class="content">
  @include('admin.message')
  <div class="box">
  	<div class="box-header with-border">
  		<div class="box-title">
  			
  		</div>

  		<a title="Create a new meeting" href="{{ route('jitsi.create') }}" class="pull-right btn btn-md btn-info">
  			<i class="fa fa-plus"></i> Create a new meeting
  		</a>
  	</div>

  	<div class="box-body">
		
		

  		<table class="table table-bordered table-striped table-hover">
  			<thead>
  				<th>
  				#
	  			</th>
	  			<th>
	  				Meeting ID
	  			</th>
	  		
	  			<th>
	  				Action
	  			</th>
  			</thead>

  			<tbody>

			  @php
  					$i = 0;
  				@endphp

  				@foreach($jitsimeeting as $key => $meeting)

  					@php
  						$i++;
  					@endphp
					<tr>
						<td>
						{{ $i }}
						</td>

						<td>
							<p><b>Meeting ID: </b>{{ $meeting['meeting_id'] }} </p>
							<p><b>Meeting Topic: </b>{{ $meeting['meeting_title'] }} </p>
							<p><b>Agenda: </b>{{ $meeting['agenda'] }}</p>
							<p><b>Start Time: </b>{{ $meeting['start_time'] }}</p>
							<p><b>End Time: </b>{{ $meeting['end_time'] }}</p>
							<p><b>Duration: </b>{{ $meeting['duration'] }}</p>	
						</td>

						<!-- <td>
							<a title="Join Meeting" target="_blank" href="">
								{{ $meeting['jitsi_url'] }}
							</a>
							
						</td> -->

						<td>
							<a title="Start Meeting" href="{{url('meetup-conferencing/'.$meeting->meeting_id) }}" class="btn btn-sm btn-info">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
							</a>
							<a title="Delete Meeting" data-toggle="modal" data-target="#delete{{ $meeting['meeting_id'] }}" class="btn btn-sm btn-primary">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>

						 <div id="delete{{ $meeting['meeting_id'] }}" class="delete-modal modal fade" role="dialog">
			                    <div class="modal-dialog modal-sm">
			                      <!-- Modal content-->
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal">&times;</button>
			                          <div class="delete-icon"></div>
			                        </div>
			                        <div class="modal-body text-center">
			                          <h4 class="modal-heading">Are You Sure ?</h4>
			                          <p>Do you really want to delete this meeting? This process cannot be undone.</p>
			                        </div>
			                        <div class="modal-footer">
									<form method="post" action="{{ route('deletemeeting.jitsi',$meeting['meeting_id']) }}" class="pull-right">
			                                         {{csrf_field()}}
			                                         {{method_field("DELETE")}}
			                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
			                            <button type="submit" class="btn btn-danger">Yes</button>
			                        </form>
									
			                        </div>
			                      </div>
			                    </div>
			                  </div>
					</tr>
					@endforeach
		
  			</tbody>
  		</table>

  		<div class="text-center">
  			
  		</div>

  	</div>
  </div>
</section>
@endsection