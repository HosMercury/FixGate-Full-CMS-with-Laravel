<div class="box-header with-border">
    <h2 class="box-title">Work Order #{{$order->id}} -Details</h2>
</div>

<div class="box-body">
    <table class="table table-bordered table-responsive">
        <tr class="list-group-item-success">
            <th><strong>Order No </strong> : {{$order->id}}</th>
            <th><i class="fa fa-fw fa-clock-o"></i><strong>Date </strong> : {{$order->created_at}}</th>
            <th><strong>Type </strong> : {{$order->trade}}</th>
        </tr>
        <tr class="list-group-item-success">
            <th><strong>Location </strong> : {{$order->location_id}}</th>
            <th><strong>Priority </strong> : {{$order->priority}}</th>
            <th><i class="fa fa-fw fa-mobile"></i>{{$order->contact}}</th>
        </tr>
        <tr class=""><strong>Title </strong> : {{$order->title}}</tr>

        <tr class=""><h5><strong>Description </strong> : {!!nl2br($order->description)!!}</h5></tr>

        <tr class=""><h5><strong>Notes </strong> : {!! $order->notes ? nl2br($order->notes):'' !!}</h5></tr>
    </table>