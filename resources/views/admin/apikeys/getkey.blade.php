@extends('admin.layouts.master')
@section('title', 'Get Secret KEY')

@section('stylesheets')

@section('body')


<section class="content">
   @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Client Secret KEY</h3>
                </div>
                <div class="panel-body">


                <div class="card-header">
                    <h5 class="card-title">Hello, {{ Auth::user()->fname }}!</h5>
                </div>
                
                <form action="{{ route('apikey.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Client Secret KEY:</label>
                               
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" class="form-control" value="{{ $key ? $key->secret_key : "" }}" name="apikey" class="form-control" placeholder="API KEY">
                        </div>
                        <br>
                      
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">
                            {{ $key ? "RE-GENREATE KEY" : "GET YOUR KEY" }}
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</section>
@endsection


