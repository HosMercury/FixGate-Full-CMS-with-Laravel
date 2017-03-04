<div class="col-xs-12" style="border: solid thin grey;margin: auto">
    @foreach($thumbs as $thumb)
        <div class="col-md-3 col-sm-6" style="margin: 10px;">
            <a href="/bills/{{substr($thumb->name,3)}}"
               data-lity data-lity-target="/bills/{{substr($thumb->name,3)}}">
                <img src="/bills/{{$thumb->name}}"/>
            </a>
        </div>
    @endforeach
</div>
{{--delete bill--}}
<a href="#inline" class="btn btn-sm btn-danger" data-lity>Delete Bill(s)</a>

<div id="inline" style="overflow: auto;overflow-y: scroll;height:100%; padding: 20px; max-width: 100%;
 border-radius: 6px; max-height: 300px; background: rgb(253, 253, 246);" class="lity-hide col-xs-11">
    <form action="/orders/{{$order->id}}/bills/delete" method="POST">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <h4>* Select bill(s) to delete</h4>
        @foreach($thumbs as $thumb)
            <div class="col-md-3" style="margin: 10px;border:solid thin wheat;">
                <p>{{substr($thumb->name,3)}}</p><img src="/bills/{{$thumb->name}}" style="width:50px;"/>
                <input type="checkbox" name="bill[]" value="{{substr($thumb->name,3)}}" style="display: inline; ">
            </div>
        @endforeach
        <div class="pull-right col-xs-12">
            <button type="submit" class="btn btn-sm btn-danger">Delete Selected</button>
        </div>
    </form>
</div>
