@extends('theme.index')
@section('title') Edit Material @stop
@section('bread-header') Materials @stop
@section('bread-small') Edit an existing material @stop
@section('breadcrumb')
    <li class=""><a href="/materials">Materials</a></li>
    <li class="active"><a href="/types/{{$material->id}}">{{$material->name}}</a></li>
@stop
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">Update</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/materials/'.$material->id) }}">
                {{method_field('PATCH')}}
                @include('materials.partials.form')
            </form>
        </div>
    </div>
@stop
@section('scripts')

@stop