@extends('theme.index')
@section('title') Show Location @stop
@section('bread-header') Show Location @stop
@section('bread-small'){{$location->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/locations">Locations</a>
    <li class="active"><a href="/locations/{{$location->id}}">{{$location->name}}</a></li>
    </li>
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Location #{{$location->id}}</h3>
                    <a href="/locations/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Location</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        <h3><strong>location Name :</strong> {{$location->name}}</h3>
                        <hr>
                        <p><strong>Creator :</strong> {{$location->creator or 'not defined'}}</p>

                        <p><strong>Created at :</strong> {{$location->created_at or 'not defined'}}</p>

                        <p><strong>City :</strong> {{$location->city or 'not defined'}}</p>

                        <p><strong>Address :</strong> {{$location->address or 'not defined'}}</p>

                        <p><strong>Latitude :</strong> {{$location->latitude or 'not defined'}}</p>

                        <p><strong>Longitude :</strong> {{$location->longitude or 'not defined'}}</p>

                        <p><strong>Map :</p>

                        <div id="map"></div>
                        <br>
                    </div>
                    <a href="/locations/{{$location->id}}/edit" class="btn btn-info btn-sm">Edit location</a>

                    <form action="/locations/{{$location->id}}" method="POST"
                          onsubmit="return confirm('are you sure, you want to delete !?');"
                          style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('Delete')}}
                        <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Location</button>
                    </form>
                </div>
                <div class="box-body">
                    <div class="box-header">
                        <h3 class="box-title">Location Assets</h3>
                        <a href="/materials/create" class="btn btn-sm btn-success pull-right">
                            <i class="fa fa-fw fa-plus"></i> New Asset</a>
                    </div>
                    <div class="box-body">
                        @if(count($assets))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <thead style="background-color: #337ab7;color:white;">
                                    <th>Asset id</th>
                                    <th>name</th>
                                    <th>Cost</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                    </thead>
                                </tr>
                                <tbody>
                                @foreach($assets as $asset)
                                    <tr>
                                        <td><a href="/materials/{{$asset->id}}">{{$asset->id}}</a></td>
                                        <td><a href="/materials/{{$asset->id}}">{{str_limit($asset->name,20)}}</a></td>
                                        <td>{{$asset->price}}</td>
                                        <td>{{$asset->soh}}</td>
                                        <td>{{$asset->soh * $asset->price}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><strong>{{$total}}</strong></td>
                                </tfoot>
                            </table>
                        @else
                            <br>
                            <P class="alert alert-info ">Note : There is no assets registered for that Location ...
                                <span><a href="/materials/create">Add Assets</a></span>
                            </P>
                            <br><br>
                        @endif
                    </div>
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@section('scripts')
    {{--    @include('users.roles.partials.scripts')--}}
    @include('locations.partials.map-scripts')
@stop