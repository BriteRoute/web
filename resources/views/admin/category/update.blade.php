@extends('admin/layouts.master')
@section('title', 'Edit Category - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.EditCategory') }}</h3>
        </div>
       
        <div class="panel-body">

          <form id="demo-form" method="post" action="{{url('category/'.$cate->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Category') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{$cate->title}}">
              </div>

               <div class="col-md-6">
                <label for="slug">{{ __('adminstaticword.Slug') }}:<sup class="redstar">*</sup></label>
                <input pattern="[/^\S*$/]+" placeholder="Enter slug" type="text" class="form-control" name="slug" required value="{{$cate->slug}}">
              </div>


             
            </div>

          </br>

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Icon') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control icp-auto icp" name="icon" id="exampleInputTitle" value="{{$cate->icon}}">
              </div>


             
                  

              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
               
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $cate->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
                <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>

               <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Featured') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="featured" type="checkbox" name="featured" {{ $cate->featured == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="featured"></label>
                </li>
              <input type="hidden"  name="free" value="0" for="featured" id="featured">
              </div>
              
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.PreviewImage') }}:</label> - <p class="inline info">size: 255x200</p>
                <br>
                <input type="file" name="image" id="image" class="inputfile inputfile-1"  />
                <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span></label>

                @if(isset($cate['cat_image']))
                <img src="{{ url('/images/category/'.$cate['cat_image']) }}" class="img-responsive"/>
                @endif
              </div>

            </div>
            <br>
       
            <div class="row box-footer">
              <button type="submit" class="btn btn-md col-lg-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
