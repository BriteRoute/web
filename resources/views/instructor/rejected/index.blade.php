@extends('admin/layouts.master')
@section('title', 'Course Review - Admin')
@section('body')

<section class="content">

  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Course') }} {{ __('adminstaticword.Review') }}</h3>
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
                    <th>{{ __('adminstaticword.Instructor') }}</th>
                    <th>{{ __('adminstaticword.Slug') }}</th>
                    <th>{{ __('adminstaticword.View') }}</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $i=0;?>

                    @foreach($course as $cat)
                    @if($cat->status == 0)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($cat['preview_image'] !== NULL && $cat['preview_image'] !== '')
                            <img src="{{ asset('images/course/'.$cat['preview_image']) }}" class="img-responsive" >
                          @else
                            <img src="{{ Avatar::create($cat->title)->toBase64() }}" class="img-responsive" >
                          @endif
                        </td>
                        <td>{{$cat->title}}</td>
                        <td>{{ $cat->user->fname }}</td>
                        <td>{{$cat->slug}}</td>
                       

                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ url('rejected/view/'.$cat->id) }}">
                          view</a>
                        </td>

                       
                      </tr>
                    @endif
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
