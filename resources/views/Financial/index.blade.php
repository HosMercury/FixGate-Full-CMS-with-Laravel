@extends('theme.index')
@section('title') Financial @stop
@section('bread-header') Financial @stop
@section('bread-small') Financial index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/financial">Financial</a>
    </li>
@stop
@include('orders.partials.datatables-styles')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Financial</h3>
                    {{--<a href="/types/create" class="btn btn-sm btn-success pull-right">--}}
                    {{--<i class="fa fa-fw fa-plus"></i> New finantial</a>--}}
                </div>


                <div class="box-body">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab"> All Used Materials</a></li>
                            <li><a href="#tab_2" data-toggle="tab"> All Used Costs</a></li>
                        </ul>
                        <div class="tab-content">
                            <br>
                            <div class="tab-pane active" id="tab_1">
                                <table cellspacing="0" width="100%" class="table table-bordered" id="table2">
                                    <tfoot>
                                    <tr>
                                        <th>#id</th>
                                        <th>Material id</th>
                                        <th>Material Name</th>
                                        <th>Order id</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                    <thead>
                                    <tr>
                                        <th>#id</th>
                                        <th>Material id</th>
                                        <th>Material Name</th>
                                        <th>Order id</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <br>
                                <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Description</th>
                                        <th>Order</th>
                                        <th>Creator</th>
                                        <th>Created_at</th>
                                        <th>Cost</th>
                                    </tr>
                                    </tfoot>
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Description</th>
                                        <th>Order</th>
                                        <th>Creator</th>
                                        <th>Created_at</th>
                                        <th>Cost</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('orders.partials.datatables-scripts',
    [ 'cols' =>[
                    ['id'          , 10  ,  'id'],
                    ['description' , 30  ,  'description'],
                    ['order_id'    , 15  ,  'order_id'],
                    ['creator'     , 15  ,  'creator'],
                    ['created_at'  , 15  ,  'created_at'],
                    ['cost'        , 15  ,  'cost'],
                ],
     'route' => 'financial/costs',
     'order' => 4,
     'sort_type' => 'asc'
    ])

    <script>
        $(document).ready(function () {
            var table = $('#table2').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                responsive: true,
                dom: 'lB<"date">frtip',
                order: [[0, "asc"]],
                ajax: '/financial/materials/data2',

                columns : [
                  {data: 'id'},
                  {data: 'material_id'    },
                  {data: 'material_name' } ,
                  {data: 'order_id'},
                  {data: 'quantity'},
                  {data: 'created_at'}
                ],

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ],
            });
            // Setup - add a text input to each footer cell
            $('#table tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
            // Apply the Column search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
                //Stop filter when clicking for search
                $('input', this.header()).on('click', function (e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@stop