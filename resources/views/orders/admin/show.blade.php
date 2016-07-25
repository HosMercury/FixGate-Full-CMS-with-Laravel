@extends('theme.source')
@section('orders_active')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Work Order #{{$id}} -Details</h3>
                </div>

                <div class="box-body">
                    @include('orders.admin.partials.details')
                </div>
            </div>
            <!-- Assignments --><!-- if not Assigned nor ReAssigned -->
            <div class="box box-danger">

                <div class="box-header with-border"><h3 class="box-title">Assignments</h3></div>
                <div class="box-body">
                    {{--New Order--}}
                    @if(!(in_array($status,['Assigned','Reassigned','Closed'])))
                        <form action="/order/{{$id}}/assign/" method="POST">
                            @include('orders.admin.partials.assignForm', ['submit' => 'Assign'])
                        </form>
                        {{--If Assigned Or reAssigned--}}
                    @elseif( in_array( $status,['Assigned','Reassigned']))
                        <p><strong>Assigned at : </strong>
                            <i class="fa fa-fw fa-clock-o"></i>
                            <small>{{$assignment[0]['created_at']}}</small>
                        </p><p><strong>to :</strong></p>

                        @if(count($workers))
                            <ul class="list-group">
                                @for ($i=0 ;$i < count($workers); $i++ )
                                    @if($workers[$i]['assignment']=='Assigned')
                                        <li class="col-sm-4 col-sm-offset-1 list-group-item list-group-item-heading list-group-item-info pull-left">
                                            <i class="fa fa-fw fa-wrench"></i>
                                            {{$workers[$i]['name']}}
                                            ({{$workers[$i]['role']}})
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        @endif
                        <hr>

                        {{--Assign Edit--}}
                        <form action="/order/{{$id}}/assign/{{$assignment[0]['id']}}"
                              method="post" class="editForm"
                              style="display:none;"
                              onsubmit="return confirm('Do you really want to delete your assignment?');">
                            {{csrf_field()}}{{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm pull-right">X</button>
                        </form>

                        <form action="/order/{{$id}}/assign/{{$assignment[0]['id']}}"
                              method="post" class="editForm clearfix"
                              style="display:none;">
                            {{ method_field('PATCH') }}
                            @include('orders.admin.partials.assignForm', ['submit' => 'Update'])
                        </form>
                        {{--2b sure it is not reassigned --}}
                        @if($status !=='Reassigned')
                            <a class="btn btn-default btn-sm pull-left edit">Edit</a>
                            <a class="btn btn-info btn-sm pull-right reassign">Reassign</a>
                        @endif

                        <form action="/order/{{$id}}/reassign/" method="post" class="reassignForm"
                              style="display:none;">
                            <h4>Reassignment :</h4>

                            <div class="form-group">
                                <label class="control-label">Reason For Reassignment :</label>
                                <small> So,Why first assignment failed ?</small>
                                <textarea name="reason" class="form-control col-xs-12 reason" rows="2"></textarea>
                            </div>
                            <br><br>
                            @include('orders.admin.partials.assignForm', ['submit' => 'Reassign'])
                        </form>

                        {{--ReAssignments --}}
                        @if( $status == 'Reassigned' )
                            <div class="row col-xs-12">
                                <hr>
                                <p><strong>Then Reassigned at : </strong>
                                    <i class="fa fa-fw fa-clock-o"></i>{{$assignment[0]['created_at']}}
                                </p>
                                @if($reason)
                                    <p><strong>Reason</strong> : {{$reason}}</p>
                                @endif
                                <p><strong>to :</strong></p>

                                @if(count($workers))
                                    <ul class="list-group col-xs-12 center-block">
                                        @for ($i=0 ;$i < count($workers); $i++ )
                                            @if($workers[$i]['assignment']=='Reassigned')
                                                <li class="col-sm-4 col-sm-offset-1 list-group-item list-group-item-heading list-group-item-info pull-left">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                    {{$workers[$i]['name']}}
                                                    ({{$workers[$i]['role']}})
                                                </li>
                                            @endif
                                        @endfor
                                    </ul>
                                @endif

                                <form action="/order/{{$id}}/reassign/{{$assignment[0]['id']}}" method="post"
                                      class="editForm2 clearfix"
                                      style="display:none;"
                                      onsubmit="return confirm('Do you really want to delete your reassignment?');">
                                    {{csrf_field()}}{{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm pull-right">X</button>
                                </form>

                                <form action="/order/{{$id}}/reassign/{{$assignment[0]['id']}}" method="post"
                                      class="editForm2"
                                      style="display:none;">
                                    {{ method_field('PATCH') }}
                                    @include('orders.admin.partials.assignForm', ['submit' => 'Update'])
                                </form>
                                <a class="btn btn-default btn-sm pull-left edit2">Edit</a>
                                @endif

                                @else {{dd('Error...please contact admins err:922')}}
                            </div>
                        @endif
                </div>
            </div>
            {{--Materials and Cost--}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Materials and Cost</h3>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i
                                            class="fa fa-fw fa-cubes"></i> Materials</a></li>
                            <li class="fade in"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i
                                            class="fa fa-fw fa-money"></i> Costs</a></li>
                        </ul>

                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_1">
                                @include('orders.admin.partials.materials')
                            </div>

                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                @include('orders.admin.partials.costs')
                                <br style="height: 0px; clear: both;"/>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>

                </div>
            </div>
        </div>
        <!--<div class="row">-->

        @stop
        @section('scripts')
            <script>
                var count = 0;
                var otherCount = 0;
                var maters_ids = {!! $all_materials_ids !!};
                var tableRow =
                        '<div class="added col-xs-11" style="margin: 1em 0">'
                        + '<div class="col-xs-4">'
                        + '<select name="material_id[]" class="form-control select-mat">'
                        + '<option>Select Material</option>'
                $.each(maters_ids, function (i) {
                    tableRow += '<option class="mat-option" value="' + maters_ids[i].id + '" >' + maters_ids[i].title + '</option>'
                });
                tableRow += '</select>'
                        + '</div>'
                        + '<div class="col-xs-2 parent">'
                        + '<input name="quantity[]" type="number" step="0.1" class="col-xs-11 .input-sm qty form-control" required />'
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

                    $('.d-zone').hide();
                    //Assignment edit
                    $('a.edit').click(function () {
                        var txt = $(this).text();
                        txt = (txt != 'cancel') ? 'cancel' : 'edit';
                        $(this).text(txt);
                        $('.editForm').toggle(500);
                        $('.reassign').toggle();
                    });
                    //Assignment edit
                    $('a.edit2').click(function () {
                        var txt = $(this).text();
                        txt = (txt != 'cancel') ? 'cancel' : 'edit';
                        $(this).text(txt);
                        $('.editForm2').toggle(500);
                    });
                    //Reassignment
                    $('a.reassign').click(function () {
                        $('.reassignForm').toggle(500);
                        $('.edit').hide();
                        $('.reassign').hide();
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
//                        var optionSelected = $("option:selected", this);
                        var valueSelected = this.value;
                        $this = $(this);
                        row = $this.parents("div.added");
                        parseFloat(row.find(".mat-price").text(maters_ids[valueSelected - 1].price));
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

            <script src="{{asset('Theme/plugins/dropzone/dropzone.js')}}"></script>
            <link rel="stylesheet" href="{{asset('Theme/dist/css/dropzone.css')}}">
            <link type="text/css" rel="stylesheet"
                  href="{{asset('Theme/plugins/lity/dist/lity.min.css')}}"/>
            <script src="{{asset('Theme/plugins/lity/dist/lity.min.js')}}"></script>
            <script>
                Dropzone.options.myAwesomeDropzone = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 3, // MB
                    acceptedFiles: "image/*"
                };
            </script>

    </div>
@stop