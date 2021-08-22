@extends('admin.layouts.master')
@section('title', 'Remove public - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">{{ __('Remove public') }}</h3>
                </div>
                    
                <div class="panel-body">

                <div class="callout callout-danger">
                        <i class="fa fa-info-circle"></i> {{ __('adminstaticword.ImportantNote') }}:

                        <ul>
                            <li>
                                ⦿ {{__(('Removing public from URL is only works when you have installed script in main domain.'))}}
                            </li>

                            <li>
                                ⦿ {{__("Do not remove public when you have Installed script in subdomin or subfolders.")}}
                            </li>

                           
                        </ul>
                </div>


                @if(file_exists(base_path().'/'.'.htaccess'))

                   
                    @if($contents == NULL || $contents != $destinationPath)

                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h3 class="box-title">Remove public from URL</h3>

                            <form action="{{ route('add.content') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{__("Click to Remove public")}}
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>

                    @endif
               

               
                @elseif(!file_exists(base_path().'/'.'.htaccess') )
        
                     <div class="panel panel-default">
                        <div class="panel-body">

                            <h3 class="box-title">Remove public from URL</h3>

                            <form action="{{ route('create.file') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary btn-block">
                                    {{__("Click to Remove public")}}
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>

                @endif

               
                
                    

                    
                </div>

            </div>
        </div>
    </div>
</section>
@endsection




