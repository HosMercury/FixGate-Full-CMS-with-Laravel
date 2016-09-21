@extends('theme.index')
@section('header')
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/datatables/jquery.dataTables.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-list-ul"></i> Locations</h3>
                    <a href="/locations/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Location</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($locations))
                        <table id="data" class="display" cellspacing="0" class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Show</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Show</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="locations/{{$location->id}}">Show
                                        </a>
                                    </td>
                                    <td>{{$location->id}}</td>
                                    <td>{{$location->name}}</td>
                                    <td>{{$location->address}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.box-body -->
                    @else
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                            <p>No location data in that period yet to show ...</p>

                            <p>Hint : If you sure that you have locations before , contact your administrator</p>
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
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });
    </script>
@stop