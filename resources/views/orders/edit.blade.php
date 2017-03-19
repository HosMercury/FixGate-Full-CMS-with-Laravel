@extends('theme.index')
@section('title') Edit Order @stop
@section('bread-header') Service Orders @stop
@section('bread-small') Update @stop
@section('breadcrumb')
<li class=""><a href="/orders">Orders</a></li>
<li class="active"><a href="/orders/{{$order->id}}">{{$order->id}}</a></li>
@stop
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.skinFlat.css')}}">
@section('orders_active')
@section('content')
<div class="box box-primary" xmlns="http://www.w3.org/1999/html">
    <div class="box-header with-border">
        <span class="glyphicon glyphicon-pencil"></span>
        <h2 class="box-title">Edit Order</h2>
    </div>
    <!-- Delete Order -->
    {!! Form::open(['url'=>'orders/'.$order->id,'method'=>'DELETE',
    'role'=>'form','onsubmit' => 'return confirm("are you sure,you want to delete ?")'
    ,'style'=>'display:inline;'])!!}
    <div class="col-md-offset-10">
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-btn fa-remove"></i> Delete
        </button>
    </div>
    {!! Form::close() !!}
    <div class="box-body">
        {!! Form::open(['method'=>'PATCH','url'=>'orders/'.$order->id,'class' =>'form-horizontal','role'=>'form']) !!}
        @include('orders.partials.form',['button'=>'Update'])
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('scripts')
@include('orders.partials.rangeslider')
@stop