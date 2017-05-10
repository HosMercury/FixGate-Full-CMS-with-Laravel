<html>
@include('theme.partials.metas')
<body class="layout-top-nav skin-blue-light">
<div class="wrapper">
    @include('theme.partials.header')
            <!-- Full Width Column -->
    <div class="content-wrapper" style="min-height: 375px;">

        @if(auth()->check())
            @include('theme.partials.horizontal-nav')
        @endif

        <div class="">
            <!-- Content Header (Page header) -->
            @if(auth()->check())
                @include('theme.partials.flash')
                @include('theme.partials.breadcrumb')
            @endif
            <br>
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