@extends('theme.index')
@section('title') Edit Location @stop
@section('bread-header') Locations @stop
@section('bread-small') Update @stop
@section('breadcrumb')
    <li class=""><a href="/locations">Locations</a></li>
    <li class="active"><a href="/locations/{{$location->id}}">{{$location->name}}</a></li>
@stop
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">Edit Location</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/locations/'.$location->id) }}">
                {{method_field('PATCH')}}
                @include('locations.partials.form')
            </form>
        </div>
    </div>
@stop
@section('scripts')
    @include('locations.partials.get-location-script')
@stop