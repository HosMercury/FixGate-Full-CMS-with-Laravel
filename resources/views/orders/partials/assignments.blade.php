<!-- Assignments -->
<div class="box-header with-border">
    <h2 class="box-title"><i class="fa fa-fw fa-hourglass-start"></i> Assignments</h2>
</div>

<div class="box-body">
    <div class="assignments margin-bottom">
        @if(! $assigns->isEmpty())
            @foreach($assigns as $index=>$assign)
                @if($index == -1 and isset($closed))
                    <div>
                        <p><strong>Closed at : </strong> {{$assign[0]->created_at}}
                            - <strong>By User:</strong> {{$assign[0]->creator}} </p>
                    </div>
                    <hr>
                @elseif($index >0 )
                    <div>
                        <h4>Assignment #{{$index}}
                                    <!-- Edit -->
                            @if($index == $assigns_max and !isset($closed) )
                                <button class="btn btn-xs btn-default ass-edit " style="display: inline-block;">
                                    <i class="fa fa-fw fa-edit"></i>
                                </button>
                            @endif
                        </h4>
                        <ol>
                            @foreach($assign as $ass)
                                <li>
                                    @if($ass->vendor)
                                        <strong>{{$ass->vendor}} (VENDOR) </strong><span>at: <small>{{$ass->created_at}}</small></span>
                                    @else
                                        <strong>{{$ass->worker->name}}</strong> <span>at: <small>{{$ass->created_at}}</small></span>
                                    @endif
                                    @include('orders.partials.delete_assign_form')
                                </li>
                                @endforeach
                                        <!-- delete All Assignment -->
                                @if($index == $assigns_max and !isset($closed) )
                                    <form method="post" action="/{{$order->path()}}/assignments/{{$ass->id}}/all"
                                          class="ass-delete-all">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-xs btn-danger"><i
                                                    class="fa fa-fw fa-trash-o"></i> Delete whole assignment
                                        </button>
                                    </form>
                                @endif
                        </ol>
                    </div>
                    <hr>
                @endif
            @endforeach

        @else
            <p><strong>Start Assign : </strong></p>
            <hr>
            @endif<!-- isEmpty($assigns)-->

            <!-- Assign Form -->
            @if(!isset($closed))
                <div class="new-assignment">
                    {!!Form::open(['url' => $order->path().'/assignments/','method'=>'POST',$order->id])!!}
                    @include('orders.partials.assignForm',['label'=>'New Assignment : ','assign'=>'Assign'])
                    @include('orders.partials.vendor')
                </div>
            @endif
    </div>

</div>