@extends('theme.index')
@section('header')
    <link type="text/css" rel="stylesheet"
          href="{{asset('theme/plugins/datatables/jquery.dataTables.css')}}">
    <link type="text/css" rel="stylesheet"
          href="{{asset('theme/plugins/datatables/extensions/responsive/css/dataTables.responsive.css')}}">
@stop
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
                    @if(count($types))
                        <table id="data" class="display" cellspacing="0">
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
                            @foreach($types as $type)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="types/{{$type->id}}">Show
                                        </a>
                                    </td>
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.box-body -->
                    @else
                        <br>
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <p>No location data  yet to show ...</p>
                            <p>Hint : If you sure that you have types before , contact your administrator</p>
                        </div>
                    @endif
                </div>
                <br>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('theme/plugins/datatables/jquery.datatables.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables/extensions/responsive/js/dataTables.responsive.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable({
                responsive: true,
                bAutoWidth : false,
            });
        });
    </script>
@stop