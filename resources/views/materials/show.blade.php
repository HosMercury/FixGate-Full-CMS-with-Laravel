@extends('theme.index')
@section('title') Show {{ucfirst($material->type)}} @stop
@section('bread-header') Show {{ucfirst($material->type)}} @stop
@section('bread-small'){{$material->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/materials">Materials & Assets</a>
    <li class="active"><a href="/materials/{{$material->id}}">{{$material->name}}</a></li>
    </li>
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ucfirst($material->type)}} #{{$material->id}}</h3>
                    <a href="/materials/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Material</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        <h3><strong>{{ucfirst($material->type)}} Name :</strong> {{$material->name}}</h3>
                        <hr>
                        <p><strong>Type :</strong> {{ucfirst($material->type) or 'not defined'}}</p>
                        <p><strong>Creator :</strong> {{$material->creator or 'not defined'}}</p>
                        <p><strong>Created at :</strong> {{$material->created_at or 'not defined'}}</p>
                        <p><strong>Description :</strong> {{$material->description or 'not defined'}}</p>
                        <p><strong>Location :</strong> {{$material->location or 'not defined'}}</p>
                        <p><strong>Sub Location :</strong> {{$material->sub_location or 'not defined'}}</p>
                        <hr>
                        <p><strong>Width :</strong> {{$material->width or 'not defined'}}</p>
                        <p><strong>Height :</strong> {{$material->height or 'not defined'}}</p>
                        <p><strong>Price :</strong> {{$material->price or 'not defined'}}</p>
                        <p><strong>Qty :</strong> {{$material->soh or 'not defined'}}</p>
                        <p><strong>Barcode :</strong> {{$material->barcode or 'not defined'}}</p>
                        <p><strong>Manufacturer :</strong> {{$material->manufacturer or 'not defined'}}</p>
                    </div>
                    <a href="/materials/{{$material->id}}/edit" class="btn btn-info btn-sm" >Edit Material</a>
                    <form action="/materials/{{$material->id}}" method="POST"
                          onsubmit="return confirm('are you sure, you want to delete !?');"
                          style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('Delete')}}
                        <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Material</button>
                    </form>
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop