

<section class="content">
  <div class="row">
    <div class="col-xs-12">

        <!-- /.box-header -->
     
        <form action="{{ route('icons.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
              
         
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="">PWA {{ __('adminstaticword.Icon') }} (512x512): <span class="text-danger">*</span> </label>
                    <input type="file" name="icon_512" class="form-control" />
                  </div>
                </div>

                <div class="col-md-2 well">
                  <img class="img-responsive" src="{{ url('images/icons/icon-512x512.png') }}" alt="icon_256x256.png">
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">PWA {{ __('adminstaticword.SplashScreen') }} (2048x2732): <span class="text-danger">*</span> </label>
                    <input type="file" name="splash_2048" class="form-control" />
                  </div>
                </div>
  
                <div class="col-md-2 well">
                  <img class="img-responsive" src="{{ url('images/icons/splash-2048x2732.png') }}" alt="splash-2048x2732.png">
                </div>
                
               
            <div class="box-footer">
              <button type="submit" class="pull-left btn btn-md col-md-2 btn-flat btn-primary">
                  {{ __('adminstaticword.Save') }}
                </button>
                
            </div>
        </form>
       
     
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>