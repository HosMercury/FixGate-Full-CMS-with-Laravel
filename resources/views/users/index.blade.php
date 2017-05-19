@extends('theme.index')
@section('title') Users @stop
@section('bread-header') Users @stop
@section('bread-small') Users index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/users">Users</a><!-- where -->
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
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Users</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Location_id</th>
                            <th>Roles</th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Location_id</th>
                            <th>Roles</th>
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
                    ['id'          , 10 ,  'id'],
                    ['name'        , 35 ,  'name'],
                    ['location_id' , 20 ,  'location_id'],
                    ['roles'       , 35 ,  'roles.name'],
                ],
      'route' => 'users',
      'order' => 0,
      'sort_type' => 'asc'
    ]);
@stop
