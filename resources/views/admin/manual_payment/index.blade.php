@extends('admin/layouts.master')
@section('title', 'Manual Payment Gateway - Admin')
@section('body')

@if($errors->any())
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
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.ManualPaymentGateway') }}</h3>
          <a class="btn btn-info btn-sm" href="{{url('manualpayment/create')}}">
              <i class="glyphicon glyphicon">+</i> {{ __('adminstaticword.Add') }}</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('Payment Gateway Name') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($payments as $payment)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
               
                <td>{{$payment->name}}</td>
                <td>
                  
                    @if($payment->status ==1)
                    {{ __('adminstaticword.Active') }}
                    @else
                    {{ __('adminstaticword.Deactive') }}
                    @endif
                      
                </td>
                
              
                <th><a class="btn btn-primary btn-sm" href="{{url('manualpayment/'.$payment->id)}}">
                  <i class="glyphicon glyphicon-pencil"></i></a></th>

                <td>
                  <form  method="post" action="{{url('manualpayment/'.$payment->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                       <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>

                @endforeach
             
              </tr>
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


