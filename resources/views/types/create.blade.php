@extends('theme.index')
@section('title') Create Type @stop
@section('bread-header') Types @stop
@section('bread-small')create a new type @stop
@section('breadcrumb')
    <li class=""><a href="/types">Types</a></li>
    <li class="active"><a href="/types/create">New</a></li>
    </li>
@stop
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Type</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/types') }}">
                @include('types.partials.form')
            </form>
        </div>
    </div>
@stop