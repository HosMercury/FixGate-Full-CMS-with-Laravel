<legend>Role Permissions</legend>
@if(count($role->permissions))
    <p>This role has these permissions :</p>
    <ul>
        @foreach($role->permissions as $permission)
            <li>
                <form method="post" action="/roles/{{$role->id}}/permissions/{{$permission->id}}">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    <label>{{$permission->name}}</label>
                    <button type="submit" class="btn btn-xs btn-danger"> <i class="fa fa-fw fa-remove ">  </i></button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>This Role has No permissions Added</p>
@endif
<button class="btn btn-reddit btn-xs assign-btn-permissions">Assign {{count($role->permissions)?'more':''}} permissions to the role
            <span class="arrows-permissions">
                <span class="fa fa-caret-down"> </span>
                <span class="fa fa-caret-up"> </span>
            </span>
</button>

<div class="assign-frm-permissions" style="display: {{!count($errors) ?'none':''}}">
    @if(count($permissions))
        <p>
            <small class="small-box">Use with very care</small>
        </p>

        <form method="post" class="form-group" action="/roles/{{$role->id}}/permissions/">
            <!--Priority-->
            <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                {!! csrf_field() !!}
                <label class="col-md-2 control-label">permission*</label>

                <div class="col-md-4">
                    <select class="form-control" name="permission">
                        <option value="" disabled selected>
                            Select
                        </option>
                        @foreach($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('permission'))
                        <span class="help-block">
                            <strong>{{$errors->first('permission') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!--Submit-->
            <div class="form-group container">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-btn fa-send"></i> Send
                    </button>
                </div>
            </div>
        </form>
    @else
        There is No permissions to Assign , Please
    @endif
    <a href="/permissions/create" class="link-black btn-link">Add {{$permissions?"more":''}} permission(s)</a>

</div>
<br><br>