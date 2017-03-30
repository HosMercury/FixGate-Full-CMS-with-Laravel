@extends('theme.index')
@section('title') Show Order @stop
<link rel="stylesheet" href="{{asset('theme/dist/css/dropzone.css')}}">
<link type="text/css" rel="stylesheet"
      href="{{asset('theme/plugins/lity/dist/lity.min.css')}}"/>
@section('bread-header') Show Order @stop
@section('bread-small'){{$order->title}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/orders">Orders</a>
    <li class="active"><a href="/orders/{{substr($order->number,0,4)}}/{{substr($order->number,5)}}">{{$order->number}}</a></li>
    </li>
@stop
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/select2/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/rating/rating.css')}}">
@include('orders.partials.orders-show-styles')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Order Details -->
            <div class="box">
                <!-- close this order -->
                @include('orders.partials.details')
                <hr>
                <a href="/orders/{{substr($order->number,0,4)}}/{{substr($order->number,5)}}/edit" class="btn btn-sm btn-info">Edit Order</a>

                <form action="/orders/{{$order->id}}" method="POST"
                      onsubmit="return confirm('are you sure, you want to delete !?');"
                      style="display: inline;">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Order</button>
                </form>

            </div>

        </div>

        @include('orders.partials.modal')
        <!-- /.modal of closing order-->
        <!-- Order Assignments -->
        @if(count($workers))
            <div class="box" id="assignments">
                @include('orders.partials.assignments')
            </div>

            <div class="box ">
                @include('orders.partials.materials-costs')
            </div>
        @else
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>There is No added workers until now</p>
            </div>
        @endif
    </div>
@stop
@section('scripts')
    @include('orders.partials.scripts')
@stop