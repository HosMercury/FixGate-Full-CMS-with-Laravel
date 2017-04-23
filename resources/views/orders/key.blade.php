@extends('auth.base')
@section('title') Order Key  @stop
@section('content')
    <div class="container">
        <div class="row">
            @include('theme.partials.flash')
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="box ">
                        <div class="box-header with-border">
                            <h2 class="box-title"> Key</h2>
                        </div>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url($order->path().'/check') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Order Key</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="key"
                                           value="{{ old('key') }}">

                                    @if ($errors->has('key'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

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
            </div>
        </div>
    </div>
@endsection
