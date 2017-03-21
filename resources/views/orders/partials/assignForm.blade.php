{{csrf_field()}}
<div class="form-group {{ $errors->has($add.'workers') ? ' has-error' : '' }}">
    {!! Form::label($label) !!}

    <select name="{{$add}}workers[]"
    class="js-example-basic-multiple pull-right"
    multiple="multiple" style="width:100%;"
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

</select>
<br><br>
<div class="form-group">
    <input type="text"  name="vendor" class="form-control"  placeholder="Or assign to external vendor ">
</div>
<div class="assigner">
    {!! Form::submit($assign,['name'=>'submit','class'=>'btn btn-success btn-md pull-right col-md-1']) !!}
</div>

@if ($errors->has($add.'workers'))
<span class="help-block">
   <strong>{{ $errors->first($add.'workers')}}</strong>
</span>
@endif
</div>

{!! Form::close() !!}