@extends('admin.layouts.master')
@section('title', 'Import Demo - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">{{ __('adminstaticword.DemoImport') }}</h3>
                </div>

                
                    
                <div class="panel-body">

                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <i class="fa fa-info-circle"></i> {{ __('adminstaticword.ImportantNote') }}:

                            <ul>
                                <li>
                                    {{__("ON Click of import data your existing data will remove (except users & settings).")}}
                                </li>

                                <li>
                                    {{__("ON Click of reset data will reset your site (which you see after fresh install).")}}
                                </li>
                            </ul>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-xs-6">

                            <h5 class="panel-title">{{ __('adminstaticword.DemoImport') }} :</h5>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form action="{{ url('admin/import/demo') }}" method="POST">
                                    @csrf
                                    
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('adminstaticword.DemoImport') }}
                                        </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-6">
                           <h5 class="panel-title">{{ __('adminstaticword.ResetDemo') }} :</h5>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form action="{{ url('admin/reset/demo') }}" method="POST">
                                    @csrf
                                    
                                    <div class="">
                                        <button type="submit" class="btn btn-secondary btn-block">
                                            {{ __('adminstaticword.ResetDemo') }}
                                        </button>
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




