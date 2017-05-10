@extends('theme.index')
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.skinFlat.css')}}">
@section('title') Create Order @stop
@section('bread-header') Service Orders @stop
@section('bread-small') create a new order @stop
@section('breadcrumb')
    <li class=""><a href="/orders">Orders</a></li>
    <li class="active"><a href="/orders/create">New</a></li>
@stop
@section('orders_active')
@section('content')
    <div class="box box-primary" xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <span class="glyphicon glyphicon-pencil"></span>

            <h2 class="box-title">New Order</h2>
        </div>

        <div class="box-body">
            {!! Form::open(['url'=>'/orders' , 'method'=>'POST','class' =>'form-horizontal' ,'role'=>'form']) !!}
                @include('orders.partials.form',['button'=>'Create'])
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
@include('orders.partials.rangeslider')
@stop