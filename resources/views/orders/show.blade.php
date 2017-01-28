@extends('theme.index')
@section('title') Show Order @stop
@section('bread-header') Show Order @stop
@section('bread-small'){{$order->title}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/orders">Orders</a>
    <li class="active"><a href="/orders/{{$order->id}}">{{$order->id}}</a></li>
    </li>
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/select2/select2.min.css')}}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black !important;
            background-color: #d9edf7;
        }
        @media(max-width: 1000px){
            .assigner{
                margin: 10px 40px;
            }
        }
    </style>
@stop
@section('content')
    {{--@can('show_order_page',$order)--}}
    <div class="row">
        <div class="col-md-12">
            <!-- Order Details -->
            {{--@can('show_order_details',$order)--}}
            <div class="box">
                @include('orders.partials.details')
            </div>
            {{--@endcan--}}
        </div>

        <!-- Order Assignments -->
        {{--@can('show_order_assignments',$order)--}}
        @if(count($workers))
            <div class="box">
                @include('orders.partials.assignments')
            </div>
            {{--@endcan--}}
            <!-- Materials and Costs -->
            {{--@can('show_order_costs',$order)--}}
            <div class="box ">
                @include('orders.partials.materials-costs')
            </div>
        @else
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>There is No added workers untill now .
                    If you are allowed , please <a href="/users/create"> add ones</a></p>
            </div>
        @endif
        {{--@endcan--}}
    </div>
    <!--<div class="row">-->
    {{--@endcan--}}
@stop
@section('scripts')
    @include('orders.partials.scripts')
    <script src="{{asset('theme/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript">
        $('select').select2({
            placeholder: "Select worker(s)",
            allowClear: true
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.edit-assignment').click(function(){
                $('.delete-assignment').show();
            });
        });
    </script>
@stop