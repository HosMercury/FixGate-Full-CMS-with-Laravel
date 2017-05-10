@if(count($costs))
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Used Materials</h3>


        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-responsive table-hover">
                <tbody>
                <tr>
                    <td>#</td>
                    <th>Description</th>
                    <th>SubTotal</th>
                </tr>

                @foreach($costs as $cost)
                    <tr class="costs-show">
                        <td>{{$cost->id}}</td>
                        <td>{{$cost->description}}</td>
                        <td>{{$cost->cost}}</td>
                    </tr>

                @endforeach
                <form action="/{{$order->path()}}/costs" method="post"
                      onsubmit="return confirm('Do you really want to delete your this costs(s)?');">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    @foreach($costs as $cost)
                        <tr class="del-cost" style="display: none;">
                            <td>
                                <input type="checkbox" name="cost_select[]" class="checkbox"
                                       value="{{$cost->id}}"/>
                            </td>
                            <td>{{$cost->description}}</td>
                            <td>{{$cost->cost}}</td>
                        <tr>
                    @endforeach

                        <td>
                            <button type="submit" class="delete-submit-cost btn btn-sm btn-danger"
                                    style="display: none;">
                                Delete Selected
                            </button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <th class="pull-right">Costs Total</th>
                    <th>{{$costs->sum('cost')}}</th>
                </tr>
                <tr>
                    <th></th>
                    <th><p class="pull-right">Total Materials & costs</p></th>
                    <th><p>{{$costs->sum('cost')+$materials_total}}</p></th>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endif

<div class="row col-xs-12" style="margin: .6em 0">
    @unless(count($costs))
        <div class="alert alert-warning alert-warning-cost alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>No Added Costs for this order .</p>
        </div>
    @endunless
    <a class="add-cost btn btn-sm btn-info pull-right">+ Add Cost</a>
    <a class="toggle-cost btn btn-sm btn-danger" style="
    {{count($costs)?'':'display:none'}};">Delete</a>
</div>

<div class="row headers-cost col-xs-11" style="display: none; padding: 0.5em 0;margin : 1em 0;
            ;border-bottom:solid thin #ccc">
    <div class="col-xs-1"></div>
    <div class="col-xs-6"><strong>Cost description</strong></div>
    <div class="col-xs-1"><strong>SubTotal</strong></div>
</div>

<form name="costs" class="form-horizontal" method="POST" action="/{{$order->path()}}/costs/">
    {{csrf_field()}}
    <div class="cost-container" id="costs"></div>

    <div class="row col-xs-11 headers-cost" style="display: none;
            border-top: solid thin #ccc; padding:0.5em 0;margin: 0.5em 0;">
        <div class="col-xs-7">
            <p class="pull-right"><strong>Grand Total : </strong></p>
        </div>
        <div class="col-xs-3">
            <strong><p class="cost-grand"></p></strong>
        </div>
    </div>

    <div class="row col-xs-12">
        <button type="submit" class="btn btn-success pull-right headers-cost"
                name="submit-cost" style="display: none">Save
        </button>
    </div>
</form>
<br style="height: 0px;clear:both;">
<hr>
<div class="col-xs-12 d-zone" style="margin: auto;">
    <h4>Add bills' image files</h4>

    <form action="/{{$order->path()}}/bills"
          class="dropzone"
          id="my-awesome-dropzone"
          style="border:solid thin #ccc;">
        {{csrf_field()}}
    </form>
</div>

@if(count($thumbs))
    <div class="col-xs-12" style="margin: auto;">
        @include('orders.partials.carousel')
    </div>
@endif