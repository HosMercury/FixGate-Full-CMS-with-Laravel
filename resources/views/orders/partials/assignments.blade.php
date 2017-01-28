{{--{{dd($assigns->flatten())}}--}}
        <!-- Assignments -->
<!-- if not Assigned nor ReAssigned -->
<div class="box-header with-border">
    <h2 class="box-title" id="assignments"><i class="fa fa-fw fa-hourglass-start"></i> Assignments</h2>
</div>
<div class="box-body">
    {{-- if count assigns <h> assigns history--}}
    {{--New Order--}}
    {{--{{dd($assigns->toArray())}}--}}
    @if(! $assigns->isEmpty())
        <ol>
            @foreach($assigns as $index=>$assign)
                <h4>Assignment Number : ({{$index}})
                    {{--detect the laST assign --}}
                    @if($index === count($assigns))
                        <a class="btn btn-info btn-xs edit-assignment" href="">edit</a>
                    @endif
                </h4>
                <ol class="col-md-12">
                    @foreach($assign as $assign)
                        <li class="col-md-4">
                            <form method="post" class="" action="">
                                {{csrf_field()}}{{method_field('DELETE')}}
                                <label>{{$assign->name}} (#{{ $assign->id }})</label>
                                <button type="submit" class="btn btn-xs btn-danger delete-assignment hidden"><i
                                            class="fa fa-fw fa-remove "> </i>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ol>
            @endforeach
        </ol>
    @endif


    @if(empty($status))
    @elseif($status > 0)
    @endif
    {{--If Assigned --}}
    {{--@elseif($status > 0)--}}
    {{--<p><strong>Assigned at : </strong>--}}
    {{--<i class="fa fa-fw fa-clock-o"></i>--}}
    {{--<small>{{$assignment->created_at}}</small>--}}
    {{--</p><p><strong>to :</strong></p>--}}

    {{--@include('orders.partials.workers',['status'=>'Assigned'])--}}
    {{--<hr>--}}

    {{--Assign Edit--}}
    {{--<br>--}}
    {{--<form action="/orders/{{$order->id}}/assign/{{$assignment->id}}"--}}
    {{--method="post" class="editForm"--}}
    {{--style="display:none;"--}}
    {{--onsubmit="return confirm('Do you really want to delete your assignment?');">--}}
    {{--{{csrf_field()}}{{ method_field('DELETE') }}--}}
    {{--<button type="submit" class="btn btn-danger btn-sm pull-right">X</button>--}}
    {{--</form>--}}

    {{--<form action="/orders/{{$order->id}}/assign/{{$assignment->id}}"--}}
    {{--method="post" class="editForm clearfix"--}}
    {{--style="display:none;">--}}
    {{--{{ method_field('PATCH') }}--}}
    {{--@include('orders.partials.assignForm', ['submit' => 'Update'])--}}
    {{--</form>--}}
    {{--2b sure it is not reassigned --}}
    {{--@if($assignment->status !=='Reassigned')--}}
    {{--<a class="btn btn-default btn-sm pull-left edit">Edit</a>--}}
    {{--<a class="btn btn-info btn-sm pull-right reassign">Reassign</a>--}}
    {{--@endif--}}

    {{--<form action="/orders/{{$order->id}}/reassign/" method="post" class="reassignForm"--}}
    {{--style="display:none;">--}}
    {{--<h4>Reassignment :</h4>--}}

    {{--<div class="form-group">--}}
    {{--<label class="control-label">Reason For Reassignment :</label>--}}
    {{--<small> So,Why first assignment failed ?</small>--}}
    {{--<textarea name="reason" class="form-control col-xs-12 reason" rows="2"></textarea>--}}
    {{--</div>--}}
    {{--<br><br>--}}
    {{--@include('orders.partials.assignForm', ['submit' => 'Reassign'])--}}
    {{--</form>--}}

    {{--ReAssignments --}}
    {{--@if( $assignment->status == 'Reassigned' )--}}
    {{--<div class="row col-xs-12">--}}
    {{--<hr>--}}
    {{--<p><strong>Then Reassigned at : </strong>--}}
    {{--<i class="fa fa-fw fa-clock-o"></i>{{$assignment->created_at}}--}}
    {{--</p>--}}

    {{--<p><strong>Reason</strong> : {{$assignment->reason or ""}}</p>--}}

    {{--<p><strong>to :</strong></p>--}}

    {{--@include('orders.partials.workers',['status'=>'Reassigned'])--}}

    {{--<form action="/orders/{{$order->id}}/reassign/{{$assignment->id}}" method="post"--}}
    {{--class="editForm2 clearfix"--}}
    {{--style="display:none;"--}}
    {{--onsubmit="return confirm('Do you really want to delete your reassignment?');">--}}
    {{--{{csrf_field()}}{{ method_field('DELETE') }}--}}
    {{--<button type="submit" class="btn btn-danger btn-sm pull-right">X</button>--}}
    {{--</form>--}}

    {{--<form action="/orders/{{$order->id}}/reassign/{{$assignment->id}}" method="post"--}}
    {{--class="editForm2"--}}
    {{--style="display:none;">--}}
    {{--{{ method_field('PATCH') }}--}}
    {{--@include('orders.partials.assignForm', ['submit' => 'Update'])--}}
    {{--</form>--}}
    {{--<a class="btn btn-default btn-sm pull-left edit2">Edit</a>--}}
    {{--@endif--}}

    {{--@else {{dd('Error...please contact admins err:922')}}--}}
    {{--</div>--}}
    {{--@endif--}}
    @include('orders.partials.assignForm')
</div>