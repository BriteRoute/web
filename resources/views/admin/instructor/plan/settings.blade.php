@extends('admin.layouts.master')
@section('title', 'Instructor Subscription Settings - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">{{ __('Instructor Subscription Settings') }}</h3>
                </div>

                
                    
                <div class="panel-body">

                    
                    <div class="row">
                        <div class="col-xs-12">

                           
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                   <form action="{{ action('SubscriptionEnableController@settings') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}

                                       


                                        <div class="form-group">
                                            <label for="">{{ __('adminstaticword.InstructorSubscription') }}: </label>
                                            <li class="tg-list-item">              
                                                <input class="tgl tgl-skewed" id="plan_enable" type="checkbox" name="ENABLE_INSTRUCTOR_SUBS_SYSTEM" {{ env('ENABLE_INSTRUCTOR_SUBS_SYSTEM') == 1 ? 'checked' : '' }} >
                                                <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="plan_enable"></label>
                                            </li>
                                            <div>
                                                <small>(Enable Instructor subcription plans)</small>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                        <div class="{{ !old('purchase_code') ? "display-none" : "" }}  purbox">


                                             <div class="eyeCy">
                                              <label for="validationCustom02">Purchase Code:<sup class="redstar">*</sup></label>
                                              <input name="purchase_code" type="password" class="form-control" id="validationCustom02" placeholder="Please enter valid purchase code" value="{{ old('purchase_code') }}" autocomplete="off" required>
                                               <span toggle="#validationCustom02" class="eye fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <br>


                                            <small class="text-muted"><i class="fa fa-question-circle"></i> Enter envanto purchase code.</small>
                                          </div>
                                        </div>


                                        @if($errors->any())
                                            <h6 class="text-danger alert alert-error">{{$errors->first()}}</h6>
                                          @endif
                                        @error('code')
                                        <div class="invalid-feedback">
                                          {{$message}}
                                        </div> 
                                        @enderror  
                                        <br> 



                                        
                                        

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}!</button>
                                        </div>

                                      
                                    </form>


                                </div>
                            </div>
                        </div>
                        
                       
                    </div>

                    
                </div>

            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')


<script type="text/javascript">
  
  $("input[name='ENABLE_INSTRUCTOR_SUBS_SYSTEM']").on('change',function(){
      if( $("input[name='ENABLE_INSTRUCTOR_SUBS_SYSTEM']").is(':checked') ){
        $('.purbox').removeClass('display-none');
        $("input[name='purchase_code']").attr('required','required');
      }else{
        $('.purbox').addClass('display-none');
        $("input[name='purchase_code']").removeAttr('required');
      }
  });
</script>
@endsection




