@extends('admin/layouts.master')
@section('title', 'View All Request Course - Admin')
@section('body')

<section class="content">

  <div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('adminstaticword.InvolvementCourse') }}</h3>
      
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
                  <th>{{ __('adminstaticword.Slug') }}</th>
                  <th>{{ __('adminstaticword.Featured') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                  @if(Auth::User()->role == "admin" || Auth::User()->role == "instructor")
                    @foreach($all_course as $cat)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($cat['preview_image'] != NULL && $cat['preview_image'] != '')
                              <img src="{{asset('images/course/'.$cat['preview_image'])}}" class="img-responsive" >
                          @else
                              <img src="{{ Avatar::create($cat->title)->toBase64() }}" class="img-responsive" >
                          @endif
                        </td>
                        <td>{{$cat->title}}</td>
                        <td>{{$cat->slug}}</td>
                        <td>
                          <form action="{{ route('course.featured',$cat->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $cat->featured ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($cat->featured ==1)
                              {{ __('adminstaticword.Yes') }}
                              @else
                              {{ __('adminstaticword.No') }}
                              @endif
                            </button>
                          </form>
                        </td>
                         
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

                           @php
                              $involvement = App\Involvement::get();
                          @endphp
                          @if(isset($involvement) && count($involvement)>0)
                          
                            @foreach($involvement as $involve_course)

                              @if($involve_course->user_id == Auth::user()->id && $cat->id == $involve_course->course_id)
                             
                                {{ __('adminstaticword.AlreadyRequest') }}
                              @else
                              
                                <a class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#involverequest{{$cat->id}}">
                              <i class="glyphicon glyphicon-link"></i></a>

                             
                              <div class="modal" id="involverequest{{$cat->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">

                                    
                                    <div class="modal-header">
                                      <h4 class="modal-title">Involve Request for Instructor </h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                   
                                    <div class="modal-body">
                                      <form action="{{route('involve.store',$cat->id)}}" method="post">
                                        @csrf
                                        <div class="row">
                                          <input type="hidden" name="course_id" value="{{$cat->id}}">
                                          <div class="col-sm-6" >
                                            <label for="instructor">{{ __('adminstaticword.Instructor') }}: <sup class="redstar">*</sup></label>
                                            @if(Auth::user()->role == 'admin')
                                            <select class="form-control js-example-basic-single select2" name="instructor_id">
                                              @foreach($instructors as $instructor)
                                                <option value="{{ $instructor->id }}">{{ $instructor->fname }}</option>
                                              @endforeach
                                            </select>
                                            @else
                                              <select class="form-control js-example-basic-single select2" name="instructor_id">
                                                
                                                  <option value="{{Auth::user()->id}}">{{ Auth::user()->fname }}</option>
                                               
                                              </select>
                                            @endif
                                          </div>
                                          <div class="col-sm-6">
                                            <label for="reason">{{ __('adminstaticword.Reason') }}: <sup class="redstar">*</sup></label>
                                           
                                            <textarea class="form-control" name="reason" id="" cols="30" rows="5" placeholder="Please enter reason for involvement request"></textarea>
                                          </div>
                                          
                                        </div>
                                        <div class="row" style="position: relative;margin: 10px;"><button type="submit" class="btn btn-primary btn-block">Submit</button></div>
                                        
                                      </form>
                                    </div>

                                  </div>
                                </div>
                              </div>
                              @endif
                            @endforeach
                          @else
                             
                        <a class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#involverequest{{$cat->id}}">
                          <i class="glyphicon glyphicon-link"></i></a>

                         
                          <div class="modal" id="involverequest{{$cat->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                
                                <div class="modal-header">
                                  <h4 class="modal-title">Involve Request for Instructor </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                               
                                <div class="modal-body">
                                  <form action="{{route('involve.store',$cat->id)}}" method="post">
                                    @csrf
                                    <div class="row">
                                      <input type="hidden" name="course_id" value="{{$cat->id}}">
                                      <div class="col-sm-6" >
                                        <label for="instructor">{{ __('adminstaticword.Instructor') }}: <sup class="redstar">*</sup></label>
                                        @if(Auth::user()->role == 'admin')
                                        <select class="form-control js-example-basic-single select2" name="instructor_id">
                                          @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->fname }}</option>
                                          @endforeach
                                        </select>
                                        @else
                                          <select class="form-control js-example-basic-single select2" name="instructor_id">
                                            
                                              <option value="{{Auth::user()->id}}">{{ Auth::user()->fname }}</option>
                                           
                                          </select>
                                        @endif
                                      </div>
                                      <div class="col-sm-6">
                                        <label for="reason">{{ __('adminstaticword.Reason') }}: <sup class="redstar">*</sup></label>
                                       
                                        <textarea class="form-control" name="reason" id="" cols="30" rows="5" placeholder="Please enter reason for involvement request"></textarea>
                                      </div>
                                      
                                    </div>
                                    <div class="row" style="position: relative;margin: 10px;"><button type="submit" class="btn btn-primary btn-block">Submit</button></div>
                                    
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        @endif
                        </td>
                       
                        
                       
                      </tr>
                    @endforeach
               
                  @endif
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