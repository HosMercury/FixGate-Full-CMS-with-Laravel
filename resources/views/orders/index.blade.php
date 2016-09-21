@extends('theme.index')
@section('title') Service Orders @stop
@section('bread-header') Service Orders @stop
@section('bread-small') Orders index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/orders">Orders</a>
    </li>
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/datatables/jquery.dataTables.css')}}">
    <link type="text/css" rel="stylesheet"
          href="{{asset('theme/plugins/datatables/extensions/responsive/css/dataTables.responsive.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link type="text/css" rel="stylesheet"
          href="http://www.jqueryscript.net/demo/DataTables-Jquery-Table-Plugin/media/css/jquery.dataTables_themeroller.css">
    <style>
        @media (max-width: 600px) {

        }
    </style>
@stop
@section('content')
    <div class="box ">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Service Orders</h3>
            <a href="orders/create" class="btn btn-sm btn-primary pull-right">
                <i class="fa fa-fw fa-pencil">
                </i> New Order
            </a>
        </div>

        <div class="box-body">
            <legend>Filters</legend>

            <div class="col-md-12">
                <form action="filter" method="post">

                    {{csrf_field()}}

                    <div class="form-group col-md-4">
                        <label>From :</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="date" class="form-control pull-right" name="fromDate">
                        </div>
                    </div>

                    <!-- /.input group -->
                    <div class="form-group col-md-4">
                        <label>To :</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="date" class="form-control pull-right" name="toDate">
                        </div>
                    </div>

                    <!--Location_id-->
                    <div class="form-group col-md-4 {{ $errors->has('location') ? ' has-error' : '' }}">
                        <label>Location :</label>

                        <select class="form-control" name="location">
                            <option value="" {{!old('location') ?'selected':''}}>Location</option>
                            <option {{old('location')=='8707' ?'selected':''}} value="8707">8707</option>
                        </select>
                        @if ($errors->has('location'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-send"></i> Send
                            </button>
                        </div>
                    </div>
            </div>
            <!-- /.input group -->

            </form>
            <br>
            <legend>Orders</legend>
            <div class="">
                <i class="fa fa-fw fa-calendar-minus-o"></i>
                <strong>From</strong>
                {{$dateFrom }}
                <i class="fa fa-fw fa-calendar-plus-o"></i>
                <strong>To</strong>
                {{$dateTo }}
            </div>

            <!-- dataTables -->
            @if(count($orders))
                <div class="box box-solid bg-teal-gradient col-md-12">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-th"></i>

                        <h3 class="box-title">Orders</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn bg-teal btn-sm" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <canvas id="chart" class="container"></canvas>
                </div>
                <div class="box box-widget table-responsive"> <!-- adding table-responsive for this div  -->
                    <table id="data" class="display" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Show</th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Priority</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Show</th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Priority</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a class="btn btn-sm btn-reddit"
                                       href="orders/{{$order->id}}">Show
                                    </a>
                                </td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->title}}</td>
                                <td>{{$order->location->location_id or ''}}</td>
                                <td>{{$order->type}}</td>
                                <td>{{$order->priority}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>

        <!-- /.box-body -->
        @else
            <br>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                <p>No service orders data in that period yet to show ...</p>

                <p>Hint : If you sure that you have service orders before , please select the
                    preferable period from datepickers above then GO</p>
            </div>
            <br>
        @endif
    </div>
@stop
@section('scripts')
    <script src="{{asset('theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
    <script src="{{asset('theme/plugins/chartjs/chart.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('#data').DataTable({
                    jQueryUI: true,
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                        );
                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });
                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });
        });
    </script>

    <script>
        //chartjs
        var data = {
            labels: {!! $count->keys() !!},
            datasets: [{
                fillColor: "rgba(151,187,205,.4)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                data: {{$count->values()}}
            }]
        }
        var options = {
            responsive:true,
            title: {
                display: true,
                text: 'Orders per date'
            }
        };
//        Chart.defaults.global.responsive = true;
        var ctx = document.getElementById("chart").getContext("2d");
        new Chart(ctx).Line(data,options);
    </script>
@stop