@extends('admin/layouts.master')
@section('title', 'All Blog - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Blog') }}</h3>
          <a class="btn btn-info btn-sm" href="{{url('blog/create')}}">
              <i class="glyphicon glyphicon-th-l">+{{ __('adminstaticword.Add') }}</i></a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            
            <thead>
            
              <tr>
                <th>#</th>
                <th>{{ __('adminstaticword.Image') }}</th>
                <th>{{ __('adminstaticword.User') }}</th>
                <th>{{ __('adminstaticword.Heading') }}</th>
                <th>{{ __('adminstaticword.Detail') }}</th>
                <th>{{ __('adminstaticword.Text') }}</th>
                @if(Auth::user()->role == 'admin')
                <th>{{ __('adminstaticword.Approved') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                @endif
                <th>{{ __('adminstaticword.Edit') }}</th>
                <th>{{ __('adminstaticword.Delete') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($items as $item)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
                <td>
                  <img src="images/blog/{{$item->image}}" class="img-responsive" >
                </td>
                
                <td>{{$item->user->fname}}</td>
                <td>{{$item->heading}}</td>
                <td>{{substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($item->detail))), 0, 400)}}</td>
                <td>{{$item->text}}</td>

                @if(Auth::user()->role == 'admin')
                <td>
                  <form action="{{ route('blog.approved.quick',$item->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $item->approved ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($item->approved ==1)
                      {{ __('adminstaticword.Approved') }}
                      @else
                      {{ __('adminstaticword.Pending') }}
                      @endif
                    </button>
                  </form>
                <td>
                  <form action="{{ route('blog.status.quick',$item->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="Submit" class="btn btn-xs {{ $item->status ==1 ? 'btn-success' : 'btn-danger' }}">
                      @if($item->status ==1)
                      {{ __('adminstaticword.Active') }}
                      @else
                      {{ __('adminstaticword.Deactive') }}
                      @endif
                    </button>
                  </form>
                </td>

                @endif
                
                </td>
                <td><a class="btn btn-primary btn-sm" href="{{route('blog.edit',$item->id)}}">
                  <i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <form  method="post" action="{{url('blog/'.$item->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                       <button  type="submit" class="btn btn-danger "><i class="fa fa-fw fa-trash-o"></i></button>
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