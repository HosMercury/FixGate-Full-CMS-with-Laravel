{!! csrf_field() !!}
<!--Title-->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Name*</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="name" value="@if(old('name')) {{old('name')}} @elseif(isset($type)) {{trim($type->name)}} @endif">

        @if ($errors->has('name'))
            <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<!--Description-->
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <textarea class="form-control" name="description">@if(old('name')) {{old('description')}} @elseif(isset($type)) {{trim($type->description)}} @endif</textarea>
        @if ($errors->has('description'))
            <span class="help-block">
                 <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<!--Submit-->
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-send"></i> Send
        </button>
    </div>
</div>