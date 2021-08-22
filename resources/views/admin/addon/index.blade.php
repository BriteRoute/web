@extends('admin/layouts.master')
@section('title', 'Addon Manager - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> {{ __('adminstaticword.Addon') }} {{ __('adminstaticword.Manager') }} </h3>
              <a class="btn btn-info btn-sm" href="{{url('admin/add/addon')}}">
                    <i class="glyphicon glyphicon-th-l">+</i> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Addon') }}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  
                 
                  <tr>
                    <th>#</th>
                    <th>{{ __('adminstaticword.Addon') }}</th>
                    <th>{{ __('adminstaticword.Version') }}</th>
                    <th>{{ __('adminstaticword.Status') }}</th>
                    <th>{{ __('adminstaticword.Delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=0;?>

              @foreach($modules as $module)
                <?php $i++;?>
                @php
                  $path = base_path().'/Modules/'.$module.'/'.'module.json'; 

                  $json = json_decode(file_get_contents($path), true);



                @endphp
                <tr>
                  <td><?php echo $i;?></td>
                
                  <td>{{$json['name']}}</td>

                  <td>
                    @if(isset($json['version']))
                    {{$json['version']}}
                    @else
                    -
                    @endif
                  </td>

                  <td>
                   <form action="{{ route('status.addon',$module) }}" method="POST">
                      {{ csrf_field() }}
                      <button  type="Submit" class="btn btn-xs {{ $module->isStatus(1) ? 'btn-success' : 'btn-danger' }}">
                        @if( $module->isStatus(1))
                        {{ __('adminstaticword.Active') }}
                        @else
                        {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>

                  </td>

                    <td>
                  

                  <form  method="post" action="{{url('admin/addon/delete/'.$module)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                     
                       <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>

                  </td>
                  
                </tr>
                @endforeach
                
                </tfoot>
              </table>
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