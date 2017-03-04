<legend>User Roles</legend>
@if(count($user->roles))
    <p>This user has these roles :</p>

    <ul>
        @foreach($user->roles as $role)
            <li>
                <form method="post" action="/users/{{$user->id}}/roles/{{$role->id}}">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    <label>{{$role->name}}</label>
                    <button type="submit" class="btn btn-xs btn-danger"> <i class="fa fa-fw fa-remove ">  </i></button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>This user has No roles Assigned</p>
@endif
<button class="btn btn-reddit btn-xs assign-btn">Assign {{count($user->roles)?'more':''}} roles to the user
                            <span class="arrows">
                                <span class="fa fa-caret-down"> </span>
                                <span class="fa fa-caret-up"> </span>
                            </span>
</button>

<div class="assign-frm" style="display: {{!count($errors) ?'none':''}}">
    @if(count($roles))
        <p>
            <small class="small-box">Use with very care</small>
        </p>

        <form method="post" class="form-group" action="/users/{{$user->id}}/roles/">
            <!--Priority-->
            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                {!! csrf_field() !!}
                <label class="col-md-1 control-label">Role*</label>

                <div class="col-md-4">
                    <select class="form-control" name="role">
                        <option value="" disabled selected>
                            Select
                        </option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                             <strong>{{$errors->first('role') }}</strong>
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
        There is No roles to Assign , Please
    @endif
    <a href="/roles/create" class="link-black btn-link">Add {{$roles?"more":''}} role(s)</a>

</div>
<br><br>