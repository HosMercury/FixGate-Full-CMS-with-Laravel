<div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-fw fa-cubes"></i> Materials & Costs</h3>
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
                @include('orders.partials.materials')
            </div>

            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                @include('orders.partials.costs')
                <br style="height: 0px; clear: both;"/>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>

</div>