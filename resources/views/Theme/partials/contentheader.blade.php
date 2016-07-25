<!--<section class="content-header">
    <h1>
        Top Navigation
        <small>Example 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Top Navigation</li>
    </ol>
</section>-->
<br>
@if(Session::has('message'))
    <p class="alert {{ Session::get('alert', 'alert-success') }}">{{ Session::get('message') }}</p>
@endif
@include('common.errors')
