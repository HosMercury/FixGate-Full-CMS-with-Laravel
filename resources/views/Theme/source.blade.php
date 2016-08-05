<html>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
@include('theme.partials.head')
@section('orders_active')
    class = "active"
@stop
<body class="layout-top-nav skin-red">
<div class="wrapper">

    @include('theme.partials.header')
            <!-- Full Width Column -->
    <div class="content-wrapper" style="min-height: 375px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            @include('theme.partials.contentheader')

                    <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    @include('theme.partials.footer')

</div>
<!-- ./wrapper -->
@include('theme.partials.footerscripts')
</body>
</html>