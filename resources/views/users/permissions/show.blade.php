@extends('theme.index')
@section('title') Show Permission @stop
@section('bread-header') Show Permission @stop
@section('bread-small'){{$permission->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/permissions">Permissions</a>
    <li class="active"><a href="/permissions/{{$permission->id}}">{{$permission->name}}</a></li>
    </li>
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Permission #{{$permission->id}}</h3>
                    <a href="/permissions/create" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> New Permission</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @include('users.partials.related')
                    <div class="col-xs-11 box box-widget">
                        <h3><strong>Permission Name :</strong> {{$permission->name}}</h3>
                        <hr>
                        <p><strong>Label : </strong>{{$permission->label or 'No label'}}</p>

                        <p><strong>Creator :</strong> {{$permission->creator or 'not defined'}}</p>

                        <p><strong>Created at :</strong> {{$permission->created_at or 'no date'}}</p>
                    </div>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal">
                        Edit Permission
                    </button>
                    <form action="/permissions/{{$permission->id}}" method="POST"
                          onsubmit="return confirm('are you sure, you want to delete !?');"
                          style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('Delete')}}
                        <button type="submit" class="btn btn-sm btn-danger pull-right">Delete Permission</button>
                    </form>

                </div>

                <!-- Modal -->
                <div class="modal fade in" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Permission ( {{$permission->name}} )</h4>
                            </div>
                            <div class="modal-body">
                                @include('common.errors')

                                <form method="post" action="{{$permission->id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name *:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$permission->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="control-label">Label:</label>
                                        <textarea type="text" class="form-control" name="label"
                                                  id="label">{{$permission->label}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-success">Save changes</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('users.roles.partials.scripts')
    @if (count($errors) > 0)
        <script>
            $('#editModal').modal('show');
        </script>
    @endif
@stop