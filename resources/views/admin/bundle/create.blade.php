@extends('admin/layouts.master')
@section('title', 'Create Course - Admin')
@section('body')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-10">
              <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.BundleCourse') }}</h3>
            </div>
            <div  class="col-md-2">
                <div><h4 class="admin-form-text"><a href="{{url('course')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons"><button class="btn btn-xs btn-success abc"> << {{ __('adminstaticword.Back') }}</button> </i></a></h4></div>
            </div>
          </div>
        </div>

        <div class="box-body">
          <div class="form-group">
            <form action="{{url('bundle/')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}

                <input type="hidden" class="form-control" name="user_id" id="exampleInputTitle" value="{{ Auth::User()->id }}" required>

                <div class="form-group">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}: <sup class="redstar">*</sup></label>
                  <input type="title" class="form-control" name="title" id="exampleInputTitle" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Title') }}" value="" required>

                </div>

                <div class="form-group">
                  <label>{{ __('adminstaticword.SelectCourse') }}: <span class="redstar">*</span></label>
                  <select class="form-control js-example-basic-single" name="course_id[]" multiple="multiple" size="5" row="5" placeholder="{{ __('adminstaticword.SelectCourse') }}">


                    @foreach ($courses as $cat)
                      @if($cat->status == 1)
                      <option value="{{ $cat->id }}">{{ $cat->title }}
                      </option>
                      @endif

                    @endforeach

                  </select>
                </div>



                <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.ShortDetail') }}: <sup class="redstar">*</sup></label>
                  <textarea id="short_detail" name="short_detail" rows="4"  class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ShortDetail') }}"></textarea>
                </div>
              </div>
              <br>



              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Detail') }}: <sup class="redstar">*</sup></label>
                  <textarea id="createBundleEditor" name="detail" rows="5"  class="form-control" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Detail') }}"></textarea>
                </div>
              </div>
              <br>

              <div class="row">

                <div class="col-md-3">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Free') }}:</label>
                  <li class="tg-list-item">
                    <input name="type" class="tgl tgl-skewed" id="cb111" type="checkbox"/>
                    <label class="tgl-btn" data-tg-off="Free" data-tg-on="Paid" for="cb111"></label>
                  </li>
                  <br>
                  <div class="display-none" id="pricebox">
                    <label for="exampleInputSlug">{{ __('adminstaticword.Price') }}: <sup class="redstar">*</sup></label>
                    <input type="text" class="form-control" name="price" id="priceMain" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Price') }}" value="">

                    <label for="exampleInputSlug">{{ __('adminstaticword.DiscountPrice') }}: </label>
                    <input type="text" class="form-control" name="discount_price" id="offerPrice" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.DiscountPrice') }}" value="">
                  </div>
                </div>
                <div class="col-md-3">
                  @if(Auth::User()->role == "admin")
                  <label for="exampleInputDetails">{{ __('adminstaticword.Featured') }}:</label>
                  <li class="tg-list-item">

                    <input class="tgl tgl-skewed" id="cb1"   type="checkbox"/>
                    <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb1"></label>
                  </li>
                  <input type="hidden" name="featured" value="0" id="j">
                  @endif
                </div>
                <div class="col-md-3">
                  @if(Auth::User()->role == "admin")
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="cb3" type="checkbox"/>
                    <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb3"></label>
                  </li>
                  <input type="hidden" name="status" value="0" id="test">
                  @endif
                </div>
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.PreviewImage') }}:</label> - <p class="inline info">size: 250x150</p>
                  <input type="file" name="preview_image" id="image" class="inputfile inputfile-1"  />
                  <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span></label>


                </div>
              </div>
              <br>
            <!--Stripe Subscription Row-->
              <div class="row">
                <div class="col-md-3">
                    <label for="cbToggleSubscription">{{ __('adminstaticword.Subscription') }}:</label>
                    <li class="tg-list-item">
                        <input class="tgl tgl-skewed" id="cbToggleSubscription" type="checkbox">
                        <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cbToggleSubscription"></label>

                         <small class="text-muted"><i class="fa fa-question-circle"></i> Subscription bundle works with stripe payment only.</small><br>
                         <small class="text-muted"> Enable it only when you have setup stripe.</small>
                    </li>

                    <br>
                    <div id="stripeSubscriptionContainer" class="display-none">
                        <input name="is_subscription_enabled" type="hidden" value="0" id="is_subscription_enabled" />
                        <div class="form-group">
                            <label>{{ __('adminstaticword.BillingPeriod') }}</label>
                            <select class="form-control" name="billing_interval">
                              <option value="day">Daily</option>
                              <option value="week">Weekly</option>
                              <option value="month" selected>Monthly</option>
                              <option value="year">Yearly</option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class="col-md-3">

                <label for="">{{ __('adminstaticword.Duration') }}: </label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="duration_type" type="checkbox" name="duration_type" >
                  <label class="tgl-btn" data-tg-off="days" data-tg-on="month" for="duration_type"></label>
                </li>

                <label for="exampleInputSlug">{{ __('adminstaticword.BundleExpireDuration') }} </label>
                <input min="1" class="form-control" name="duration" type="number" id="duration"  placeholder="Enter Duration" value="{{ (old('duration')) }}">


              </div>


            </div>
            <br>
            <!--Stripe Subscription-->


              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Submit') }}</button>
              </div>

            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')


<script>
(function($) {
"use strict";

   $(function () {
      CKEDITOR.replace('createBundleEditor');
    });

  $(function() {
    $('.js-example-basic-single').select2();
  });

  $(function() {
    $('#cb1').change(function() {
      $('#j').val(+ $(this).prop('checked'))
    })
  })

  $(function() {
    $('#cb3').change(function() {
      $('#test').val(+ $(this).prop('checked'))
    })
  })

  $('#cb111').on('change',function(){

    if($('#cb111').is(':checked')){
      $('#pricebox').show('fast');

      $('#priceMain').prop('required','required');

    }else{
      $('#pricebox').hide('fast');

      $('#priceMain').removeAttr('required');
    }

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

  $("#cb3").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', '1');
    }
    else {
      $(this).attr('value', '0');
    }});

  $(function(){

      $('#ms').change(function(){
        if($('#ms').val()=='yes')
        {
            $('#doabox').show();
        }
        else
        {
            $('#doabox').hide();
        }
      });

  });

  $(function(){

      $('#ms').change(function(){
        if($('#ms').val()=='yes')
        {
            $('#doaboxx').show();
        }
        else
        {
            $('#doaboxx').hide();
        }
      });

  });

  $(function(){

      $('#msd').change(function(){
        if($('#msd').val()=='yes')
        {
            $('#doa').show();
        }
        else
        {
            $('#doa').hide();
        }
      });

  });

  $(function() {
    var urlLike = '{{ url('admin/dropdown') }}';
    $('#category_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

  $(function() {
    var urlLike = '{{ url('admin/gcat') }}';
    $('#upload_id').change(function() {
      var up = $('#grand').empty();
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });
})(jQuery);
</script>

@endsection
