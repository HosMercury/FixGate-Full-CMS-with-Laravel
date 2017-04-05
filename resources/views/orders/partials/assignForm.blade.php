{{csrf_field()}}
<div class="form-group {{ $errors->has('workers') ? ' has-error' : '' }}">
    {!! Form::label('Add internal orkers') !!}

    <select name="workers[]"
            class="js-example-basic-multiple pull-right"
            multiple="multiple" style="width:100%;">

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

    @include('orders.partials.check_last_assignment')

    <div class="assigner">
        {!! Form::submit($assign,['name'=>'submit','class'=>'btn btn-success btn-md pull-right col-md-1']) !!}
    </div>


    @if ($errors->has('workers'))
        <span class="help-block">
            <strong>{{$errors->first('workers')}}</strong>
        </span>
    @endif
</div>

{!! Form::close() !!}