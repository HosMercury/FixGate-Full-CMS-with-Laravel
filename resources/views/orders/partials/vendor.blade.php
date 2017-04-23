<div style="margin-top: 4em; border-top: solid thin #EEEEEE;">
    <h5><strong>Or/And Assign to external vendor</strong></h5>

    <form method="post" action="/{{$order->path()}}/assignments/vendor">
        {{csrf_field()}}
        <div class="form-group  {{ $errors->has('vendor') ? ' has-error' : '' }}" style="margin-top: 1.5em;">
            <input type="text" name="vendor" class="form-control">
            @if ($errors->has('vendor'))
                <span class=" help-block ">
                    <strong>{{ $errors->first('vendor')}}</strong>
                </span>
            @endif
        </div>

        @include('orders.partials.within_last_assignment')

        <button type="submit" class="btn btn-success pull-right">Assign vendor</button>
    </form>
</div>