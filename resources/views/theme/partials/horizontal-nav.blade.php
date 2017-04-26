<div class="invoice margin " style="padding: 0;">
    <div class="" style="border-bottom: solid thin #ccc;">
        <a class="btn btn-md nav-btn" href="/orders">
            <i class="fa fa-list"></i> Orders
        </a>

        @if(auth()->user()->fromAdmins())
            <a class="btn btn-md nav-btn" href="/users">
                <i class="fa fa-users"></i> Users
            </a>

            <a class="btn btn-md nav-btn" href="/locations">
                <i class="fa fa-location-arrow"></i> Locations
            </a>

            <a class="btn btn-md nav-btn" href="/materials">
                <i class="fa fa-barcode"></i> Materials
            </a>

            <a class="btn btn-md nav-btn" href="/types">
                <i class="fa fa-tag"></i> Types
            </a>
        @endif

        @if(auth()->user()->isSuperAdmin() || auth()->user()->isAccountant())
            <a class="btn btn-md nav-btn" href="/financial">
                <i class="fa fa-money"></i> Financial
            </a>
        @endif

        <a class="btn btn-md nav-btn pull-right" href="/orders/create">
            <i class="fa fa-plus"></i> New Order
        </a>

    </div>

</div>

