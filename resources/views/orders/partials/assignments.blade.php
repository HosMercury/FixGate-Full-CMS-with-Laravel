<!-- Assignments -->
<!-- if not Assigned nor ReAssigned -->
<div class="box-header with-border">
    <h2 class="box-title">Assignments</h2>
</div>
<div class="box-body">
    {{--New Order--}}
    @if(!(in_array($assignment->status,['Assigned','Reassigned','Closed'])))
        <form action="/orders/{{$order->id}}/assign/" method="POST">
            @include('orders.partials.assignForm', ['submit' => 'Assign'])
        </form>
        {{--If Assigned Or reAssigned--}}
    @elseif( in_array( $assignment->status,['Assigned','Reassigned']))
        <p><strong>Assigned at : </strong>
            <i class="fa fa-fw fa-clock-o"></i>
            <small>{{$assignment->created_at}}</small>
        </p><p><strong>to :</strong></p>

        @include('orders.partials.workers',['status'=>'Assigned'])
        <hr>

        {{--Assign Edit--}}
        <br>
        <form action="/orders/{{$order->id}}/assign/{{$assignment->id}}"
              method="post" class="editForm"
              style="display:none;"
              onsubmit="return confirm('Do you really want to delete your assignment?');">
            {{csrf_field()}}{{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger btn-sm pull-right">X</button>
        </form>

        <form action="/orders/{{$order->id}}/assign/{{$assignment->id}}"
              method="post" class="editForm clearfix"
              style="display:none;">
            {{ method_field('PATCH') }}
            @include('orders.partials.assignForm', ['submit' => 'Update'])
        </form>
        {{--2b sure it is not reassigned --}}
        @if($assignment->status !=='Reassigned')
            <a class="btn btn-default btn-sm pull-left edit">Edit</a>
            <a class="btn btn-info btn-sm pull-right reassign">Reassign</a>
        @endif

        <form action="/orders/{{$order->id}}/reassign/" method="post" class="reassignForm"
              style="display:none;">
            <h4>Reassignment :</h4>

            <div class="form-group">
                <label class="control-label">Reason For Reassignment :</label>
                <small> So,Why first assignment failed ?</small>
                <textarea name="reason" class="form-control col-xs-12 reason" rows="2"></textarea>
            </div>
            <br><br>
            @include('orders.partials.assignForm', ['submit' => 'Reassign'])
        </form>

        {{--ReAssignments --}}
        @if( $assignment->status == 'Reassigned' )
            <div class="row col-xs-12">
                <hr>
                <p><strong>Then Reassigned at : </strong>
                    <i class="fa fa-fw fa-clock-o"></i>{{$assignment->created_at}}
                </p>

                <p><strong>Reason</strong> : {{$assignment->reason or ""}}</p>

                <p><strong>to :</strong></p>

                @include('orders.partials.workers',['status'=>'Reassigned'])

                <form action="/orders/{{$order->id}}/reassign/{{$assignment->id}}" method="post"
                      class="editForm2 clearfix"
                      style="display:none;"
                      onsubmit="return confirm('Do you really want to delete your reassignment?');">
                    {{csrf_field()}}{{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm pull-right">X</button>
                </form>

                <form action="/orders/{{$order->id}}/reassign/{{$assignment->id}}" method="post"
                      class="editForm2"
                      style="display:none;">
                    {{ method_field('PATCH') }}
                    @include('orders.partials.assignForm', ['submit' => 'Update'])
                </form>
                <a class="btn btn-default btn-sm pull-left edit2">Edit</a>
                @endif

                @else {{dd('Error...please contact admins err:922')}}
            </div>
        @endif
</div>