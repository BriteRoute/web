@extends('admin/layouts.master')
@section('title', 'Update Google Meet Setting')
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

  <div class="box">
    <div class="box-header with-border">
      <div class="box-title">
        Upload Google Meet clientsecret.json file : 
      </div>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('googlemeet.updatefile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div class="eyeCy">
                <label>Chose Json File (clientsecret.json):</label>
                <input type="file" name="file" value="" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}
              </button>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <h4 style="color: black"><i class="fa fa-question-circle"></i> How to get Google Meet clientsecret.json file : </h4>
          <hr>
          <div class="panel panel-default">
            <div class="panel-body">
              <ul>
                <li>• Use the link to create or select a project in the google developers console and automatically turn on the APi. Click continue then <b>go to credential</b>. : <a href="https://console.cloud.google.com/flows/enableapi?apiid=calendar" target="_blank">Google Cloud Platform</a></li>
                 <li>• On the <b>Add credentials to your project</b> click the <b>Cancel</b> button.</li>
                 <li>• At the top of the page, select the <b>Oauth consent screen</b>tab. Select an <b>Email Address</b>, Enter product name if not already set and click the <b>Save</b> button.</li>
                 <li>• Select the <b>Credentials</b> tab, click the <b>Create Credentials</b> button and select <b>Oauth client id</b>.</li>

                 <li>• Use this URL as Redirect URL <b>{{ url('oauth') }}</b> </li>

                 <li>• Select the application type <b>Other</b>, enter the name 'googlemeet'. and click the <b>Create</b> button.</li>
                 

                 <li>• Click <b>Ok</b> to dismiss the resulting dialog.</li>
                 <li>• Click the <b>download json</b> button to the right of the client id.</li>
                 <li>• Upload your <b>(Downloaded json)</b>file.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('script')
  <script>
     $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
      });

    
  </script>
@endsection