@extends('admin/layouts.master')
@section('title', 'Quiz Report - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.QuizReport') }}  </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">


            <table id="topTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Email</th>          
                  <th>Quiz</th>
                  <th>Marks Get</th>
                  <th>Total Marks</th>
                </tr>
              </thead>
              <tbody>
                @if ($ans)
                  @foreach($filtStudents as $key => $student)
                    <tr>
                      <td>
                        {{$key+1}}
                      </td>
                      <td>{{$student->fname}}</td>
                      <td>{{$student->email}}</td>               
                      <td>{{$topics->title}}</td>
                      <td>
                        @php
                          $mark = 0;
                          $correct = collect();
                        @endphp
                        @foreach ($ans as $answer)
                          @if ($answer->user_id == $student->id && $answer->answer == $answer->user_answer)
                            @php
                             $mark++;
                            @endphp
                          @endif
                        @endforeach
                        @php
                          $correct = $mark*$topics->per_q_mark;
                        @endphp
                        {{$correct}}
                      </td>
                      <td>
                        {{$c_que*$topics->per_q_mark}}
                      </td>
                    </tr>
                  @endforeach

                @endif
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
