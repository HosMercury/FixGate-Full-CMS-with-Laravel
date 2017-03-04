<div class="box-header with-border">
    <h2 class="box-title"><i class="fa fa-fw fa-reorder"></i> Work Order # {{$order->number}}</h2>
    @if(!$closed)
        <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal"
                data-target="#rateModal">
            <i class="fa fa-fw fa-check"></i> Close
        </button>
    @endif
</div>
<div class="box-body">
    <table class="table table-bordered table-responsive">
        <tr class="list-group-item-info">
            <th><strong>No </strong>: {{$order->number}}</th>
            <th><i class="fa fa-fw fa-mobile"></i>{{$order->contact}}</th>
        </tr>
        <tr class="list-group-item-info">
            <th><strong>Type </strong>: {{$order->type}}</th>
            <th><i class="fa fa-fw fa-clock-o"></i><strong>Date </strong>: {{$order->created_at}}</th>
        </tr>
        <tr class="list-group-item-info">
            <th><strong>Location </strong>: {{$order->location_id}}</th>
            <th><strong>Priority </strong>: {{$order->priority}}</th>
        </tr>
        <tr class=""><strong>Title </strong>: {{$order->title}}</tr>

        <tr class=""><h5><strong>Description </strong>: {!!nl2br($order->description)!!}</h5></tr>

        <tr class=""><h5><strong>Notes </strong>: {!! $order->notes ? nl2br($order->notes):'No Notes' !!}</h5></tr>
    </table>