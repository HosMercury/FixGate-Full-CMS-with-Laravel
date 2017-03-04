<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<body>
{{--<div id="demo">--}}
{{--<h2>Let AJAX change this text</h2>--}}
{{--<button type="button" id="btn">play</button>--}}
{{--</div>--}}

<div class="result"></div>
<div id="loader" style="display: none;">loading</div>
<button id="load">load</button>
<form method="post" action="test2" id="comment">
   {{csrf_field()}}
    <input name="test">
    <button id="btn" type="submit">submit</button>
</form>

<script>
//    jQuery(document).ready(function ($) {
//
//        $('#comment').on('submit', function (e) {
//            e.preventDefault();
//
//            var name = $(this).find('input[name=test]').val();
//
//            $.ajax({
//                type: "POST",
//                url: 'test2',
//                data: $(this).serialize(),
//                beforeSend: function()
//                {
//                    $("#loader").show();
//                },
//                success : function(msg)
//                {
//                    $('.result').html(JSON.stringify(msg.test+' milano'));$("#loader").hide();
//                }
//            });
//        });
//    });

    $(document).ready(function(){
        $('#load').click(function(){
            $('.result').load('test2');
        })
    });
</script>
</body>
</html>