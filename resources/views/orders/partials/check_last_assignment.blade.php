@if($assigns_max >1)
    <div class="checkbox form-group   {{ $errors->has('last_assignment') ? ' has-error' : '' }}">
        <label><input type="checkbox" name="last_assignment" value="1"> Within the last assignment</label>
        @if ($errors->has('last_assignment'))
            <span class=" help-block ">
              <strong>{{ $errors->first('last_assignment')}}</strong>
        </span>
        @endif
    </div>
@endif