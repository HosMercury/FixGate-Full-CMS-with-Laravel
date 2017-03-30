<div style="margin-top: 4em; border-top: solid thin #EEEEEE;">
    <h5><strong>Or/And Assign to external vendor</strong></h5>

    <form method="post" action="/orders/{{$order->id}}/assignments/vendor">
        {{csrf_field()}}
        <div class="form-group  {{ $errors->has('vendor') ? ' has-error' : '' }}" style="margin-top: 1.5em;">
            <input type="text" name="vendor" class="form-control">
            @if ($errors->has('vendor'))
                <span class=" help-block ">
                    <strong>{{ $errors->first('vendor')}}</strong>
                </span>
            @endif
        </div>


        <div class="checkbox form-group   {{ $errors->has('last_assignment') ? ' has-error' : '' }}">
            <label><input type="checkbox" name="last_assignment" value="1"> Within the last assignment</label>
            @if ($errors->has('last_assignment'))
                <span class=" help-block ">
                     <strong>{{ $errors->first('last_assignment')}}</strong>
                 </span>
            @endif
        </div>

        <button type="submit" class="btn btn-success pull-right">Assign vendor</button>
    </form>
</div>