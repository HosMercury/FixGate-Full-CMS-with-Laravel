<script src="{{asset('theme/plugins/dropzone/dropzone.js')}}"></script>
<script src="{{asset('theme/plugins/lity/dist/lity.min.js')}}"></script>
<script src="{{asset('theme/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('theme/plugins/rating/rating.js')}}"></script>
<script>
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 3, // MB
        acceptedFiles: "image/*"
    };
</script>
<script>
    var count = 0;
    var otherCount = 0;
    var maters_ids = {!! $materials_ids !!};

    var tableRow =
        '<div class="added col-xs-11" style="margin: 1em 0">'
        + '<div class="col-xs-4">'
        + '<select name="material_id[]" class="form-control select-mat">'
        + '<option>Select Material</option>'
    $.each(maters_ids, function (i) {
        tableRow += '<option class="mat-option" value="' + maters_ids[i].id + '" >' + maters_ids[i].name + '</option>'
    });
    tableRow += '</select>'
        + '</div>'
        + '<div class="col-xs-2 parent">'
        + '<input name="quantity[]" type="number" step="0.5" class="col-xs-11 .input-sm qty form-control" required />'
        + '</div>'
        + '<div class="price col-xs-2">'
    tableRow += '<p class="mat-price"></p>'
        + '</div>'
        + '<div class="col-xs-2">'
        + '<p class="sub">0</p>'
        + '</div>'
        + '<div class="col-xs-2">'
        + '<a class=" btn btn-xs btn-danger deleteAdded">X</a>'
        + '</div>'
        + '</div>';

    var tableRowCosts =
        '<div class="added-cost col-xs-12" style="margin: 1em 0">'
        + '<div class="col-xs-6">'
        + '<input type="text" class="col-xs-11" name="costDescription[]" required/>'
        + '</div>'
        + '<div class="col-xs-3">'
        + '<input type="number" step="0.1" class="costs-sub" name="costSubTotal[]" required/>'
        + '</div>'
        + '<div class="col-xs-2">'
        + '<a class=" btn btn-xs btn-danger cost-deleteAdded">X</a>'
        + '</div>'
        + '</div>';


    $(document).ready(function () {

        $('.ass-delete').hide();
        $('.ass-delete-all').hide();

        $('.d-zone').hide();

        $('.ass-edit').click(function(){
            var txt = $(this).text();
            txt = (txt != 'cancel') ? 'cancel' : 'edit';
            $(this).text(txt);
            $('.ass-delete').toggle(200);
            $('.ass-delete-all').toggle(200);
            txt = (txt = 'cancel') ? 'cancel' : 'edit';

            $('.delete-submit').click(function () {
                
            });
        });

        //show Materials headers and append row
        $(".add-mat").click(function () {
            $('.headers').slideDown('slow');
            count++;
            $('#mts').append(tableRow);
            $('.alert-warning').hide(300);
        });

        //show cost headers and append row
        $(".add-cost").click(function () {
            $('.headers-cost').slideDown('slow');
            otherCount++;
            $('#costs').append(tableRowCosts);
            $('.alert-warning-cost').hide(300);
            $('.d-zone').show(300);
        });

        $(".toggle-mat").click(function () {
            $('.mats-show').slideToggle(200);
            $('.del-mat').slideToggle(200);
            var txt = $(this).text();
            txt = (txt != 'Delete') ? 'Delete' : 'Cancel';
            $(this).toggleClass('btn-default');
            $(this).toggleClass('btn-danger');
            $('.delete-submit').toggle();
            $('.toggle-mat').toggle();
            $(this).text(txt);
        });

        $(".toggle-cost").click(function () {
            $('.costs-show').slideToggle(200);
            $('.del-cost').slideToggle(200);
            var txt = $(this).text();
            txt = (txt != 'Delete') ? 'Delete' : 'Cancel';
            $(this).toggleClass('btn-default');
            $(this).toggleClass('btn-danger');
            $('.delete-submit-cost').toggle();
            $('.toggle-cost').toggle();
            $(this).text(txt);
        });

        // prepared event for calculations
        $(document).on('change keyup', "input.qty", function () {
            $this = $(this);
            qty = parseFloat($this.val());
            row = $this.parents("div.added");
            price = parseFloat(row.find(".price").text());
            if (price)
                row.find(".sub").text(price * qty);
            calc();
        });


        $(document).on('change', '.select-mat', function () {
            var valueSelected = this.value;
            $this = $(this);
            row = $this.parents("div.added");

            price = maters_ids.find(function (mat) {
                return mat.id == valueSelected;
            })['price'];
            parseFloat(row.find(".mat-price").text(price));
            calc();
        });


        $(document).on('change keyup', '.costs-sub', function () {
            cost_calc();
        });
        $(document).on('click', ".deleteAdded", function () {
            var $this = $(this);
            row = $this.parents('.added');
            row.remove();
            count--;
            if (!count) $('.headers').slideUp('slow');
            calc();
        });

        function calc() {
            grandTotal = 0;
            $('.sub').each(function () {
                grandTotal += parseFloat($(this).text());
            });
            $('p.grand').text(grandTotal);
        }

        $(document).on('click', ".cost-deleteAdded", function () {
            var $this = $(this);
            row = $this.parents('.added-cost');
            row.remove();
            otherCount--;
            if (!otherCount) $('.headers-cost').slideUp('slow');
            cost_calc();
        });
        function cost_calc() {
            cost_grandTotal = 0;
            $('.costs-sub').each(function () {
                cost_grandTotal += parseFloat($(this).val());
            });
            $('p.cost-grand').text(cost_grandTotal);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('select').select2({
            placeholder: "Select worker(s)",
            allowClear: true
        });

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });

        $('#rating').rating();
    });
</script>

@if ($errors->has('rating') or $errors->has('feedback') or $errors->has('closekey') )
    <script>
        $('#rateModal').modal('show');
    </script>
@endif