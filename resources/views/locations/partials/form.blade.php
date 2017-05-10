{!! csrf_field() !!}

<div class="box box-solid">

    <div class="box-header with-border">
        <h3 class="box-title">Basic Data</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <!--Code-->
        <div class="form-group{{ $errors->has('store_code') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Store Code *</label>

            <div class="col-md-3">
                <input type="text" class="form-control" name="store_code" value="{{ $location->store_code or old('id')}}">
                <span><small>Store Code ex: 8000 - 900787</small></span>

                @if ($errors->has('store_code'))
                    <span class="help-block">
                         <strong>{{ $errors->first('store_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!--Name-->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Name *</label>

            <div class="col-md-4">
                <input type="text" class="form-control" name="name" value="{{ $location->name or old('name')}}">

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
                <textarea class="form-control" name="address">{{$location->address or  old('address')}}</textarea>
                @if ($errors->has('address'))
                    <span class="help-block">
                          <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!--City-->
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">City *</label>

            <div class="col-md-3">
                <input type="text" class="form-control" name="city" value="{{ $location->city or old('city')}}">

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

                <div id="mapholder" class="">
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
    <!-- /.box-header -->
    <div class="box-body">

        <!--Submit-->
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-send"> </i> Save Location
                </button>
            </div>
        </div>
    </div>
</div>


