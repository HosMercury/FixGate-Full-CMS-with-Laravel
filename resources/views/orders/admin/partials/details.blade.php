<table class="table table-bordered table-responsive">
    <tr class="list-group-item-success">
        <th><strong>Order No </strong> : {{$id}}</th>
        <th><i class="fa fa-fw fa-clock-o"></i><strong>Date </strong> : {{$created_at}}</th>
    </tr>
    <tr class="list-group-item-success">
        <th><strong>Trade </strong> : {{$trade}}</th>
        <th><strong>Priority </strong> : {{$priority}}
        &nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-fw fa-mobile"></i>{{$contact}}</th>
    </tr>
    <tr class=""><strong>Title </strong> : {{$title}}</tr>

    <tr class=""><h5><strong>Description </strong> : {!!nl2br($description)!!}</h5></tr>

    @if($notes != null)
        <tr class=""><h5><strong>Notes </strong> : {!! nl2br($notes) !!}</h5></tr>
    @endif
</table>