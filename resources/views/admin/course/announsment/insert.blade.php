@extends('admin/layouts.master')
@section('title', 'Add Announcement - Admin')
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
  @include('admin.message')
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12"> 
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.Pages') }}</h3>
        </div>
        <br>
        <div class="box-body">
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{ route('announsment.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                          
               
                <label class="display-none" for="exampleInputSlug"> {{ __('adminstaticword.Course') }}<span class="required" >*</span></label>
                <select name="course_id" class="form-control display-none">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>
            
                <label class="display-none"  for="exampleInputTit1e">{{ __('adminstaticword.User') }}</label>

                <select class="display-none" name="user_id" class="form-control col-md-7 col-xs-12">
                  @php
                   $users = App\User::all();
                  @endphp

                  @foreach($users as $us)
                  <option value="{{$us->id}}">{{$us->fname}}</option>
                  @endforeach
                </select>
                
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Announcement') }}:<sup class="redstar">*</sup></label>

                    <textarea name="announsment" id="editor6" rows="2" class="form-control" placeholder="Enter Your Announcement"></textarea>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="uuuu"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="uuuu"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="uuuuu">
                  </div>
                </div>
                <br>
          
                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
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
</section> 
@endsection


@section('scripts')



  <script>
tinymce.init({
  selector: '#editor1,#editor2,.editor',
  height: 350,
  menubar: 'edit view insert format tools table tc',
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table paste wordcount'
  ],
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script>
@endsection