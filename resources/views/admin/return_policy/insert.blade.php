@extends('admin/layouts.master')
@section('title', 'Add Refund Policy - Admin')
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
          <h3 class="box-title"> {{ __('adminstaticword.Add') }} {{ __('adminstaticword.RefundPolicy') }}</h3>
        </div>
        <br>
        <div class="box-body">
          <div class="form-group">

            <div class="row">
   
            <div class="col-md-offset-2 col-md-8"> 
              <form id="demo-form2" method="post" action="{{url('refundpolicy/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{ csrf_field() }}
            
                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Name') }}:<sup class="redstar">*</sup></label>
                    <input type="text"  class="form-control" name="name" placeholder="Enter your name"  id="exampleInputTitle" value="">
                  </div>
                  
                  
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.Days') }}:<sup class="redstar">*</sup></label>
                    <input type="text"  class="form-control" name="days" placeholder="Enter Return Days"  id="exampleInputTitle" value="">
                  </div>
                  <div class="col-md-6">                 
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="123"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="123"></label>
                    </li>
                    <input type="hidden" name="status" value="0" id="1234">
                  </div>
                  
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                    <textarea name="detail" id="editor2" rows="5" class="form-control" placeholder="Enter Your Details"></textarea>
                    <br>
                  </div>
                  
                </div>
                <br>

                <div class="box-footer">
                 <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
                
              </form>
            </div>
            </div>
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