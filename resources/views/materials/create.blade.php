@extends('theme.index')
@section('title') Create Material or Asset @stop
@section('bread-header') Materials & Assets @stop
@section('bread-small')create a new material @stop
@section('breadcrumb')
    <li class=""><a href="/materials"> Materials & Assets</a></li>
    <li class="active"><a href="/materials/create">New</a></li>
    </li>
@stop
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Material / Asset</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/materials') }}">
                @include('materials.partials.form')
            </form>
        </div>
    </div>
@stop
@section('scripts')

@stop