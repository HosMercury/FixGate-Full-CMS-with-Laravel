@extends('theme.index')
@section('title') Service Orders @stop
@section('bread-header') Service Orders @stop
@section('bread-small') Orders index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/orders">Orders</a>
    </li>
@stop
@include('orders.partials.datatables-styles')

<style>
    .chartContainer {
        padding: 3px;
        margin: 3em;
    }

    @media (max-width: 600px) {
        .chartContainer {
            padding: 0;
        }
    }
</style>

@section('content')
    {{-- Graph for only titles --}}
    @if(auth()->user()->fromTitles())
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-fw fa-bar-chart"></i> Chart ( weak ago )</h3>
            </div>
            <div class="chartContainer">
                @if(!$count->isEmpty())
                    <canvas id="chart" class="margin" style="width: 600px;min-height: 300px;"></canvas>
                @else
                    <p>There is no orders for Last week , To draw a chart .</p>
                @endif
                <p><strong>Date From : </strong>{{$dateFrom}} <strong>To : </strong> {{$dateTo}}</p>
            </div>
        </div>
    @endif


    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Service Orders</h3>
            <a href="/orders/create" class="btn btn-sm btn-primary pull-right">
                <i class="fa fa-fw fa-pencil">
                </i> New Order
            </a>
        </div>

        <div class="box-body">
            <div class="tab-pane active">
                <div class="">
                    <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Number</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    @include('orders.partials.datatables-scripts',
    [ 'cols' =>[
                    ['number'         , 5  ,'id'],
                    ['title'      , 40 ,'title'],
                    ['type'       , 15 ,'type'],
                    ['priority'   , 10 ,'priority'],
                    ['location_id', 10 ,'location_id'],
                    ['created_at' , 20 ,'created_at'],
                ],
     'route' => 'orders',
     'order' => 5,
     'sort_type' => 'desc'
    ]);
    <script src="{{asset('theme/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
    <script src="{{asset('theme/plugins/chartjs/chart.min.js')}}"></script>

    @if(!$count->isEmpty())
        <script>
            //chartjs
            var data = {
                labels: {!! $count->keys() !!},
                datasets: [{
                    fillColor: "rgba(151,187,205,.6)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    data: {{$count->values()}}
                }]
            }
            var options = {
                responsive: true,
                title: {
                    display: true,
                    text: 'Last week Orders'
                }
            };
            var ctx = document.getElementById("chart").getContext("2d");
            new Chart(ctx).Line(data, options);


            //hide chart
            $('.chartRemove').on('click', function (e) {
                $('.chartContainer').hide();
            });

        </script>
    @endif
@stop