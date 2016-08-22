@extends('Theme.source')
@section('orders_active')
@section('content')
    <div class="box box-danger" xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Material / Asset</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/materials') }}">
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
                                        {{old('type')=='material'?'checked' : ' '}}> Material
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="asset"
                                        {{old('type')=='asset'?'checked' : ' '}}> Asset
                            </label>

                            @if ($errors->has('type'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('type') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!--Title-->
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Name*</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                            <textarea class="form-control" name="description">{{old('description')}}</textarea>
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
                            <input type="number" class="form-control" name="width" value="{{ old('width') }}">
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
                            <input type="number" class="form-control" name="length" value="{{ old('length') }}">
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
                            <input type="number" class="form-control" name="height" value="{{ old('height') }}">
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
                                <option value="" disabled selected>Select</option>
                                <option value="8707">Albahya</option>
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
                            <input type="text" class="form-control" name="sub_location" value="{{ old('sub_location') }}">

                            @if ($errors->has('sub_location'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('sub_location') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <!--SOH-->
                    <div class="form-group{{ $errors->has('soh') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">SOH*</label>

                        <div class="col-md-3">
                            <input type="number" class="form-control" name="soh" value="{{ old('soh') }}" step="0.1">
                            <span><small>SOH(units)</small></span>
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
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}" step="0.1">
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

            </form>
        </div>
    </div>
@stop
@section('scripts')

@stop