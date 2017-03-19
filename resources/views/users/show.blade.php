@extends('theme.index')
@section('title') Show User @stop
@section('bread-header') Show User @stop
@section('bread-small'){{$user->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/users">Users</a>
    <li class="active"><a href="/roles/{{$user->id}}">{{$user->name}}</a></li>
    </li>
@stop
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User #{{$user->employee_id}}</h3>
                    <a href="/auth/register" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> Register New user</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @include('users.partials.related')

                    <div class="col-xs-11 box box-widget">
                        <h3><strong>Name : </strong>{{$user->name}}</h3>
                        <hr>
                        <p><strong>Email : </strong>{{$user->email or 'Missing'}}</p>

                        <p><strong>Location id : </strong>{{$user->location_id or 'not defined'}}</p>

                        <p><strong>Created at : </strong>{{$user->created_at or 'missing date'}}</p>
                    </div>


                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal">
                    Edit User
                </button>

                <form action="/users/{{$user->employee_id}}" method="POST"
                      onsubmit="return confirm('are you sure, you want to delete !?');"
                      style="display: inline;">
                    {{csrf_field()}}
                    {{method_field('Delete')}}
                    <button type="submit" class="btn btn-sm btn-danger pull-right">Delete User</button>
                </form>
                <hr>
                @include('users.partials.roles')
            </div>

                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit User ( {{$user->name}} )</h4>
                            </div>
                            <div class="modal-body">
                                @include('common.errors')

                                <form method="post" action="/users/{{$user->employee_id}}">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name *:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$user->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label">Location * :</label>
                                        <input type="text" class="form-control" id="location_id" name="location_id"
                                               value="{{$user->location_id}}">
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

            </div> <!-- /.box-body -->
        </div>
    </div>
@stop

@section('scripts')
    @if (count($errors) > 0)
        <script>
            $('#editModal').modal('show');
        </script>
    @endif
    <script>
        $(document).ready(function () {
            //roles
            $('.arrows').hide();
            $('.fa-caret-down').hide();
            $('.fa-caret-up').show();

            $('.assign-btn').on('click', function () {
                $('.arrows').show();
                $('.fa-caret-down').toggle();
                $('.fa-caret-up').toggle();
                $('.assign-frm').slideToggle();
            })

            //permissions
            $('.arrows-permissions').hide();
            $('.fa-caret-down').hide();
            $('.fa-caret-up').show();

            $('.assign-btn-permissions').on('click', function () {
                $('.arrows-permissions').show();
                $('.fa-caret-down').toggle();
                $('.fa-caret-up').toggle();
                $('.assign-frm-permissions').slideToggle();
            })
        });
    </script>
@stop