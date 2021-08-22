@extends('admin.layouts.master')
@section('title', 'Batch Update - Admin')
@section('body')




<section class="content">
  @include('admin.message')
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <div class="box box-primary">
      <!-- general form elements -->
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Batch') }}</h3>
        </div>
        <br>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form action="{{route('batch.update',$cor->id)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}  
              {{ method_field('PUT') }}
             
              
              <div class="row">
                
                <div class="col-md-12"> 
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{ $cor->title }}">
                </div>
              </div>
              <br>

              <div class="form-group">
                <label>{{ __('adminstaticword.SelectCourse') }}: <span class="redstar">*</span></label>
                <select class="form-control js-example-basic-single" name="allowed_courses[]" multiple="multiple" size="5" row="5" placeholder="{{ __('adminstaticword.Select') }} Courses">


                  @foreach ($courses as $cat)
                    @if($cat->status == 1)
                    <option value="{{ $cat->id }}" {{in_array($cat->id, $cor['allowed_courses'] ?: []) ? "selected": ""}}>{{ $cat->title }}
                    </option>
                    @endif

                  @endforeach

                </select>
              </div>
              <br>

              <div class="form-group">
                <label>{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Users') }}: <span class="redstar">*</span></label>
                <select class="form-control js-example-basic-single" name="allowed_users[]" multiple="multiple" size="5" row="5" placeholder="{{ __('adminstaticword.Select') }} {{ __('adminstaticword.Users') }}">


                  @foreach ($users as $user)
                    @if($user->status == 1)
                    <option value="{{ $user->id }}" {{in_array($user->id, $cor['allowed_users'] ?: []) ? "selected": ""}}>{{ $user->fname }}
                    </option>
                    @endif

                  @endforeach

                </select>
              </div>
              <br>

              

              <div class="row">
                
                <div class="col-md-12">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea id="detail" name="detail" rows="3" class="form-control">{!! $cor->detail !!}</textarea>
                </div>
              </div>
              <br>

              <div class="row">
               
                
                <div class="col-md-3">
                  @if(Auth::User()->role == "admin")
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb333" type="checkbox" {{ $cor->status==1 ? 'checked' : '' }}>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb333"></label>
                    </li>
                    <input type="hidden" name="status" value="{{ $cor->status }}" id="c33">
                  @endif
                </div>

                <div class="col-md-3">
                  <label>{{ __('adminstaticword.PreviewImage') }}:</label> 
                  <br> 
                  <input type="file" name="image" id="image" class="inputfile inputfile-1"  />
                  <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span>
                  </label>
                  <br>
                  @if($cor['preview_image'] !== NULL && $cor['preview_image'] !== '')
                      <img src="{{ url('/images/batch/'.$cor->preview_image) }}" height="70px;" width="70px;"/>
                  @else
                      <img src="{{ Avatar::create($cor->title)->toBase64() }}" alt="course" class="img-fluid">
                  @endif
                </div>
              </div>
              <br>
           
              <div class="row">
                
                
                
              </div>
              <br>
              <br>

              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>
         
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 

@endsection




@section('scripts')

<script>
(function($) {
  "use strict";


  $(function() {
    $('.js-example-basic-single').select2();
  });

  $(function() {
    $('#cb1').change(function() {
      $('#f').val(+ $(this).prop('checked'))
    })
  })

  $(function() {
    $('#cb3').change(function() {
      $('#test').val(+ $(this).prop('checked'))
    })
  })

  $(function(){

      $('#murl').change(function(){
        if($('#murl').val()=='yes')
        {
            $('#doab').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $(function(){

      $('#murll').change(function(){
        if($('#murll').val()=='yes')
        {
            $('#doabb').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $('#preview').on('change',function(){

    if($('#preview').is(':checked')){
      $('#document1').show('fast');
      $('#document2').hide('fast');    

    }else{
      $('#document2').show('fast');
      $('#document1').hide('fast');    
    }

  });

})(jQuery);

</script>
  
@endsection
