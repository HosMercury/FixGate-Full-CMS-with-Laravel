<div class="box-header with-border">
    <h2 class="box-title"><i class="fa fa-fw fa-reorder"></i> Work Order # {{$order->number}}</h2>
    @unless(auth()->user()->fromTitles())
        @if(!$closed)
            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal"
                    data-target="#rateModal">
                <i class="fa fa-fw fa-check"></i> Close
            </button>
        @endif
    @endunless
</div>
<div class="box-body">
    <table class="table table-bordered table-responsive">
        <tr class="list-group-item-info">
            <th><strong>No </strong>: {{$order->number}}</th>
            <th><i class="fa fa-fw fa-mobile"></i>{{$order->contact}}</th>
            <th><strong>Location </strong>: {{$order->location_id}}</th>
        </tr>
        <tr class="list-group-item-info">
            <th><strong>Priority </strong>: {{$order->priority}} of 5</th>
            <th><strong>Creator </strong>: {{$order->creator}}</th>
            <th><strong>Type </strong>: {{$order->type}}</th>
        </tr>
        <tr class="list-group-item-info">

            <th colspan="2"><i class="fa fa-fw fa-clock-o"></i><strong>Date Created :</strong>: {{$order->created_at}}
            </th>
            <th colspan="2"><i class="fa fa-fw fa-clock-o"></i><strong>Last Modied : </strong>: {{$order->updated_at}}
            </th>
        </tr>

        <tr class=""><strong>Title </strong>: {{$order->title}}</tr>

        <tr class=""><h5><strong>Description </strong>: {!!nl2br($order->description)!!}</h5></tr>

        <tr class=""><h5><strong>Notes </strong>: {!! $order->notes ? nl2br($order->notes):'No Notes' !!}</h5></tr>
        @if(auth()->user()->owns($order))
            <tr class=""><h5><strong>Key </strong>: {!! $order->key ?$order->key:  'Error' !!}</h5></tr>
        @endif
    </table>
