@extends('theme.index')
@section('title') Edit Type @stop
@section('bread-header') Types @stop
@section('bread-small') edit an existing type @stop
@section('breadcrumb')
    <li class=""><a href="/types">Types</a></li>
    <li class="active"><a href="/types/'.{{$type->id}}">{{$type->name}}</a></li>
    </li>
@stop
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">New</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/types/'.$type->id) }}">
                {{method_field('PATCH')}}
                @include('types.partials.form')
            </form>
        </div>
    </div>
@stop