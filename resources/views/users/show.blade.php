@extends('theme.index')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <br>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User #{{$user->id}}</h3>
                    <a href="/auth/register" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-fw fa-plus"></i> Register New user</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-11 box box-widget">
                        <h3>{{$user->name}}</h3>
                        <p>#{{$user->id}} - email : {{$user->email}}</p>
                        @include('users.partials.roles')
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@section('scripts')
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