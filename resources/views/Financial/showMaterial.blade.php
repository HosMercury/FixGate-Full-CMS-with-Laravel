@extends('theme.index')
@section('title') Finantial Receipt @stop
@section('bread-header') Material dispensed @stop
@section('bread-small') Material #{{$material->id}} used for Order #{{$material->pivot->order_id}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/financial">Financial</a>
    <li class="active"><a
                href="/financial/material/{{$material->id}}/order/{{$material->pivot->order_id}}">{{$material->name}}</a>
    </li>
    </li>
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Receipt Details</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <th></th>
                            <th>Material</th>
                            <th>Order</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Id</td>
                                <td>{{$material->id}}</td>
                                <td>{{$material->pivot->order_id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$material->name}}</td>
                                <td>{{str_limit(\App\Order::find($material->pivot->order_id)->title, 25)}}</td>
                            </tr>
                            <tr>
                                <td>Link</td>
                                <td><a class="btn btn-info btn-sm" href="/materials/{{$material->id}}">show</a></td>
                                <td><a class="btn btn-info btn-sm" href="/orders/{{$material->pivot->order_id}}">show</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>
                                    <strong>Quantity : </strong>{{$material->pivot->quantity}} *
                                    <strong>Price :</strong>{{$material->price}} <strong><hr>
                                        Total Price: </strong> {{$material->pivot->quantity * $material->price}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    {{--<a href="/locations/{{$location->id}}/edit" class="btn btn-info btn-sm" >Edit location</a>--}}
                    {{--<form action="/locations/{{$location->id}}" method="POST"--}}
                    {{--onsubmit="return confirm('are you sure, you want to delete !?');"--}}
                    {{--style="display: inline;">--}}
                    {{--{{csrf_field()}}--}}
                    {{--{{method_field('Delete')}}--}}
                    {{--<button type="submit" class="btn btn-sm btn-danger pull-right">Delete Location</button>--}}
                    {{--</form>--}}
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop