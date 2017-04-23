@if($index == $assigns_max and !$closed )
    <form method="post" action="/{{$order->path()}}/assignments/{{$ass->id}}"
          onsubmit="return confirm('are you sure !?')"
          class="ass-delete"
          style="display: inline-block;"
            >
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="submit" class="btn btn-xs btn-danger" style="display: inline">
            <i class="fa fa-fw fa-times"></i>
        </button>
    </form>
@endif
