{!!Form::open(['url' => "/orders/$order->id/assign/", 'method'=>'POST',$order->id])!!}
{{csrf_field()}}
<div class="form-group {{ $errors->has('workers') ? ' has-error' : '' }}">
    {!! Form::label('Assign To : ') !!}
    <select name="workers[]"
            class="js-example-basic-multiple pull-right"
            multiple="multiple" style="width: 82%;"
    >

        @if(count($labors))
            <optgroup label="Labors">
                @foreach($labors as $name=>$id)
                    <option class="form-control text-blue" value="{{$id}}">{{$name}}</option>
                @endforeach
            </optgroup>
        @endif

        @if(count($techs))
            <optgroup label="Technicians">
                @foreach($techs as $name=>$id)
                    <option class="form-control text-blue" value="{{$id}}">{{$name}}</option>
                @endforeach
            </optgroup>
        @endif

        @if(count($vendors))
            <optgroup label="Vendors">
                @foreach($labors as $name=>$id)
                    <option class="form-control text-blue" value="{{$id}}">{{$name}}</option>
                @endforeach
            </optgroup>
        @endif
    </select>
    {!! Form::submit('Assign',['name'=>'submit','class'=>'btn btn-success btn-md pull-right col-md-1 assigner']) !!}

    @if ($errors->has('workers'))
        <span class="help-block">
                 <strong>{{ $errors->first('workers') }}</strong>
            </span>
    @endif
</div>
{{--<div class="form-group col-sm-4">--}}
{{--<label class="control-label">Technician(s)</label>--}}

{{--<div class="">--}}
{{--<select name="worker[]" class="form-control" multiple>--}}
{{--@foreach($workers as $worker)--}}
{{--@foreach($worker->roles as $role)--}}
{{--@if($role->name == 'labor')--}}
{{--<option value="{{$worker->id}}">{{$worker->name}}</option>--}}
{{--@elseif($role->name == 'technician')--}}
{{--<option value="{{$worker->id}}">{{$worker->name}}</option>--}}
{{--@elseif($role->name == 'vendor')--}}
{{--<option value="{{$worker->id}}">{{$worker->name}}</option>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group col-sm-4">--}}
{{--<label class="control-label">Labor(s)</label>--}}

{{--<div class="">--}}
{{--<select name="worker[]" class="form-control" multiple>--}}
{{--@foreach($workers as $worker)--}}
{{--@if($$worker->pivot->name == 'labor')--}}
{{--<option value="{{$worker->id}}">{{$worker->name}}</option>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group col-sm-4">--}}
{{--<label class="control-label">External Vendor(s)</label>--}}

{{--<div class="">--}}
{{--<select name="worker[]" class="form-control" multiple>--}}
{{--@foreach($workers as $worker)--}}

{{--@if($worker->pivot->name == 'external')--}}
{{--<option value="{{$worker->id}}">{{$worker->name}}</option>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}

{{--<p>--}}
{{--<small>Note: You can choose Multiple and/or various workers as needed</small>--}}
{{--</p>--}}
{{--<div class="form-group">--}}
{{--<button type="reset" class="btn btn-default btn-xs">Clear</button>--}}
{{--</div>--}}

{{--<div class="form-group pull-right form-inline">--}}
{{--</div>--}}
{!! Form::close() !!}
