<div class="flash">
    @if(Session::has('success'))
        <br><p class="alert {{ Session::get('alert', 'alert-success') }}">{{ Session::get('success') }}</p>
    @elseif(Session::has('alert'))
        <br><p class="alert alert-warning">{{ Session::get('alert') }}</p>
    @elseif(Session::has('danger'))
        <br><p class="alert alert-danger">{{ Session::get('danger') }}</p>
    @endif
</div>

