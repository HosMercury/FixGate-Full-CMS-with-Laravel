@extends('theme.index')
@section('orders_active')
@section('content')
    <div class="box " xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Permission</h2>
        </div>

        <div class="box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{url('/permissions') }}">
                {!! csrf_field() !!}

                        <!--Name-->
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

                <!--Label-->
                <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Label</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="label">{{old('label')}}</textarea>
                        @if ($errors->has('label'))
                            <span class="help-block">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Submit-->
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-send"></i> Send
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop