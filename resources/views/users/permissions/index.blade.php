@extends('Theme.source')
@section('header')
    <link type="text/css" rel="stylesheet" href="{{asset('Theme/plugins/datatables/jquery.dataTables.min.css')}}">
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">All permissions</h3>
                    <a href="/permissions/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i>  New Permission</a>
                </div>


                <!-- /.box-header -->
                @if(count($permissions))
                    <div class="box-body">
                        <div class="col-xs-11 box box-widget">
                            <table id="data" class="display" cellspacing="0" class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Show</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                               href="/permissions/{{$permission->id}}">Show</a>
                                        </td>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
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

                        <p>No permissions data -->  yet to show ...</p>

                        <p>Hint : Add permissions to be shown here</p>
                    </div>
                    <br>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('Theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });
    </script>

@stop