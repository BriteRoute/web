@extends('admin.layouts.master')
@section('title','Push Notification Manager | ')
@section('body')
    <section class="content">
       <div class="row">
           <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        {{__("Push Notification Manager")}} 
                    </div>
                </div>
        
                <div class="box-body">
                    <form action="{{ route('admin.push.notif') }}" method="POST">
                        @csrf
        
                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.SelectUserGroup') }}: <span class="text-danger">*</span> </label>
        
                            <select required data-placeholder="Please select user group" name="user_group" id="" class="select2 form-control">
                                <option value="">{{ __('adminstaticword.SelectUserGroup') }}</option>
                                <option {{ old('user_group') == 'all_users' ? "selected" : "" }} value="all_customers">{{ __('adminstaticword.All') }} {{ __('adminstaticword.Users') }} </option>
                                <option {{ old('user_group') == 'all_instructors' ? "selected" : "" }} value="all_sellers">{{ __('adminstaticword.All') }} {{ __('adminstaticword.Instructors') }} </option>
                                <option {{ old('user_group') == 'all_admins' ? "selected" : "" }} value="all_admins">{{ __('adminstaticword.All') }} {{ __('adminstaticword.Admin') }} </option>
                                <option {{ old('user_group') == 'all' ? "selected" : "" }} value="all">{{ __('adminstaticword.All') }}   ({{ __('adminstaticword.Users') }} + {{ __('adminstaticword.Instructors') }} + {{ __('adminstaticword.Admin') }})</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.Subject') }}: <span class="text-red">*</span></label>
                            <input placeholder="" type="text" class="form-control" required name="subject" value="{{ old('subject') }}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.NotificationBody') }} : <span class="text-red">*</span> </label>
                            <textarea required placeholder="" class="form-control" name="message" id="" cols="3" rows="5">{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.TargetURL') }} : </label>
                            <input value="{{ old('target_url') }}" class="form-control" name="target_url" type="url" placeholder="{{ url('/') }}">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> On click of notification where you want to redirect the user.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.NotificationIcon') }} : </label>
                            <input value="{{ old('icon') }}" name="icon" class="form-control" type="url" placeholder="https://someurl/icon.png">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> If not enter than default icon will use which you upload at time of create one signal app.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('adminstaticword.Image') }}: </label>
                            <input value="{{ old('image') }}" class="form-control" name="image" type="url" placeholder="https://someurl/image.png">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> <b>{{ __('adminstaticword.RecommnadedSize') }}: 450x228 px.</b>
                            </small>
                        </div>

                        <div class="from-group">
                            <label for="">{{ __('adminstaticword.ShowButton') }}: </label>
                            <br>
                            <label class="switch">
                                <input {{ old('show_button') ? "checked" : "" }} class="show_button" type="checkbox" name="show_button">
                                <span class="knob"></span>
                            </label>
                        </div>

                        <div style="display: {{ old('show_button') ? 'block' : 'none' }};" id="buttonBox">
                            <div class="form-group">
                                <label for="">{{ __('adminstaticword.ButtonText') }}:  <span class="text-danger">*</span></label>
                                <input value="{{ old('btn_text') }}" class="form-control" name="btn_text" type="text" placeholder="Grab Now !">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __('adminstaticword.ButtonTargetURL') }} : </label>
                                <input value="{{ old('btn_url') }}" class="form-control" name="btn_url" type="url" placeholder="https://someurl/image.png">
                                <small class="text-muted">
                                    <i class="fa fa-question-circle"></i> On click of button where you want to redirect the user.
                                </small>
                            </div>
                        </div>

                        <div class="from-group">
                            <button type="submit" class="btn btn-block btn-md btn-primary">
                                <i class="fa fa-location-arrow"></i> {{ __('adminstaticword.Send') }}
                            </button>
                        </div>
        
                    </form>
                </div>
            </div>
           </div>

           <div class="col-md-4">
               <div class="box">
                   <div class="box-header">
                       <div class="box-title">
                            {{ __('adminstaticword.OnesignalKeys') }}
                       </div>

                       <a title="Get one signal keys" href="https://onesignal.com/" class="pull-right" target="__blank">
                           <i class="fa fa-key"></i> {{ __('adminstaticword.Getyourkeysfromhere') }}
                       </a>
                   </div>

                   <div class="box-body">
                       
                    <form action="{{ route('onesignal.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="eyeCy">

                                <label for="ONESIGNAL_APP_ID">{{ __('adminstaticword.ONESIGNALAPPID') }}: <span class="text-danger">*</span></label>
                                <input type="password" value="{{ env('ONESIGNAL_APP_ID') }}"
                                    name="ONESIGNAL_APP_ID" placeholder="Enter ONESIGNAL APP ID " id="ONESIGNAL_APP_ID" type="password"
                                    class="form-control">
                                <span toggle="#ONESIGNAL_APP_ID"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="eyeCy">

                                <label for="ONESIGNAL_REST_API_KEY"> {{ __('adminstaticword.ONESIGNALRESTAPIKEY') }}: <span class="text-danger">*</span></label>
                                <input type="password" value="{{ env('ONESIGNAL_REST_API_KEY') }}"
                                    name="ONESIGNAL_REST_API_KEY" placeholder="Enter ONESIGNAL REST API KEY " id="ONESIGNAL_REST_API_KEY" type="password"
                                    class="form-control">
                                <span toggle="#ONESIGNAL_REST_API_KEY"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">
                               <i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}
                            </button>
                        </div>
                    </form>

                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection
@section('scripts')
    <script>
        $('.show_button').on('change',function(){

            if($(this).is(":checked")){
                $('input[name=btn_text]').attr('required','required');
                $('#buttonBox').show('fast');
            }else{
                $('input[name=btn_text]').removeAttr('required');
                $('#buttonBox').hide('fast');
            }

        });
    </script>


@endsection