@extends('Theme.source')
@section('orders_active')
@section('content')

    @can('show_order_page',$order)
    <div class="row">
        <div class="col-md-12">
            <!-- Order Details -->
            @can('show_order_details',$order)
            <div class="box box-danger">
                @include('orders.partials.details')
            </div>
            @endcan

        </div>

        <!-- Order Assignments -->
        @can('show_order_assignments',$order)
        <div class="box box-danger">
            @include('orders.partials.assignments')
        </div>
        @endcan

                <!-- Materials and Costs -->
        @can('show_order_costs',$order)
        <div class="box box-danger">
            @include('orders.partials.materials-costs')
        </div>
        @endcan

    </div>
    <!--<div class="row">-->
    @endcan

@stop
@section('scripts')
    @include('orders.partials.show-scripts')
@stop