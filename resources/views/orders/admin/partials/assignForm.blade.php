<h5><strong>Choose :</strong></h5>
{{csrf_field()}}
<input type="hidden" name="order_id" value="{{$order->id}}">
<div class="row">
    <div class="form-group col-sm-4">
        <label class="control-label">Technician(s)</label>

        <div class="">
            <select name="worker[]" class="form-control" multiple>
                @foreach($workers as $worker)
                    @if($worker->role == 'technician')
                        <option value="{{$worker->id}}">{{$worker->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-sm-4">
        <label class="control-label">Labor(s)</label>

        <div class="">
            <select name="worker[]" class="form-control" multiple>
                @foreach($workers as $worker)
                    @if($worker->role == 'labor')
                        <option value="{{$worker->id}}">{{$worker->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-sm-4">
        <label class="control-label">External Vendor(s)</label>

        <div class="">
            <select name="worker[]" class="form-control" multiple>
                @foreach($workers as $worker)
                    @if($worker->role == 'external')
                        <option value="{{$worker->id}}">{{$worker->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<p>
    <small>Note: You can choose Multiple and/or various workers as needed</small>
</p>
<div class="form-group">
    <button type="reset" class="btn btn-default btn-xs">Clear</button>
</div>

<div class="form-group">
    {!! Form::submit($submit,['name'=>'submit','class'=>'btn btn-success pull-right btn-sm']) !!}
</div>