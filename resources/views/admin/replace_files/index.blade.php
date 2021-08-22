@extends('admin.layouts.master')
@section('title', 'Quick Updates - Admin')
@section('body')
 
<section class="content">
   @include('admin.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">{{ __('Quick Updates') }}</h3>
                </div>
                    
                <div class="panel-body">

                 <div class="callout callout-success">
                        <i class="fa fa-info-circle"></i> {{ __('adminstaticword.ImportantNote') }}:

                        <ul>
                            <li>
                                ⦿ {{__("Quick update is for bug fix update of version " . env('APP_VERSION'))}}
                            </li>

                            <li>
                                ⦿ {{__("Click to quick update when update is available.")}}
                            </li>

                           
                        </ul>
                </div>

                   
                @if($contents == !NULL)   

                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h3 class="box-title">Updates {{ $app_version }} is available</h3>

                            <form action="{{ url('replace') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{__("Click to quick update")}}
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>

                @else
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <button type="disabled" class="btn btn-default btn-block">
                                {{__("No Update is Available !!")}}
                            </button>
                        </div>
                    </div>

                @endif
                    

                    
                </div>

            </div>
        </div>
    </div>
</section>
@endsection




