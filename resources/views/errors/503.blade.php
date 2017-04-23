@extends('errors.partials.base')
@section('title')
    Internal Server Error
@stop
@section('message')
    <p><strong>Sorry </strong>, The server encountered an error .</p>
    <p>For any issues ,please contact your administrator</p>
    <p>Return to <i class="fa fa-fw fa-Home"></i><a href="/">Home</a>
    </p>
@stop