@extends('theme.index')
@section('title') Show Type @stop
@section('bread-header') Show Type @stop
@section('bread-small'){{$type->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/types">Maintainance Type</a>
    <li class="active"><a href="/types/{{$type->id}}">{{$type->name}}</a></li>
    </li>
@stop

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Type #{{$type->id}}</h3>
                    <a href="/types/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Type</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        <h3><strong>Type : </strong> {{$type->name}}</h3>
                        <hr>
                        <p><strong>Creator :</strong> {{$type->creator or 'not defined'}}</p>
                        <p><strong>Created at :</strong> {{$type->created_at or 'not defined'}}</p>
                        <p><strong>Description :</strong> {{$type->description or 'not defined'}}</p>
                    </div>
                    <a href="/types/{{$type->id}}/edit" class="btn btn-info btn-sm" >Edit Type</a>
                    <form action="/types/{{$type->id}}" method="POST"
                          onsubmit="return confirm('are you sure, you want to delete !?');"
                          style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('Delete')}}
                        <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Type</button>
                    </form>
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop