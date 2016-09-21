@extends('theme.index')
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/ionslider/ion.rangeSlider.skinFlat.css')}}">
@stop
@section('title') Create Order @stop
@section('bread-header') Service Orders @stop
@section('bread-small') create a new order @stop
@section('breadcrumb')
    <li class=""><a href="/orders">Orders</a></li>
    <li class="active"><a href="/orders/create">Create</a></li>
@stop
@section('orders_active')
@section('content')
    <div class="box box-primary" xmlns="http://www.w3.org/1999/html">
        <div class="box-header with-border">
            <span class="glyphicon glyphicon-pencil"></span>

            <h2 class="box-title">New Order</h2>
        </div>

        <div class="box-body">

            {!! Form::open(['url'=>'/orders' , 'method'=>'post','class' =>'form-horizontal' ,'role'=>'form']) !!}
            {!! csrf_field() !!}

                    <!--Type-->
            @if(count($types))
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!! Form::label('type','Type*' ,['class'=>'col-md-4 control-label']) !!}
                    <div class="col-md-3">
                        {!! Form::select('type', $types , null ,[ 'class' => 'form-control','placeholder' => 'Pick a type'])!!}

                        @if ($errors->has('type'))
                            <span class="help-block">
                             <strong>{{ $errors->first('type') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="callout callout-warning">
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                        <p>Until Now , You didn't add any type , yet . Note that you
                            can't add an order untill you add type(s)</p>
                        </p>Please <a href="/types/create"><strong>Add type</strong></a> First </p>
                    </div>
                </div>
                @endif

                        <!--Title-->
                <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                    {!! Form::label('title','Title*' , ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-6">
                        {!! Form::text('title',null, ['class' => 'form-control']) !!}
                        @if ($errors->has('title'))
                            <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>


                <!--Description-->
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description' ,'Description*' , ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-6">
                        {!! Form::textarea('description',null,['class' => 'form-control' , 'rows' =>'4']) !!}
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <!--Priority-->
                <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                    {!! Form::label('priority','Priority*' ,['class'=>'col-md-4 control-label']) !!}

                    <div class="col-md-3">
                        {{--{!! Form::text('priority', null , ['id' => 'priority']) !!}--}}
                        <input type="text" name="priority" id="priority" value="">
                        <span class="changeable pull-right"></span>
                        @if ($errors->has('priority'))
                            <span class="help-block">
                             <strong>{{ $errors->first('priority') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!--Contact-->
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    {!! Form::label('contact','Contact Number*',['class'=>'col-md-4 control-label']) !!}

                    <div class="col-md-6">
                        {!! Form::text('contact',null,['class' =>'form-control']) !!}
                        <span><small>ex : 05xxxxxxxx</small></span>

                        @if ($errors->has('contact'))
                            <span class="help-block">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!--Notes-->
                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    {!! Form::label('notes','Notes',['class'=>'col-md-4 control-label' ]) !!}

                    <div class="col-md-6">
                        {!! Form::textarea('notes',null,['class'=>'form-control' ,'rows'=>2]) !!}
                        @if ($errors->has('notes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('notes') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Submit-->
                <div class="form-group">
                    @if(count($types))
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-send"></i> Send
                            </button>
                        </div>
                    @endif
                </div>

                {{--<input type="text" id="priority" name="priority" value="" />--}}

                </form>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('theme/plugins/ionslider/ion.rangeSlider.min.js')}}"></script>
    <script>
        $("#priority").ionRangeSlider({
            type: "single",
            grid: true,
            min: 1,
            max: 4,
        from: {{old('priority')?old('priority'): 1}},
            step: 1,
            keyboard: true,
            onStart: function (data) {
                console.log('mines')
            },
            onChange: function (data) {
                switch (data.fromNumber) {
                    case 1 :
                        $('.changeable').text('Regular - 72 hrs');
                        break;
                    case 2 :
                        $('.changeable').text('Important - 48 hrs');
                        break;
                    case 3 :
                        $('.changeable').text('Urgent - 24 hrs');
                        break;
                    case 4 :
                        $('.changeable').text('Crisis - ASAP');
                        break;
                    default :
                        $('.changeable').text('Regular - 72 hrs');
                        break;
                }
            },
        });
    </script>
@stop