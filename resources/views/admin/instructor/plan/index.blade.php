@extends('admin/layouts.master')
@section('title', 'Instructor Plan - Admin')
@section('body')

<section class="content">

  @include('admin.message')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('adminstaticword.InstructorPlan') }}</h3>
        <a class="btn btn-info btn-sm" href="{{url('subscription/plan/create')}}">
          <i class="glyphicon glyphicon">+</i> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.InstructorPlan') }}
        </a>
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
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                 
                    @foreach($plans as $plan)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($plan['preview_image'] !== NULL && $plan['preview_image'] !== '')
                              <img src="{{ asset('images/plan/'.$plan['preview_image']) }}" class="img-responsive" >
                          @else
                              <img src="{{ Avatar::create($plan->title)->toBase64() }}" class="img-responsive" >
                          @endif
                        </td>
                        <td>{{$plan->title}}</td>
                        

                        

                        <td>

                              @if($plan->status ==1)
                                {{ __('adminstaticword.Active') }}
                              @else
                                {{ __('adminstaticword.Deactive') }}
                              @endif

                        </td>

                        <td>
                          <a class="btn btn-success btn-sm" href="{{url('subscription/plan/'.$plan->id. '/edit')}}">
                          <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>

                        <td>
                          <form  method="post" action="{{url('subscription/plan/'.$plan->id)}}
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
