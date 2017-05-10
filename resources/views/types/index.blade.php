@extends('theme.index')
@section('title') Types @stop
@section('bread-header') Types @stop
@section('bread-small') Types index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/types">Types</a>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Types</h3>
                    <a href="/types/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New type</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Created_at</th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Created_at</th>
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
                    ['id'         , 25  , 'id'],
                    ['name'       , 40  ,'name'],
                    ['created_at' , 25  ,'created_at']
                ],
      'route' => 'types',
      'order' => 0,
     'sort_type' => 'asc'
    ]);
@stop