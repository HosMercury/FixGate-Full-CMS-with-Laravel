@extends('theme.index')
@section('title') Materials & Assets @stop
@section('bread-header') Materials & Assets @stop
@section('bread-small') Materials & Assets index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/materials">Materials & Assets</a>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Materials</h3>
                    <a href="/materials/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New material</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Location</th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Location</th>
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
                    ['id'         , 5  ,'id'],
                    ['name'       , 40 ,'name'],
                    ['type'       , 15 ,'type'],
                    ['price'      , 10 ,'price'],
                    ['soh'        , 10 ,'soh'],
                    ['location'   , 20 ,'location'],
                ],
      'route' => 'materials',
      'order' => 0,
      'sort_type' => 'asc'
    ]);
@stop