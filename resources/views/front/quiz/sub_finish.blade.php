@extends('theme.master')
@section('title',"Show Report")
@section('content')
 <section class="main-wrapper finish-main-block">
   <div class="container">
    <br/>
  @if ($auth)
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="">
          <div class="question-block">
           

          


          <div id="printableArea">

           <h3 class="text-center main-block-heading">{{ __('frontstaticword.scorecard') }} </h3>
            <br/>

            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>{{ __('frontstaticword.TotalQuestion') }}</th>
                  <th>{{ __('frontstaticword.CorrectQuestions') }}</th>
                  <th>{{ __('frontstaticword.PerQuestionMark') }}</th>
                  <th>{{ __('frontstaticword.TotalMarks') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$count_questions}}</td>
                  <td>
                    @php
                      $mark = 0;
                      $ca=0;
                      $correct = collect();
                    @endphp
                    @foreach ($ans as $answer)
                      
                      
                        @php
                          $mark++;
                          $ca++;
                        @endphp
                     
                    @endforeach
                    @if ($answer->txt_approved == '1')
                    {{$ca}}
                    @else
                    Pending
                    @endif
                  </td>
                  <td>{{$topics->per_q_mark}}</td>
                    @php
                        $correct = $mark*$topics->per_q_mark;
                    @endphp
                  <td>
                     @if ($answer->txt_approved == '1')
                      {{$correct}}
                      @else
                      Pending
                      @endif
                    </td>
                </tr>
              </tbody>
            </table>
           
            <br/>
            <h2 class="text-center">{{ __('frontstaticword.ThankYou') }}</h2>
          </div>

          

            <div class="finish-btn text-center">
              
              <input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="Print" />

              @if($topics->quiz_again == '1')
              <a href="{{route('sub.tryagain',$topics->id)}}" class="btn btn-primary">{{ __('frontstaticword.TryAgain') }} </a>
              @endif
              <a href="{{ route('course.content',['id' => $topics->course_id, 'slug' => $topics->courses->slug ]) }}" class="btn btn-secondary">{{ __('frontstaticword.Back') }} </a>

              


            </div>

          </div>
        </div>
      </div>
    </div>
  @endif
</div>
</section>
<br/>
@endsection


@section('custom-script')

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
   }
</script>
@endsection

