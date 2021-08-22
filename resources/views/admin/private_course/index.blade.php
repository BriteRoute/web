@extends('admin/layouts.master')
@section('title', 'Private Course - Admin')
@section('body')

<section class="content">

	@include('admin.message')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('adminstaticword.PrivateCourse') }}</h3>
        <a class="btn btn-info btn-sm" href="{{url('private-course/create')}}">
          <i class="glyphicon glyphicon">+</i> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.PrivateCourse') }}
        </a>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>
                
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                  
                    @foreach($private_courses as $course)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                       
                        <td>{{$course->courses->title}}</td>
                       
                         
                        <td>
                          
                              @if($course->status ==1)
                                {{ __('adminstaticword.Active') }}
                              @else
                                {{ __('adminstaticword.Deactive') }}
                              @endif
                           
                        </td>

                        <td>
                          <a class="btn btn-success btn-sm" href="{{ route('private-course.show',$course->id) }}">
                          <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>

                        <td>
                          <form  method="post" action="{{url('private-course/'.$course->id)}}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button onclick="return confirm('Are you sure you want to delete?')"  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                          </form>
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
  