<!-- Assignments -->
<div class="box-header with-border">
    <h2 class="box-title" id="assignments"><i class="fa fa-fw fa-hourglass-start"></i> Assignments</h2>
</div>
<div class="box-body">
    <div class="assignments margin-bottom">
        @if(! $assigns->isEmpty())
            <ol>
                @foreach($assigns as $index=>$assign)
                    @if( $index > 0 )
                        <h4>Assignment ({{$index}}) :</h4>
                        <ol class="col-md-12">
                            @foreach($assign as $worker)
                                @if(isset($worker))
                                    <div>
                                        <li class="col-md-4">
                                            <label>{{$worker->name}}</label>
                                            @if($index === $assigns_count and !$closed)
                                                {!! Form::open(['url'=>"/orders/$order->id/assignments/$index/workers/$worker->id/delete/"
                                                                ,'method' => 'delete','class'=>'inline','OnSubmit' =>'return confirm("are you sure?")']) !!}
                                                <button type="submit" class="btn btn-xs btn-danger delete-assignment"><i
                                                            class="fa fa-fw fa-remove"> </i>
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </li>
                                    </div>
                                @endif

                                {{--add to this assignment--}}
                                <div class="col-xs-12">
                                    {!!Form::open(['url' => "/orders/$order->id/assignments/{$index}/",
                                    'class'=>'add-worker-form',$order->id])!!}
                                    {{method_field('PATCH')}}
                                    @include('orders.partials.assignForm',
                                        ['label'=>'Add : ','assign'=>'Add','add'=>'add'])
                                </div>
                            @endforeach
                        </ol>

                        @if($index === $assigns_count and !$closed)

                            {{--Edit--}}
                            <button class="btn btn-default btn-xs edit-assignment">
                                <i class="fa fa-fw fa-edit"></i> Edit
                            </button>

                            {{--Delete--}}
                            {!! Form::open(['url'=>"/orders/$order->id/assignments/$index/delete/"
                                            ,'method'=>'DELETE','class'=>'inline','OnSubmit' =>'return confirm("are you sure?")']) !!}
                            <button type="submit" class="btn btn-danger btn-xs delete-assignment"><i
                                        class="fa fa-fw fa-remove"></i> Delete All
                            </button>
                            {!! Form::close() !!}
                        @endif
                    @elseif($index < 0 and isset($closed))
                        <hr>
                        <p><strong>Closed at : </strong>{{$closed->created_at}}</p>
                        <p><strong>Rated : </strong>Stars</p>
                    @endif
                @endforeach
            </ol>
        @else
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>No Assignments yet . start Assign !</p>
            </div>
        @endif
    </div>
    @if(!$closed)
        <hr>
        <div class="new-assignment">
            {!!Form::open(['url' => "/orders/$order->id/assignments/",'method'=>'POST',$order->id])!!}
            @include('orders.partials.assignForm',['label'=>'New Assignment : ','assign'=>'Assign','add'=>''])
        </div>
    @endif
</div>