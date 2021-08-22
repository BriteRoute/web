
@extends('admin/layouts.master')
@section('title', 'View Slider - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Assignment') }}</h3>
        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.User') }}</th>
              <th>{{ __('adminstaticword.Course') }}</th>
              <th>{{ __('adminstaticword.CourseChapter') }}</th>
              <th>{{ __('adminstaticword.Assignment') }}</th>
              <th>{{ __('adminstaticword.View') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($assignment as $assign)
              <tr>
                <?php $i++;?>
                <td><?php echo $i;?></td>
                <td>@if(isset($assign->user)) {{$assign->user->fname}} @endif</td>
                <td>@if(isset($assign->courses)) {{$assign->courses->title}} @endif</td>
                <td>>@if(isset($assign->chapter)) {{$assign->chapter->chapter_name}} @endif</td>
                <td>{{ $assign->title }}</td>
            
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('assignment/'.$assign->id)}}">{{ __('adminstaticword.View') }}</a>
                </td> 

                <td>
                  <form  method="post" action="{{url('assignment/'.$assign->id)}}" ata-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
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
  <!-- /.row -->
</section>

@endsection

@section('scripts')
  <script type="text/javascript">
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );

   $("#sortable").sortable({
   update: function (e, u) {
    var data = $(this).sortable('serialize');
   
    $.ajax({
        url: "{{ route('slider_reposition') }}",
        type: 'get',
        data: data,
        dataType: 'json',
        success: function (result) {
          console.log(data);
        }
    });

  }

});
  </script>

@endsection

