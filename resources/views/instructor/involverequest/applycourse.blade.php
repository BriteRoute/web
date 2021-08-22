@extends('admin/layouts.master')
@section('title', 'Apply Course - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.InvolvedInCourse') }}</h3>
        </div>
       
        <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ __('adminstaticword.Image') }}</th>
                    <th>{{ __('adminstaticword.Title') }}</th>
                    <th>{{ __('adminstaticword.Instructor') }}</th>
                    <th>{{ __('adminstaticword.Status') }}</th>
                   <th>{{ __('adminstaticword.Edit') }}</th>
                   
                  </tr>
                </thead>

                <tbody>
                  <?php $i=0;?>
                   
                      @foreach($involve_requests as $cat)
                        <?php $i++;?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td>
                            @if($cat->course['preview_image'] != NULL && $cat->course['preview_image'] != '')
                                <img src="{{ url('/images/course/'.$cat->course['preview_image']) }}" class="img-responsive" >
                            @else
                                <img src="{{ Avatar::create($cat->course->title)->toBase64() }}" class="img-responsive" >
                            @endif
                          </td>
                          <td>{{$cat->course->title}}</td>
                          <td>{{ $cat->user['fname'] }}</td>
                          
                          <td>
                            <form action="{{ route('course.quick',$cat->id) }}" method="POST">
                              {{ csrf_field() }}
                              <button  type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                                @if($cat->status ==1)
                                  {{ __('adminstaticword.Active') }}
                                @else
                                  {{ __('adminstaticword.Deactive') }}
                                @endif
                              </button>
                            </form>
                          </td>
                          <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('course.show',$cat->course_id) }}">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                          </td>

                          
                        </tr>
                      @endforeach
                 
                </tbody>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
</section>
@endsection
