{!! csrf_field() !!}

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Basic Data</h3>
    </div>
    <br>

    <!--Type-->
    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Type*</label>

        <div class="col-md-6">
            <label class="radio-inline">
                <input type="radio" name="type" value="material"
                       @if(isset($material)) {{$material->type =='material'?'checked' : ' '}}
                        @else {{old('type')=='material'?'checked' : ' '}} @endif
                > Material
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="asset"
                @if(isset($material)) {{$material->type =='asset'?'checked' : ' '}}
                @else {{old('type')=='asset'?'checked' : ' '}}@endif
                > Asset
            </label>

            @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!--Name-->
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Name*</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name"
                   value="@if(old('name')) {{old('name')}} @elseif(isset($material)) {{trim($material->name)}} @endif">
            @if ($errors->has('name'))
                <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                            </span>
            @endif
        </div>
    </div>

    <!--Description-->
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <textarea class="form-control" name="description">@if(old('description')) {{old('description')}} @elseif(isset($material)) {{trim($material->description)}} @endif</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                     <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <br>
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Size Dimentions</h3>
    </div>
    <br>

    <!--Width-->
    <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Width</label>

        <div class="col-md-2">
            <input type="number" class="form-control" name="width"
                   value="@if(isset($material)){{$material->width}}@endif">
            <span><small>width by cm</small></span>
            @if ($errors->has('width'))
                <span class="help-block">
                    <strong>{{ $errors->first('width') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!--Length-->
    <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Length</label>

        <div class="col-md-2">
            <input type="number" class="form-control" name="length" value="@if(isset($material)){{$material->length}}@endif">
            <span><small>length by cm</small></span>
            @if ($errors->has('length'))
                <span class="help-block">
                       <strong>{{ $errors->first('length') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--Height-->
    <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Height</label>

        <div class="col-md-2">
            <input type="number" class="form-control" name="height" value="@if(isset($material)){{$material->height}}@endif">
            <span><small>height by cm</small></span>
            @if ($errors->has('height'))
                <span class="help-block">
                                  <strong>{{ $errors->first('height') }}</strong>
                            </span>
            @endif
        </div>
    </div>
    <br>
</div>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Material Inventory</h3>
    </div>
    <br>
    <!--Location-->
    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Location*</label>

        <div class="col-md-4">
            <select class="form-control" name="location">
                <option value="" disabled @if(!isset($material)) selected @endif >Select</option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}" @if(isset($material) and $material->location_id == $location->id) selected @endif>{{$location->id}}</option>
                @endforeach
            </select>
            </select>
            @if ($errors->has('location'))
                <span class="help-block">
                                  <strong>{{ $errors->first('location') }}</strong>
                            </span>
            @endif
        </div>
    </div>

    <!--Sub Location-->
    <div class="form-group{{ $errors->has('sub_location') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">SubLocation</label>

        <div class="col-md-4">
            <input type="text" class="form-control" name="sub_location" value="@if(old('name')) {{old('sub_location')}} @elseif(isset($material)) {{trim($material->sub_location)}} @endif">

            @if ($errors->has('sub_location'))
                <span class="help-block">
                     <strong>{{ $errors->first('sub_location') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <!--SOH-->
    <div class="form-group{{ $errors->has('soh') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">َQty*</label>

        <div class="col-md-3">
            <input type="number" class="form-control" name="soh" value="@if(isset($material)){{trim(floatval($material->soh))}}@endif" step="0.1">
            <span><small>S O H (units)</small></span>
            @if ($errors->has('soh'))
                <span class="help-block">
                                  <strong>{{ $errors->first('soh') }}</strong>
                            </span>
            @endif
        </div>
    </div>

    <!--Price-->
    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Price*</label>

        <div class="col-md-3">
            <input type="number" class="form-control" name="price" value="@if(isset($material)){{trim(floatval($material->soh))}}@endif" step="0.1">
            <span><small>SR ( example:24.85 )</small></span>
            @if ($errors->has('price'))
                <span class="help-block">
                       <strong>{{ $errors->first('price') }}</strong>
                 </span>
            @endif
        </div>
    </div>
    <br>
</div>

<div class="box box-solid">
    <!--Submit-->
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-send"></i> Send
            </button>
        </div>
    </div>
    <br>
</div>
