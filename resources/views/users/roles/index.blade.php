@extends('theme.index')
@section('title') Roles @stop
@section('bread-header') Roles @stop
@section('bread-small') Roles index @stop
@section('breadcrumb')
    <li class="active">
        <a href="/roles">Roles</a><!-- where -->
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
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Roles</h3>
                    <a href="/roles/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Role</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <p><strong>Related :</strong>
                        <a href="users/workers" class="btn  btn-toolbar">Workers</a> |
                        <a href="roles" class="btn  btn-toolbar">Roles</a> |
                        <a href="permissions" class="btn  btn-toolbar">Permissions</a>
                    </p>

                    <table cellspacing="0" width="100%" class="table table-bordered" id="table">
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
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
                ],
      'route' => 'roles',
      'order' => 0,
      'sort_type' => 'asc'
    ]);
@stop
