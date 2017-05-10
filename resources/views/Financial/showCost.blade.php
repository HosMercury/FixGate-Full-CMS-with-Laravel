@extends('theme.index')
@section('title') Finantial Receipt @stop
@section('bread-header') Spent Costs  @stop
@section('bread-small')Costs for order #{{$order->id}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/financial">financial</a>
    <li class="active"><a href="/financial/order/{{$order->id}}/costs">costs</a></li>
    </li>
@stop
<link type="text/css" rel="stylesheet" href="{{asset('theme/plugins/lity/dist/lity.min.css')}}"/>
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Costs Receipt for Order #<a href="/orders/{{$order->id}}">{{$order->id}}</a>
                    </h3>
                    {{--<a href="/Financials/create" class="btn btn-sm btn-success pull-right">--}}
                    {{--<i class="fa fa-fw fa-plus"></i> New Cost</a>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        @foreach($costs as $cost)
                            <div class="col-sm-6 border-left">
                                <h3><strong>Cost Description :</strong> {{$cost->description}}</h3>
                                <hr>
                                <p><strong>Description :</strong> {{$cost->description or 'not defined'}}</p>

                                <p><strong>Creator :</strong> {{$cost->creator or 'not defined'}}</p>

                                <p><strong>Created at :</strong> {{$cost->created_at or 'not defined'}}</p>

                                <p><strong>Cost :</strong> <strong>{{$cost->cost or 'not defined'}}</strong></p>
                            </div>

                        @endforeach
                        <div class="col-xs-12" style="border: solid thin grey;margin: auto">
                            @foreach($thumbs as $thumb)
                                <div class="col-md-3 col-sm-6" style="margin: 10px;">
                                    <a href="/bills/{{substr($thumb->name,3)}}"
                                       data-lity data-lity-target="/bills/{{substr($thumb->name,3)}}">
                                        <img src="/bills/{{$thumb->name}}"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('theme/plugins/lity/dist/lity.min.js')}}"></script>
@stop