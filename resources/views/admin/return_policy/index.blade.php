@extends('admin/layouts.master')
@section('title', 'All Refund Policy - Admin')
@section('body')
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.RefundPolicy') }}</h3>
          <a href="{{url('refundpolicy/create')}}" class="btn btn-info btn-sm" >+ {{ __('adminstaticword.Add') }}</a> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
             
              <tr>
                <th>#</th>                  
                <th>{{ __('adminstaticword.Name') }}</th>
                <th>{{ __('adminstaticword.Days') }}</th>
                <th>{{ __('adminstaticword.Detail') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
              </thead>
              <tbody>
                @foreach($return as $key=>$policy)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $policy->name }}</td>
                <td>{{ $policy->days }}</td>
                <td>{!! str_limit($policy->detail, $limit = 40, $end = '...') !!}</td>
                <td>
                   
                    @if($policy->status ==1)
                    {{ __('adminstaticword.Active') }}
                    @else
                    {{ __('adminstaticword.Deactive') }}
                    @endif
                     
                </td>
                
                <td><a class="btn btn-success btn-sm" href="{{url('refundpolicy/'.$policy->id.'/edit')}}">
                  <i class="glyphicon glyphicon-pencil"></i></a>
                </td>

                <td><form  method="post" action="{{url('refundpolicy/'.$policy->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>

                @endforeach

              </tr>
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



