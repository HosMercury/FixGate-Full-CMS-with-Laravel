<script src="{{asset('theme/plugins/ionslider/ion.rangeSlider.min.js')}}"></script>
<script>
    $("#priority").ionRangeSlider({
        type: "single",
        grid: true,
        min: 1,
        max: 4,
        @if(isset($order)) from: {{$order->priority}},
        @else  from: {{old('priority')?old('priority'):1}}, @endif
        step: 1,
        keyboard: true,
        onStart: function (data) {
            console.log('mines')
        },
        onChange: function (data) {
            switch (data.fromNumber) {
                case 1 :
                    $('.changeable').text('Regular - 72 hrs');
                    break;
                case 2 :
                    $('.changeable').text('Important - 48 hrs');
                    break;
                case 3 :
                    $('.changeable').text('Urgent - 24 hrs');
                    break;
                case 4 :
                    $('.changeable').text('Crisis - ASAP');
                    break;
                default :
                    $('.changeable').text('Regular - 72 hrs');
                    break;
            }
        },
    });
</script>