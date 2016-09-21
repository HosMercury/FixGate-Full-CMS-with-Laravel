@extends('auth.base')
@section('title') Page Not Found @stop
@section('styles')
    <style>
        .content-wrapper{
            padding-top: 5em;
        }
        .box-body{
            padding-bottom: 2em;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="box ">
                        <div class="box-header with-border">
                            <h2 class="box-title"><i class="fa fa-fw fa-warning"></i>
                                @yield('title')
                            </h2>
                        </div>
                    </div>
                    <div class="box-body">
                        @yield('message')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

