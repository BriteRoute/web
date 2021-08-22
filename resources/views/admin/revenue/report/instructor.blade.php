@extends('admin/layouts.master')
@section('title', 'Instructor Revenue - Admin')
@section('body')

<section class="content">

  @include('admin.message')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('adminstaticword.InstructorRevenue') }}</h3>
       
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>#</th>
                 <th>{{ __('adminstaticword.Enrolled') }}{{ __('adminstaticword.Courses') }}</th>
                  
                  <th>{{ __('adminstaticword.Instructor') }}</th>
                  <th>{{ __('adminstaticword.TotalAmount') }}</th>
                  <th>{{ __('adminstaticword.InstructorRevenue') }}</th>
                  <th>{{ __('adminstaticword.Enrolled') }} {{ __('adminstaticword.Date') }}</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=0;?>
                 
                    @foreach($revenue as $rev)
                      <?php $i++;?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td>{{ $rev->courses->title }}</td>

                        <td>{{ $rev->courses->user->fname }}</td>

                      
                        <td>

                        @if($gsetting['currency_swipe'] == 1)
                            <i class="fa {{ $rev['currency_icon'] }}"></i> {{ $rev->total_amount }} 

                        @else
                            {{ $rev->total_amount }} <i class="fa {{ $rev['currency_icon'] }}"></i>

                        @endif

                        </td>


                        <td>
                        @if($gsetting['currency_swipe'] == 1)
                            <i class="fa {{ $rev['currency_icon'] }}"></i> {{ $rev->instructor_revenue }}

                        @else
                            {{ $rev->instructor_revenue }} <i class="fa {{ $rev['currency_icon'] }}"></i>

                        @endif

                        </td>

                        <td>{{  date('d-m-Y', strtotime($rev->created_at)) }}</td>

                      
                       
                    
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
