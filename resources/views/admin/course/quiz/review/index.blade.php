@extends('admin.layouts.master')
@section('title', 'Quiz Review - Admin')
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
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Quiz') }} {{ __('adminstaticword.Answer') }} {{ __('adminstaticword.Review') }}  </h3>
        </div>
        

        
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.Topic') }}</th>
                  <th>{{ __('adminstaticword.Question') }}</th>
                 <th>{{ __('adminstaticword.Answer') }}</th>
                  <th>{{ __('adminstaticword.View') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($answers as $answer)
                <?php $i++;?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td>{{$answer->courses->title}}</td>
                    <td>{{$answer->topic->title}}</td> 
                    <td>{!!$answer->quiz->question!!}</td>
                 
                    <td>{!! $answer->txt_answer !!}</td>
                 
                    <td>

                      <form action="{{ route('quizreview.quick',$answer->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $answer->txt_approved ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($answer->txt_approved ==1)
                                {{ __('adminstaticword.Approved') }}
                              @else
                                {{ __('adminstaticword.Pending') }}
                              @endif
                            </button>
                          </form>
                      

                     
                    </td>
                  </tr>

                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  


</section> 

@endsection
