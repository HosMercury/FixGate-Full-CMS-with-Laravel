<div class="box">
    <div class="box-header with-border">
        <h2 class="box-title">Assign Permissions</h2>
    </div>
    <div class="box-body">
        <form class="form-horizontal" role="form" method="POST" action="{{url('/permissions') }}">
            {!! csrf_field() !!}

            <div class="col-xs-12">

                <table class="table table-bordered table-responsive">
                    <tr>
                        <td>
                            <h4>Staff Members</h4>
                        </td>
                        <td>
                            <p><strong>Note :</strong>This is the default permission for any registered user .</p>

                            <p> Normally Staff members could view their own belonging orders
                                without any
                                security requirements ,
                                But for any other staff member trying to view others` orders ,
                                they will be promoted to enter the order`s key sent to the creator by email.
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            Accountants
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="accountant">&nbsp;&nbsp;&nbsp;&nbsp; Allowed to view
                                    Financial pages ,
                                    for used materials and costs .
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Administrators
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="admin">&nbsp;&nbsp;&nbsp;&nbsp; Allowed to do
                                    everything except Roles and
                                    permissions .
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Super-Administrators
                        </td>
                        <td>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="superadmin">&nbsp;&nbsp;&nbsp;&nbsp; Can do everything
                                    in every where .
                                </label>
                            </div>
                        </td>
                    </tr>

                </table>

            </div>

            <!--Submit-->
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-send"></i> Send
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>