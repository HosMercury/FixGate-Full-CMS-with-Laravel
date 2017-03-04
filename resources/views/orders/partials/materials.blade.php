@if(count($materials))
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Used Materials</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-responsive table-hover">
                <tbody>
                <tr>
                    <td>#</td>
                    <th>Material</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>SubTotal</th>
                </tr>
                @foreach($materials as $material)
                    <tr class="mats-show">
                        <td>{{$material->id}}</td>
                        <td>{{$material->name}}</td>
                        <td>{{$material->pivot->quantity}}</td>
                        <td>{{$material->price}}</td>
                        <td>{{$material->pivot->quantity * $material->price}}</td>
                    </tr>
                @endforeach

                <form action="/orders/{{$order->id}}/materials/delete" method="post"
                      onsubmit="return confirm('Do you really want to delete your this material(s)?');">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    @foreach($materials as $material)
                        <tr class="del-mat" style="display: none;">
                            <td>
                                <input type="checkbox" name="material_select[]" class="checkbox"
                                       value="{{$material->id}}"/>
                            </td>
                            <td>{{$material->name}}</td>
                            <td>{{$material->pivot->quantity}}</td>
                            <td>{{$material->price}}</td>
                            <td>{{$material->pivot->quantity * $material->price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <button type="submit" class="delete-submit btn btn-sm btn-danger" style="display: none;">
                                Delete Selected
                            </button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="pull-right">Materials Total</th>
                    <th>{{$materials_total}}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><p class="pull-right">Total Materials & costs</p></th>
                    <th><p>{{$costs->sum('price') + $materials_total}}</p></th>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endif

<div class="row col-xs-12" style="margin: .6em 0">
    @unless(count($materials))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>No Used Materials for this order .</p>
        </div>
    @endunless
    <a class="add-mat btn btn-sm btn-info pull-right">+ Add Material</a>
    <a class="toggle-mat btn btn-sm btn-danger" style="
    {{count($materials)?'':'display:none'}}
            ;">Delete</a>
</div>

<div class="row headers col-xs-11" style="display: none; padding: 0.5em 0;
                     margin : 1em 0;border-bottom:solid thin #ccc">
    <div class="col-xs-1"></div>
    <div class="col-xs-4"><strong>Material</strong></div>
    <div class="col-xs-2"><strong>Qty</strong></div>
    <div class="col-xs-2"><strong>Price</strong></div>
    <div class="col-xs-1"><strong>Subtotal</strong></div>
</div>

<form name="mts" class="form-horizontal" method="POST"
      action="/orders/{{$order->id}}/materials/">
    {{csrf_field()}}
    <div class="container" id="mts"></div>

    <div class="row col-xs-12 headers" style="display: none;
                        border-top: solid thin #ccc;padding:0.5em 0;margin: 0.5em 0">
        <div class="col-xs-9">
            <p class="pull-right"><strong>Grand Total : </strong></p>
        </div>
        <div class="col-xs-3">
            <strong><p class="grand"></p></strong>
        </div>
    </div>

    <div class="row col-xs-12">
        <button type="submit" class="btn btn-success pull-right headers"
                name="submit-mat" style="display: none">Send
        </button>
    </div>
</form>
<br>