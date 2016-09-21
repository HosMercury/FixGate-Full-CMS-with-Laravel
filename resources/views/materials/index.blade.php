@extends('theme.index')
@section('header')
    <link material="text/css" rel="stylesheet" href="{{asset('theme/plugins/datatables/jquery.dataTables.min.css')}}">
    <link material="text/css" rel="stylesheet" href="{{asset('theme/plugins/datatables/extensions/responsive/css/dataTables.responsive.css')}}">
    <link material="text/css" rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> materials</h3>
                    <a href="/materials/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New material</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($materials))
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
                            @foreach($materials as $location)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="materials/{{$location->id}}">Show
                                        </a>
                                    </td>
                                    <td>{{$location->id}}</td>
                                    <td>{{$location->name}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.box-body -->
                    @else
                        <br>
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                            <p>No location data yet to show ...</p>

                            <p>Hint : If you sure that you have materials before , contact your administrator</p>
                        </div>
                    @endif
                </div>
                <br>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('theme/plugins/datatables/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('theme/plugins/datatables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable({
                responsive: true,
                bAutoWidth : false
            });
        });
    </script>
@stop