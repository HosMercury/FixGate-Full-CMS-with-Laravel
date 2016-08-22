@if(count($workers))
    <ul class="list-group">
        @foreach($order->workers as $worker)
            @if($worker->pivot->assignment == $status)
                <li class="col-sm-4 col-sm-offset-1 list-group-item list-group-item-heading list-group-item-info pull-left">
                    <i class="fa fa-fw fa-wrench"></i>
                    {{$worker->name}}
                    ({{$worker->role}})
                </li>
            @endif
        @endforeach
    </ul>
@endif