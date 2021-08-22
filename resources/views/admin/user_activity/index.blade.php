@extends('admin.layouts.master')
@section('title', 'Users Activity Logs - Admin')
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
          <h3 class="box-title">{{ __('adminstaticword.Users') }} {{ __('adminstaticword.ActivityLog') }}</h3>
          
        </div>
       
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.User') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Description') }}</th>
                  <th>{{ __('adminstaticword.Time') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </thead> 

                <tbody>
                  <?php $i=0;?>

                    @foreach ($lastActivity as $user)

                      @php
                        $users = App\User::where('id', $user->causer_id)->first();
                      @endphp
                     
                      <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                       
                        <td>@if(isset($users)) {{ $users->fname }} @endif</td>
                        <td>@if(isset($users)) {{ $users->email }} @endif</td>
                        <td>{{ $user->description }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>
                          <form  method="post" action="{{ route('activity.delete',$user->id) }}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            
                             
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
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection


