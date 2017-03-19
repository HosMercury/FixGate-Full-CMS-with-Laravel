@extends('theme.index')
@section('title') Show Order @stop
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
    {{--@can('show_order_page',$order)--}}
    <div class="row">
        <div class="col-md-12">
            <!-- Order Details -->
            {{--@can('show_order_details',$order)--}}
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

            {{--@endcan--}}
        </div>

        @include('orders.partials.modal')
                <!-- /.modal -->
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
    <script src="{{asset('theme/plugins/rating/rating.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('select').select2({
                placeholder: "Select worker(s)",
                allowClear: true
            });

            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });

            $('#rating').rating();
        });
    </script>
    @if (count($errors) > 0)
        <script>
            $('#rateModal').modal('show');
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $('.edit-assignment').on('click', function () {
                $(this).text(function (i, text) {
                    return text === "Cancel" ? "Edit" : "Cancel";
                });
                $('.delete-assignment').toggle();
                $('.new-assignment').toggle();
                $('.add-worker-form').toggle();
            });
        });
    </script>
@stop