@extends('theme.source')
@section('header')
    <link type="text/css" rel="stylesheet" href="{{asset('Theme/plugins/datatables/jquery.dataTables.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('Theme/plugins/datepicker/datepicker3.css')}}">
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Work Orders (Last Month)</h3>
                </div>

                <div class="box-body">
                    <div class="container">
                        <form action="orders" method="post">
                            {{csrf_field()}}
                            <fieldset>
                                <legend>Orders By Date</legend>
                                <div class="col-xs-11">
                                    <div class="col-sm-4">
                                        <label>From:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" name="fromDate">
                                        </div>
                                    </div>

                                    <!-- /.input group -->

                                    <div class="col-sm-4"><label>To:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" name="toDate">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                                <div class="form-group col-xs-3 pull-left" style="margin: 20px;">
                                    <button type="submit" class="btn btn-lg btn-info">Go</button>
                                </div>
                            </fieldset>
                        </form>
                        <hr>
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Orders From {{$dateFrom}} To {{$dateTo}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-xs-11 box box-widget">
                                <canvas id="graph"></canvas>
                            </div>
                            <hr>
                            <div class="col-xs-11 box box-widget">
                                <table id="data" class="display" cellspacing="0" class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Open</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Trade</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Open</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Trade</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($orders as $order)
                                        @foreach($order->assignments as $assignment)
                                            <tr>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="orders/{{$order->id}}">Open</a>
                                                </td>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->title}}</td>
                                                <td>{{--$order->location->location_id--}}</td>
                                                <td>{{$order->trade}}</td>
                                                <td>{{$order->priority}}</td>
                                                <td>{{$assignment->status}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('Theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('Theme/plugins/chartjs/Chart.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
            $('#data').css('min-height','200px');
        });
    </script>

    <script>

        var data = {
            labels: {!! $count_keys !!},
            datasets: [{
                fillColor: "rgba(151,187,205,.4)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                data: {{$count_values}}
            }]

        }

        Chart.defaults.global.responsive = true;

        var ctx = document.getElementById("graph").getContext("2d");

        new Chart(ctx).Line(data);

    </script>
@stop