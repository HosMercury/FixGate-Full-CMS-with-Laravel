@extends('theme.index')
@section('orders_active')
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Location</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/locations') }}">

                {!! csrf_field() !!}

                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">Basic Data</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!--Code-->
                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Code*</label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="id" value="{{ old('id') }}">
                                <span><small>Store Code ex: 8707</small></span>

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('id') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <!--Name-->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name*</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Location</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address</label>

                            <div class="col-md-4">
                                <textarea class="form-control" name="address">{{old('address')}}</textarea>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <!--City-->
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">City*</label>

                            <div class="col-md-3">
                                <select class="form-control" name="city">
                                    <option value="" {{!old('city') ?'selected':''}} disabled>Select</option>
                                    <option {{old('city')=='Jeddah' ?'selected':''}} value="Jeddah">Jeddah</option>
                                    <option {{old('city')=='Riyadh' ?'selected':''}} value="Riyadh">Riyadh</option>
                                    <option {{old('city')=='Mecca'  ?'selected':''}} value="Riyadh">Mecca</option>
                                    <option {{old('city')=='Medinah'?'selected':''}} value="Medinah">Medinah</option>
                                    <option {{old('city')=='Abha'   ?'selected':''}} value="Abha">Abha</option>
                                    <option {{old('city')=='Damman' ?'selected':''}} value="Dammam">Dammam</option>
                                </select>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('city') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <!-- automatic location -->
                        <div class="form-group location" style="display: none; margin: 0 auto;">
                            <div class="col-md-4 col-md-offset-4">

                                <p id="demo" class=""></p>

                                <a onclick="getLocation()" class="btn btn-default form-control">Get My
                                    Location</a>
                                <br><span class="loading" style="display: none;"><small>Loading map ..</small></span>

                                <div id="mapholder" class="" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <!--Latitude-->
                        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Latitude</label>

                            <div class="col-md-4">
                                <input type="text" class="lat form-control" name="latitude"
                                       value="{{ old('latitude') }}">

                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('latitude') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <!--Longitude-->
                        <div class=" form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Longitude</label>

                            <div class="col-md-4">
                                <input type="text" class="lon form-control" name="longitude"
                                       value="{{ old('longitude') }}">

                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('longitude') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Management</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!--Manger-->
                        <div class="form-group{{ $errors->has('manager') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Manager*</label>

                            <div class="col-md-4">
                                <select class="form-control" name="manager">
                                    <option value="" disabled selected>Select</option>
                                    <option value="6074">Hossam Maher Talaat Hassan</option>
                                </select>
                                @if ($errors->has('manager'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('manager') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!--Submit-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-send"></i> Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    @stop
    @section('scripts')
            <!-- Geo Location -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script>
        $(document).ready(function () {
            $('.location').slideDown('slow')
        });
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('.loading').show();
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            latlon = new google.maps.LatLng(lat, lon)
            mapholder = document.getElementById('mapholder')
            mapholder.style.height = '200';
            mapholder.style.width = '200';

            $('.lat').val(lat)
            $('.lon').val(lon)

            var myOptions = {
                center: latlon, zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
            }

            var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
            var marker = new google.maps.Marker({position: latlon, map: map, title: "You are here!"});
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }

    </script>
@stop