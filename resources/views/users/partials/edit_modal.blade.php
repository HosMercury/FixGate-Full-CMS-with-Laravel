<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit User ( {{$user->name}} )</h4>
                </div>
                <div class="modal-body">
        @if (count($errors) > 0 and $errors->has('location_id') or $errors->has('name'))
        @include('common.errors')
        @endif

                    <form method="post" action="/users/{{$user->employee_id}}">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name" class="control-label">Name *:</label>
                            <input type="text" class="form-control" id="name" name="name"
                            value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Location * :</label>
                            <input type="text" class="form-control" id="location_id" name="location_id"
                            value="{{$user->location_id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-success pull-right">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>