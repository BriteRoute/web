@extends('admin/layouts.master')
@section('title', 'Enroll a student - Admin')
@section('body')


    <section class="content">
        @include('admin.message')
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (isset($selectedUser))
                            <h3 class="box-title"> Enroll {{ $selectedUser->fname }} {{ $selectedUser->lname }}</h3>
                        @else
                            <h3 class="box-title"> Enroll a user</h3>
                        @endif

                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <form id="demo-form2" method="post" action="{{ route('order.store') }}" data-parsley-validate
                                class="form-horizontal form-label-left" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>User<span class="redstar">*</span></label>

                                        <input type="hidden" id="enrollUserViewRoute"
                                            value="{{ route('order.enrolluserview', '') }}">
                                        <select name="user_id" id="user_id" class="form-control js-example-basic-single"
                                            required>
                                            <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ isset($selectedUser) && $user->id === $selectedUser->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Courses </label>
                                        <select name="course_id" id="course_id"
                                            class="form-control js-example-basic-single">
                                            <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bundles</label>
                                        <select name="bundle_id" id="bundle_id"
                                            class="form-control js-example-basic-single">
                                            <option value="">{{ __('adminstaticword.SelectanOption') }}</option>
                                            @foreach ($bundles as $bundle)
                                                <option value="{{ $bundle->id }}">{{ $bundle->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="box-footer">
                                    <button type="submit" value="Add Slider" class="btn btn-md col-md-2 btn-primary">Enrol
                                        User</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
        @if (isset($enrolledCourses)  )
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Enrolled courses</h3>
                        </div>
                        <div class="box-body">

                            @foreach ($enrolledCourses as $enrolledCourse)

                                <div class="row">
                                    <div class="col-md-6">

                                        {{ $enrolledCourse['title'] }}
                                    </div>

                                </div>
                                <br>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        @endif

        @if (isset($enrolledBundles)  )
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Enrolled bundles</h3>
                        </div>
                        <div class="box-body">

                            @foreach ($enrolledBundles as $enrolledBundle)

                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $enrolledBundle->title }}
                                    </div>

                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection


@section('scripts')

    <script>
        $(function() {
            $('#user_id').on('change', function(e) {
                var userId = this.value;
                var link = $('#enrollUserViewRoute').val() + '/' + userId;

                top.location.href = link;
            });
        })

    </script>
@endsection
