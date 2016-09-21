@extends('theme.index')
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/datatables/jquery.dataTables.min.css')}}">
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> workers</h3>
                    <a href="auth/register" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i>Register New worker</a>
                </div>
                <!-- /.box-header -->
                @if(count($workers))
                    <div class="box-body">
                        <div class="col-xs-11 box box-widget">
                            <table id="data" class="display" cellspacing="0" class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Id</th>
                                    <th>workerName</th>
                                    <th>email</th>
                                    <th>role</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Show</th>
                                    <th>id</th>
                                    <th>workerName</th>
                                    <th>email</th>
                                    <th>role</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($workers as $worker)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                               href="/users/{{$worker->id}}">Show</a>
                                        </td>
                                        <td>{{$worker->id}}</td>
                                        <td>{{$worker->name}}</td>
                                        <td>{{$worker->email}}</td>
                                        <td>
                                            @if(count($worker->roles))
                                                @foreach($worker->roles as $role)
                                                    {{$role->name}}
                                                @endforeach
                                            @else
                                                <p>No roles</p>
                                            @endif
                                        </td>
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

                        <p>No workers data --> yet to show ...</p>

                        <p>Hint : Register workers to be shown here</p>
                    </div>
                    <br>
                @endif
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });
    </script>
@stop


