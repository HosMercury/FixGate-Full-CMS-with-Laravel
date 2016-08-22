@extends('Theme.source')
@section('orders_active')
@section('content')
    <div class="box box-danger" xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <h2 class="box-title">New Order</h2>
        </div>

        <div class="box-body">
            <p>User : {{auth()->user()->id}}</p>

            <p>Location : {{--auth()->user()->location->id--}}</p>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders') }}">

                {!! csrf_field() !!}

                        <!--Title-->
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('title') }}</strong>
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

                <!--Type-->
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Type*</label>

                    <div class="col-md-6">
                        <select class="form-control" name="type">
                            <option>A.C.</option>
                            <option>Tv</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Priority-->
                <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Priority*</label>

                    <div class="col-md-2">
                        <select class="form-control" name="priority">
                            <option value="" disabled selected>Select</option>
                            <option value="1">Regular - 72hr</option>
                            <option value="2">Important - 48hr</option>
                            <option value="3">Urgent - 24hr</option>
                            <option value="4">Crisis - ASAP</option>
                        </select>
                        @if ($errors->has('priority'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('priority') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Contact-->
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Contact Number*
                        <small>05xxxxxxxx</small>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="contact" value="{{ old('contact') }}">

                        @if ($errors->has('contact'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Notes-->
                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Notes
                        <small>(optional)</small>
                    </label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="notes">{{old('notes')}}</textarea>
                        @if ($errors->has('notes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('notes') }}</strong>
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