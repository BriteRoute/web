@extends('admin/layouts.master')
@section('title', 'Involve Request - Instructor')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.InvolvementRequest') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              
              <thead>
              
                <tr>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Course') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Accept') }}</th>
                  <th>{{ __('adminstaticword.Reject') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($involve_requests as $item)
                @if(Auth::user()->id == $item->course->user->id)
                <tr>
                  
                    <td>
                      @if($item->user->user_img != null || $item->user->user_img !='')
                        <img src="{{ asset('images/user_img/'.$item->user->user_img)}}">
                      @else
                        <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                      @endif
                    </td> 
                    <td>{{$item->user->fname}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>{{ $item->course->title}}</td>
                    <td>
                      @if($item->status==1)
                        {{ __('adminstaticword.Approved') }}
                      @else
                        {{ __('adminstaticword.Pending') }}
                      @endif
                    </td>
                    
                    <td>
                      @if($item->status == 0)
                        <form  method="post" action="{{route('involve.request.edit',$item->id)}}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                          
                             <button type="submit" class="btn btn-info">{{ __('adminstaticword.Accept') }}</i></button>
                        </form>
                      @else
                         <b class="text-green">{{__('adminstaticword.AcceptedByInstructor')}} {{$item->course->user->fname}}</b>
                      @endif
                    </td>
                   
                    <td><form  method="post" action="{{route('involve.request.destroy',$item->id)}}
                          "data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                           <button type="submit" class="btn btn-danger">{{ __('adminstaticword.Reject') }}</i></button>
                        </form>
                    </td>

                  
                   </tr>
                      @endif
                  @endforeach

               
               
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection