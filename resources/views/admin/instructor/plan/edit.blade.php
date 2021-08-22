@extends('admin.layouts.master')
@section('title', 'Instructor Plan Edit - Admin')
@section('body')


    <section class="content">
        @include('admin.message')
        <div class="row">
            <!-- left column -->
            <div class="col-xs-12">
                <div class="box box-primary">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Course') }}</h3>
                    </div>
                    <br>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <form action="{{ url('subscription/plan', $plans->id) }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}


                                <div class="row">

                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup
                                                class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="title" id="exampleInputTitle"
                                            value="{{ $plans->title }}">
                                    </div>
                                </div>
                                <br>

                                




                                <div class="row">

                                    <div class="col-md-12">
                                        <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                                        <textarea id="editBundleEditor" name="detail" rows="3" class="form-control"
                                            required>{!!  $plans->detail !!}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-3">
                                        <label for="exampleInputDetails">{{ __('adminstaticword.Free') }}:</label>
                                        <li class="tg-list-item">
                                            <input class="tgl tgl-skewed" id="cb111" name="type" type="checkbox"
                                                {{ $plans->type == '1' ? 'checked' : '' }} />
                                            <label class="tgl-btn" data-tg-off="Free" data-tg-on="Paid" for="cb111"></label>
                                        </li>
                                        <input type="hidden" name="free" value="0" id="j111">
                                        <br>

                                        <div @if ($plans->price == '' && $plans->price == '')
                                            class="display-none" @endif id="doabox">
                                            <label for="exampleInputSlug">{{ __('adminstaticword.Price') }}: <sup
                                                    class="redstar">*</sup></label>
                                            <input type="number" min="1" class="form-control" name="price"
                                                id="exampleInputPassword1" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Price') }}"
                                                value="{{ $plans->price }}">
                                        </div>

                                        <div @if ($plans->price == '' && $plans->discount_price == '')
                                            class="display-none" @endif id="doaboxx">
                                            <br>
                                            <label for="exampleInputSlug">{{ __('adminstaticword.DiscountPrice') }}: <sup
                                                    class="redstar">*</sup></label>
                                            <input type="number" min="1" class="form-control" name="discount_price"
                                                id="exampleInputPassword1" placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.DiscountPrice') }}"
                                                value="{{ $plans->discount_price }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        @if (Auth::User()->role == 'admin')
                                            <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                                            <li class="tg-list-item">
                                                <input class="tgl tgl-skewed" id="cb333" type="checkbox"
                                                    {{ $plans->status == 1 ? 'checked' : '' }}>
                                                <label class="tgl-btn" data-tg-off="{{ __('adminstaticword.Deactive') }}" data-tg-on="{{ __('adminstaticword.Active') }}"
                                                    for="cb333"></label>
                                            </li>
                                            <input type="hidden" name="status" value="{{ $plans->status }}" id="c33">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label>{{ __('adminstaticword.PreviewImage') }}:</label>
                                        <br>
                                        <input type="file" name="preview_image" id="image" class="inputfile inputfile-1" />
                                        <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7"
                                                viewBox="0 0 20 17">
                                                <path
                                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span>
                                        </label>
                                        <br>
                                        @if ($plans['preview_image'] !== null && $plans['preview_image'] !== '')
                                            <img src="{{ url('/images/plan/' . $plans->preview_image) }}" height="70px;"
                                                width="70px;" />
                                        @else
                                            <img src="{{ Avatar::create($plans->title)->toBase64() }}" alt="course"
                                                class="img-fluid">
                                        @endif
                                    </div>
                               
                                    <div class="col-md-3">
                                      <label for="">{{ __('adminstaticword.Duration') }}: </label>
                                      <li class="tg-list-item">              
                                        <input class="tgl tgl-skewed" id="duration_type" type="checkbox" name="duration_type" {{ $plans->duration_type == "m" ? 'checked' : '' }} >
                                        <label class="tgl-btn" data-tg-off="days" data-tg-on="month" for="duration_type"></label>
                                      </li>

                                      <br>
                                      <label for="exampleInputSlug">Plan Expire Duration</label>
                                      <input min="1" class="form-control" name="duration" type="number" id="duration" value="{{ $plans->duration }}" placeholder="Enter Duration in months">
                                    </div>
                                </div>

                                <br>

                                <!--Stripe Subscription-->
                                <div class="row">
                                  
                                    <div class="col-md-6">
                                      <label for="exampleInputSlug">No. Courses Allowed to create in plan:</label>
                                      <input min="1" class="form-control" name="courses_allowed" type="number" id="courses_allowed"  placeholder="" value="{{ $plans->courses_allowed }}">
                                    
                                    </div>
                                    
                                </div><br>
                                <!--Stripe Subscription-->
                                <div class="box-footer">
                                    <button type="submit"
                                        class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
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
                CKEDITOR.replace('editBundleEditor');
            });

            $(function() {
                $('.js-example-basic-single').select2();
            });

            $(function() {
                $('#cb1').change(function() {
                    $('#f').val(+$(this).prop('checked'))
                })
            })

            $(function() {
                $('#cb3').change(function() {
                    $('#test').val(+$(this).prop('checked'))
                })
            })

            $(function() {

                $('#murl').change(function() {
                    if ($('#murl').val() == 'yes') {
                        $('#doab').show();
                    } else {
                        $('#doab').hide();
                    }
                });

            });

            $(function() {

                $('#murll').change(function() {
                    if ($('#murll').val() == 'yes') {
                        $('#doabb').show();
                    } else {
                        $('#doab').hide();
                    }
                });

            });

            $('#preview').on('change', function() {

                if ($('#preview').is(':checked')) {
                    $('#document1').show('fast');
                    $('#document2').hide('fast');

                } else {
                    $('#document2').show('fast');
                    $('#document1').hide('fast');
                }

            });

        })(jQuery);

    </script>

@endsection
