@extends('theme.index')
@section('title') Show User @stop
<link rel="stylesheet" href="{{asset('theme/plugins/iCheck/square/blue.css')}}">
<style type="text/css">
    .icheckbox_square-blue {
        margin-right: 25px;
    }
</style>
@section('bread-header') Show User @stop
@section('bread-small'){{$user->name}} @stop
@section('breadcrumb')
    <li class="active">
        <a href="/users">Users</a>
    <li class="active"><a href="users/{{$user->employee_id}}">{{$user->name}}</a></li>
    </li>
@stop

@section('content')
    @if (count($errors) > 0 )
        @include('common.errors')
    @endif
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

                    <div class="col-xs-11 box box-widget">
                        <h3><strong>Name : </strong>{{$user->name}}</h3>
                        <hr>
                        <p><strong>Email : </strong>{{$user->email or 'something went wrong'}}</p>

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
                    @if(auth()->user()->isSuperadmin())
                        @include('users.partials.roles')
                    @endif
                </div>

                <!-- Modal -->
                @include('users.partials.edit_modal')
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@stop

@section('scripts')
    @if (count($errors) > 0 and $errors->has('location_id') or $errors->has('name'))
        <script>
            $('#editModal').modal('show');
        </script>
    @endif
    <script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@stop