<html>
@include('theme.partials.metas')
<body class="layout-top-nav skin-blue-light">
<div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper" style="min-height: 375px;">
        <br>
        <div class="text-center" style="font-size: 1.7em;color: #3c8dbc">
            @include('theme.partials.logo')
        </div>

        <div class="container">

            <!-- Content Header (Page header) -->
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
</body>
</html>