<!-- Assignments -->
<div class="box-header with-border">
    <h2 class="box-title"><i class="fa fa-fw fa-hourglass-start"></i> Assignments</h2>
</div>
<div class="box-body">
    <div class="assignments margin-bottom">
        <!-- if error key provided -->
        @if ($errors->has('key'))
            <span class=" help-block" style="color: #a94442;">
                 <strong>{{$errors->first('key')}}</strong>
            </span>
            @endif

            @if(! $assigns->isEmpty())
            @if($closed)
                    <!-- Closing data -->
            <div>
                <p><strong class="bg-red">Closed at : </strong> {{$closed->created_at}}
                    - <strong class="bg-red">By User:</strong> {{$closed->creator}} </p>
            </div>
            <hr>
        @endif
        @foreach($assigns as $index=>$assign)
            @if($index >0 )
                <div class="panel">
                    <h4>Assignment #{{$index}}
                        @if($index == $assigns_max and !$closed )

                            @unless($closed or $done)
                                @if(auth()->user()->fromAdminsAndSupervisors())
                                    <button class="btn btn-xs btn-default ass-edit " style="display: inline-block;">
                                        <i class="fa fa-fw fa-edit"><!--edit --></i>
                                    </button>
                                @endif
                            @endunless
                    </h4>
                    @unless($done)
                        @if(auth()->user()->fromAdminsAndSupervisors())
                            <div class="done">
                                <input type="checkbox"
                                       onChange="$('.done').toggle(200)">
                                <i class="fa fa-fw fa-hand-peace-o"></i>&nbsp;
                                Work done with this assignment .
                            </div>
                            <form method="post"
                                  action="/{{$order->path()}}/assignments/{{$assign->first()->status}}/done"
                                  class="form-horizontal done  {{ $errors->has('key') ? ' has-error' : '' }}"
                                  style="{{!$errors->has('key')? 'display: none;':''}} padding: 20px;">
                                {{csrf_field()}}
                                <div class="form-group col-sm-2">
                                    <label for="key">Please Provide the close key :</label>
                                    <input type="text" name="key" class="form-control">
                                </div>
                            </form>
                        @endif
                    @endunless
                    @endif
                    <ol class="col-xs-12">
                        @foreach($assign as $ass)
                            <li>
                                @if($ass->vendor)
                                    <i>{{$ass->vendor}} (-VENDOR-) </i><span>at: <small>{{$ass->created_at}}</small></span>
                                @else
                                    <i>{{$ass->worker->name}}</i> <span>at: <small>{{$ass->created_at}}</small></span>
                                @endif
                                @if(auth()->user()->fromAdminsAndSupervisors())
                                    @include('orders.partials.delete_assign_form')
                                @endif
                            </li>
                            @endforeach
                                    <!-- delete All Assignment -->
                            @if($index == $assigns_max and !$closed )
                                @if(auth()->user()->fromAdminsAndSupervisors())
                                    <form method="post" action="/{{$order->path()}}/assignments/{{$ass->id}}/all"
                                          class="ass-delete-all">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-xs btn-danger"><i
                                                    class="fa fa-fw fa-trash-o"></i> Delete whole assignment
                                        </button>
                                    </form>
                                @endif
                            @endif
                    </ol>
                </div>
                <hr>
            @endif
        @endforeach
        @if($done)
            @if(auth()->user()->fromAdminsAndSupervisors())
                <form method="post"
                      action="/{{$order->path()}}/assignments/{{$assign->first()->status}}/undone"
                      class="">
                    {{csrf_field()}}
                    <p>Work Done .</p>
                    <button type="submit" class="inline">Undo</button>
                </form>
            @endif
        @endif
        @else
            There is no Assignments until now ..
            @endif<!-- isEmpty($assigns)-->

            <!-- Assign Form -->
            @if(auth()->user()->fromAdminsAndSupervisors())

                @unless($closed or $done)
                    <p><strong>New Assignment : </strong></p>
                    <hr>
                    <div class="new-assignment">
                        {!!Form::open(['url' => $order->path().'/assignments/','method'=>'POST',$order->id])!!}
                        @include('orders.partials.assignForm',['label'=>'New Assignment : ','assign'=>'Assign'])
                        @include('orders.partials.vendor')
                    </div>
                @endunless
            @endif
    </div>

</div>